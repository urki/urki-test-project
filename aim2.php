<?php

require_once("inc/config.php");
check_role($ROLE_USER);
$TITLE = "Cilji";
$tem = template_open("aim_add2.tpl"); // .
//  $tem = template_open("aim_stop2.tpl");
$tem = template_add_head_foot($tem, "head", "foot");

//
//for insert in html
//
//
  //header for select person
//
include 'name_dropdown.php';


//$beginDate = if    isset($beginDate);
if (!$beginDate) {
    $beginDate = date("Y-m-d");
}



$styleHidden = "class='hide'";


//print_r($person_data['id_person']);
if ($_REQUEST['prikazi']) {
    $name_drop = $_REQUEST[name_drop];
    $person_data = $dal->get_person_data_from_persons_by_person_id($name_drop);
    
    
    
    $person_data = $person_data[0];
    $first = $person_data[first];
    $last = $person_data[last];
    $styleHidden = "";
}
//
//Hidden div
//
    //
    //dropdown ocene
//
$duration = range(1, 5);
$duration_dropdown = html_drop_down_arrays("duration_drop", $duration, $duration, "3"); //date("H",time()));

//$aim_duration_text = isset($_GET['aim_duration_text']) ? $_GET['aim_duration_text'] : '3000-01-01 00:00:00';


$day = range(1, 31);
$day_dropdown = html_drop_down_arrays("day_drop", $day, $day, '31');//date("j", time()));

$month = range(1, 12);
$month_dropdown = html_drop_down_arrays("month_drop", $month, $month, '12');//date("n", time()));


$year = range((date("Y", time())) - 1, (date("Y", time())) + 1);
$year_dropdown = html_drop_down_arrays("year_drop", $year, $year, date("Y", time()));

$expireDurationDate=$year_drop.'-'.$month_drop.'-'.$day_drop;

//
//nosilec drop down
//

$sql = "SELECT * FROM `persons` WHERE  20<`id_role` and unit $unit order by unit, last ASC";
//var_dump($sql);
//echo "A tu se dela?"; TO jke drek od ovce ša sploh pšrogfaf fd shsdrt sdrhtf
$result = $db->fetchAll($sql);

foreach ($result as $res) {
    if (!is_array($ResponsibleName)) {
        $ResponsibleName[] = "izberi..";
        $ResponsibleValue[] = "";
    }
    $ResponsibleName[] .= $res["last"] . " " . $res["first"];
    $ResponsibleValue[] .= $res["id_person"];
}

///////////
$responisble_dropdown = html_drop_down_arrays_multiple("responsible_drop", $ResponsibleName, $ResponsibleValue, $ResponsibleName,10);




//get last used persons_id
$sql = "SELECT persons_id
        FROM aim
        WHERE created_by='$person_id'
        ORDER BY id DESC
        LIMIT 0, 1";
$last_add_user_id = $db->fetchOne($sql);




//person drop down
$sql = "SELECT * FROM `persons` WHERE `id_role`<'11 and unit=$unit'";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($PersonName)) {
        $PersonName[] = "izberi osebo...";
        $PersonValue[] = "";
    }

    $PersonName[] .= $res["first"] . "  " . $res["last"];
    $PersonValue[] .= $res["id_person"];
}
///////////
$person_dropdown = html_drop_down_arrays("person_drop", $PersonName, $PersonValue, $last_add_user_id);




//activity drop down
$sql = "SELECT * FROM `work` WHERE `group`<'11' order by applic";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($ActivityName)) {
        $ActivityName[] = "izberi aktivnost...";
        $ActivityValue[] = "";
    }

    $ActivityName[] .= $res["applic"] . " --> " . $res["name"];
    $ActivityValue[] .= $res["work_id"];
}
///////////
$activity_dropdown = html_drop_down_arrays_multiple("activity_drop", $ActivityName, $ActivityValue, $ActivityName,10);

$aim_name_textbox = html_input_text("aim_name_text", $aim_name_textbox, 25, "default");

$aim_duration_textbox = html_input_text("aim_duration_text", $aim_duration_textbox, 5, '$aim_duration_text');

$aim_description_textbox = html_text_area("aim_description_text", $aim_description_textbox, 20, 50, "htmltextarea");

if ($expireDurationDate == "") {
        $expireDurationDate = '3000-01-01';
}

/////////////////
//For geting from html
//
                        
if ($_REQUEST['add'] == "    Vstavi    ") {
    
    $data = array(
        'persons_id' => ($_REQUEST[ime]),
        //'persons_id' => $person_drop,
        // 'persons_id_responsible' => $responsible_drop,
        'name' => ($_REQUEST[aim_name_text]), //$user_id,
       // 'started_at' => $beginDate,
        // 'work_work_id' => $activity_drop,
        'created_by' => $person_id,
        'description' => ($_REQUEST[aim_description_text]),
        'expired_at' => $expireDurationDate,
        'duration' => $aim_duration_text
    );
    
    $db->insert('aim', $data); 
          
    //@todo Če slučajno še en vpiše takoj za tem bo prišlo do napake!!!!!!!!!! Popravi!!
    $getLastAimId = $dal->get_data_from_aim_order_by_id_desc();
    $getLastAimIdLast = $getLastAimId[0];
    $aim_id = $getLastAimIdLast[id];

    
    
    $data = array(
        'expired_at' => $expireDurationDate,
        'duration' => $aim_duration_text,//, $duration //$aim_duration_text,
        'aim_id' => $aim_id
    );
    $db->insert('AimDuration', $data);

    echo "aim_id=$aim_id";
    foreach ($responsible_drop as $responsible_drop) {
        $data = array(
            'person_id' => $responsible_drop,
            'aim_id' => $aim_id
        );
        $db->insert('AimTeamGroup', $data);
    }

    foreach ($activity_drop as $activity_drop) {
        $data = array(
            'work_id' => $activity_drop,
            'aim_id' => $aim_id
        );
        $db->insert('AimActivity', $data);
    }

    $message .= "Vnos je dodan";
    header("location:" . $_SERVER['HTTP_REFERER']);

    exit;
}



//
//AIM STOP
//
//
//
//
///////////Izpis pe ne končanih vpisov
$tmp = template_get_repeat_text("##NSTART_LOG##", "##NSTOP_LOG##", "##NLOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];


for ($i = 0; $i < 3; $i++) {
    $getLastAimId = $getLastAimId[$i];

    $table = $row;
    $table = str_replace("##NID##", $getLastAimId[name], $table);
    $nwhole_table.=$table;
}
$tem = str_replace("##NLOGS##", $nwhole_table, $tem);
$tem = str_replace("##NMESSAGE##", $message, $tem);




///////////////Konec vpisov
// $ass_name_dropdown    $styleHidden
$tem = str_replace("##SELF##", $REQUEST_URI, $tem);
$tem = str_replace("##STYLEHIDDEN##", $styleHidden, $tem);
$tem = str_replace("##IME##", $name_drop, $tem);

$tem = str_replace("##FIRST##", $first, $tem);
$tem = str_replace("##LAST##", $last, $tem);


$tem = str_replace("##DAYDROP##", $day_dropdown, $tem);
$tem = str_replace("##MONTHDROP##", $month_dropdown, $tem);
$tem = str_replace("##YEARDROP##", $year_dropdown, $tem);

$tem = str_replace("##ADDPERSONDROP##", $person_dropdown, $tem);
$tem = str_replace("##ADDRESPONSNAME##", $responisble_dropdown, $tem);
$tem = str_replace("##ADDACTIVITY##", $activity_dropdown, $tem);
$tem = str_replace("##ADDDESCRIPTION##", $aim_description_textbox, $tem);
$tem = str_replace("##ADDDURATION##", $aim_duration_textbox, $tem);
$tem = str_replace("##ADDACTIVITYNAME##", $aim_name_textbox, $tem);
$tem = str_replace("##LOGS##", $whole_table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = str_replace("##USER##", $identity, $tem);
$tem = str_replace("##TITLE##", $TITLE, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
