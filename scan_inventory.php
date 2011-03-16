<?

require_once("inc/config.php");


check_role($ROLE_USER);
$TITLE = "Inventura";



$tem = template_open("scan_inventory.tpl") .
        $tem = template_open("scan_last_insert.tpl") .
        $tem = template_open("scan_not_yet.tpl") .
        $tem = template_open("scan_last_insert_no_valid.tpl");

$tem = template_add_head_foot($tem, head, foot);







if ($role_id) {

    switch ($role_id) {

        case ($role_id >= $ROLE_ADMIN):
            $tem = template_clean_up_tags($tem, "##IF_BUT_ADMIN##", 1);
            $tem = str_replace("##IF_ADMIN##", "", $tem);
            $tem = str_replace("##IF_LEADER##", "", $tem);
            break;

        case ($role_id <= $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = str_replace("##IF_BUT_LEADER##", "", $tem);
            break;

        case ($role_id <= $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
            $tem = str_replace("##IF_BUT_LEADER##", "", $tem);
            break;

        default:

            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
            $tem = template_clean_up_tags($tem, "##IF_EMPLOYED##", 1);
        //$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
    }
} else {

    $tem = template_clean_up_tags($tem, "##IF_ZALEC##", 1);
    $head = template_clean_up_tags($head, "##IF_USER##", 1);
    $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
    $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
    $tem = template_clean_up_tags($tem, "##IF_EMPLOYED##", 1);
}
//KONEC  Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!





$note = $_REQUEST['note'];


if ($_REQUEST['add'] == "    Shrani    ") {

    //določanje statusa
    $sql = "SELECT DISTINCT inventory_ean FROM Inventory left join `LogInventory` on ean=`inventory_ean`  where ean=$note";
    $result = $db->fetchAll($sql);
    if (!$result) {
        $status = 2; //no valid ean code in Inventory list
    } else {
        $status = 1;
    } //valid ean code in Inventory
    //
    //  $place = "SELECT place FROM `LogInventory` WHERE `inventory_ean`=$note order by id desc limit 0,1";
    // $unit = $db->fetchOne($unit);

    $sql = "SELECT * FROM `LogInventory` WHERE `inventory_ean`=$note order by id desc limit 0,1";
    $result = $db->fetchAll($sql);
    if ($result) {
        foreach ($result as $res) {
            $unit = $res["unit"];
            $place = $res["place"];
            $administrator = $res["person_id"];
        }
    } else {
        $unit = 0;
        $place = 0;
        $administrator = 0;
    }


    //  if ($ean) {
    //dejansko vnesemo
    $data = array(
        'person_assessor' => $person_id,
        'inventory_ean' => $note,
        'status' => $status,
        'unit' => $unit,
        'place' => $place,
        'person_id' => $administrator
    );
    $db->insert('LogInventory', $data);

    //$message .= "Vnos je dodan";
    header("location:" . $_SERVER['HTTP_REFERER']);

    exit;
    //   }
}

/////////////
///////////Izpis neveljavnih vpisov
$tmp = template_get_repeat_text("##VSTART_LOG##", "##VSTOP_LOG##", "##VLOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];

$vsql = "SELECT LogInventory.id as log_id,`inventory_ean`, name, LogInventory.created_at AS created FROM `LogInventory` left join Inventory ON `inventory_ean`=ean where status=2";
$vresult = $db->fetchAll($vsql);


foreach ($vresult as $vres) {
    $table = $row;
    $table = str_replace("##VID##", $vres["log_id"], $table);
    $table = str_replace("##VEAN##", $vres["inventory_ean"], $table);
    $table = str_replace("##VNAME##", $vres["name"], $table);
    //$table = str_replace("##VCREATED##", $vres["created"], $table);
    $table = str_replace("##VUNIT##", $vres["unit"], $table);
    $table = str_replace("##VPLACE##", $vres["place"], $table);
    $table = str_replace("##VPERSONID##", $vres["person_id"], $table);
    $vwhole_table.=$table;
}
$tem = str_replace("##VLOGS##", $vwhole_table, $tem);
$tem = str_replace("##VMESSAGE##", $message, $tem);


///////////////Konec pregle x vpisov
///////////Izpis veljavnih vpisov-SCAN LAST INSERT
$tmp = template_get_repeat_text("##DSTART_LOG##", "##DSTOP_LOG##", "##DLOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];



$dsql="SELECT LogInventory.id as id, inventory_ean,name,LogInventory.unit,place,person_id, LogInventory.description as descr, persons.first as ime, persons.last as priim
 FROM persons right join (`LogInventory` right join Inventory ON `inventory_ean`=ean ) on persons.id_person=LogInventory.person_id
where status=1 order by LogInventory.id desc limit 0,5";


//$dsql = "SELECT LogInventory.id as id, inventory_ean,name,unit,place,person_id, LogInventory.description as descr FROM `LogInventory` right join Inventory ON `inventory_ean`=ean where status=1 order by LogInventory.id desc limit 0,5";
$dresult = $db->fetchAll($dsql);

$count = 0;

//drop down za dolocitev uporabnika katerega se vpisuje
$sql = "SELECT * FROM persons   order by unit, letter ASC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {

    $names[] .= $res["last"]." ".$res["first"];
    $values[] .= $res["id_person"];
}
///////////

//drop down za dolocitev unita
$sql = "SELECT * FROM unit   order by persons_unit DESC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {

    $unitnames[] .= $res["name"];
    $unitvalues[] .= $res["persons_unit"];
}
///////////

//drop down za dolocitev lokacije
$sql = "SELECT * FROM locations   order by name_location";
$result = $db->fetchAll($sql);
foreach ($result as $res) {

    $locnames[] .= $res["name_location"]." ".$res["first"];
    $locvalues[] .= $res["id"];
}
///////////
foreach ($dresult as $dres) {
    $count++;
    $table = $row;
    $table = str_replace("##DID##", $dres["id"], $table);
    $table = str_replace("##DEAN##", $dres["inventory_ean"], $table);
    $table = str_replace("##DNAME##", $dres["name"], $table);
    // $table = str_replace("##DCREATED##", $dres["created"], $table);
    
    $name_dropdown = html_drop_down_arrays("name_drop[]",$names,$values,$dres["person_id"],"form_textbox");
    $unitname_dropdown = html_drop_down_arrays("unitname_drop[]",$unitnames,$unitvalues,$dres["unit"],"form_textbox");
    $locname_dropdown = html_drop_down_arrays("locname_drop[]",$locnames,$locvalues,$dres["place"],"form_textbox");

    $table = str_replace("##NAMEDROP##", $name_dropdown, $table);
    $table = str_replace("##DUNIT##", $unitname_dropdown, $table);
    $table = str_replace("##DPLACE##", $locname_dropdown, $table);

  
    $table = str_replace("##DPERSONID##", $dres["person_id"], $table);
    $table = str_replace("##DDESCRIPTION##", $dres["descr"], $table);
    $dwhole_table.=$table;
}

$tem = str_replace("##DLOGS##", $dwhole_table, $tem);
$tem = str_replace("##DMESSAGE##", $message, $tem);





if ($_REQUEST['edit'] == "spremeni") {

    //dejansko vnesemo
    for ($i = 0; $i < $count; $i++) {
       // $db->query('UPDATE LogInventory SET unit=' . $dunit[$i] . ', place=' . $dplace[$i] . ', person_id=' . $dpersonid[$i] . ', description="' . $ddescription[$i] . '" where id = (' . $did[$i] . ')' . '');
    $db->query('UPDATE LogInventory SET unit=' . $unitname_drop[$i] . ', place=' . $locname_drop[$i] . ', person_id=' . $name_drop[$i] . ', description="' . $ddescription[$i] . '" where id = (' . $did[$i] . ')' . '');
 
        }
    header("location:" . "scan_inventory.php");

    exit;
}

///////////////Konec vpisov
///////////Izpis še odprtih vpisov (še ne skeniranih
$tmp = template_get_repeat_text("##NSTART_LOG##", "##NSTOP_LOG##", "##NLOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];

$nsql = "SELECT distinct `inventory_ean`, name, `unit`,place,`person_id`
from  `LogInventory` right join Inventory ON `inventory_ean`=ean
WHERE inventory_ean not in
(SELECT inventory_ean FROM `LogInventory` right join Inventory ON `inventory_ean`=ean  where status=1 and
date(LogInventory.created_at)= curdate()) order by place, person_id";
$nresult = $db->fetchAll($nsql);


foreach ($nresult as $nres) {
    $table = $row;
    $table = str_replace("##NEAN##", $nres["inventory_ean"], $table);
    $table = str_replace("##NNAME##", $nres["name"], $table);
    $table = str_replace("##NUNIT##", $nres["unit"], $table);
    $table = str_replace("##NPERSONID##", $nres["person_id"], $table);
    $table = str_replace("##NPLACE##", $nres["place"], $table);
    $nwhole_table.=$table;
}
$tem = str_replace("##NLOGS##", $nwhole_table, $tem);
$tem = str_replace("##NMESSAGE##", $message, $tem);




///////////////Konec vpisov



$tem = str_replace("##LOGS##", $whole_table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
///////////////Konec Izpis vpisov trenutnega dne urejenih po abecedi
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##EAN##', $ean_dropdown, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
?>
