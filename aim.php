<?

require_once("inc/config.php");


check_role($ROLE_USER);
$TITLE = "Cilji";



$tem = template_open("aim_add.tpl") .
        $tem = template_open("aim_stop.tpl");


$tem = template_add_head_foot($tem, "head", "foot");


include 'name_dropdown.php';


//dropdown ocene
$duration = range(1, 5);
$duration_dropdown = html_drop_down_arrays("duration_drop", $duration, $duration, "3"); //date("H",time()));


$day = range(1, 31);
$day_dropdown = html_drop_down_arrays("day_drop", $day, $day, date("j", time()));

$month = range(1, 12);
$month_dropdown = html_drop_down_arrays("month_drop", $month, $month, date("n", time()));


$year = range(2010, (date("Y", time())) + 1);
$year_dropdown = html_drop_down_arrays("year_drop", $year, $year, date("Y", time()));



//nosilec drop down
$sql = "SELECT * FROM `persons` WHERE  20<`id_role` order by unit, letter ASC";
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
$responisble_dropdown = html_drop_down_arrays("responsible_drop", $ResponsibleName, $ResponsibleValue, $ResponsibleName);




//get last used persons_id
$sql = "SELECT persons_id
        FROM aim
        WHERE created_by='$person_id'
        ORDER BY id DESC
        LIMIT 0, 1";
$last_add_user_id = $db->fetchOne($sql);




//person drop down
$sql = "SELECT * FROM `persons` WHERE `id_role`<'11'";
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
$sql = "SELECT * FROM `work` WHERE `group`<'11'";
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
$activity_dropdown = html_drop_down_arrays("activity_drop", $ActivityName, $ActivityValue, $ActivityName);


$aim_name_textbox = html_input_text("aim_name_text", $aim_name_textbox, 25, "default");

$aim_duration_textbox = html_input_text("aim_duration_text", $aim_duration_textbox, 5, "default");

$aim_description_textbox = html_text_area("aim_description_text", $aim_description_textbox,20,50, "htmltextarea");


//$activity1 = $_REQUEST['add'];

if ($_REQUEST['prikazi']) {
	echo $name_drop;
	die();
}

if ($_REQUEST['add'] == "    Vstavi    ") {

    /*
      //Če je administrator se štejejo tudi dnevi in se lahko izbere tudi ocenjevalec
      If ($role_id > 80) {
      $start_time = mktime($hour_start_time_drop, $min_start_time_drop, 0, $month_drop, $day_drop, $year_drop);
      $stop_time = mktime($hour_stop_time_drop, $min_stop_time_drop, 0, $month_drop, $day_drop, $year_drop);
      $pause_time = $pause_hour_time_drop * 3600 + $pause_min_time_drop * 60;
      }
      //če pa je "samo" vodja pa ne more vpisovati dni in ocenjevalca
      else {
      $ass_name_drop = $person_id;
      }
     */

    //dejansko vnesemo
    $data = array(
       'persons_id' => $name_drop,
      //  'persons_id' => $person_drop,
        'persons_id_responsible' => $responsible_drop,
        'name' => $aim_name_text, //$user_id,
        'work_work_id' => $activity_drop,
        'created_by' => $person_id,
        'duration' => $aim_duration_text,
        'description' => $aim_description_text
    );

    print_r($data);

    $db->insert('aim', $data);

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




//$nsql = "SELECT * FROM `work_log` WHERE `assessor_id`=3  and end=0 and start<>0";

$nsql = "SELECT work_log.id, persons.first, persons.last, time_format(from_unixtime(work_log.start),'%H:%i') as begin, work.name as wname, applic.name as aname, work_log.comm
FROM persons right join
                   (`work_log`  left join
                (work
               LEFT JOIN applic on applic.applic_id=work.applic_id) on work_log.work_id=work.work_id)ON persons.id_person=work_log.person_id
 WHERE start<>0 and end=0 and assessor_id=3";

$nresult = $db->fetchAll($nsql);



$count = 0;

foreach ($nresult as $nres) {
    $count++;
    $table = $row;
    $table = str_replace("##EDITFORMNAME##", "editform" . $count, $table);
    $table = str_replace("##NID##", $nres["id"], $table);

    $qpause_hour_time_dropdown = html_drop_down_arrays("pause_hour_time_drop", $qpause_hour_time, $qpause_hour_time, $pause_hour_time_drop); //date("H",time()));
    $qpause_min_time_dropdown = html_drop_down_arrays("pause_min_time_drop", $qpause_min_time, $qpause_min_time, $pause_min_time_drop); //date("H",time()));
    $table = str_replace("##PAUSEHOUR##", $qpause_hour_time_dropdown, $table);
    $table = str_replace("##PAUSEMINUTES##", $qpause_min_time_dropdown, $table);


    $qrating_dropdown = html_drop_down_arrays("rating_drop", $qrating, $qrating, "3"); //date("H",time()));
    $table = str_replace("##RATING##", $qrating_dropdown, $table);

    $nactivitystop_textbox = html_input_text("name_drop", (substr($nres[aname], 0, 8) . "...   " . $nres[wname]), 30, "textbox_red");
    $nname_textbox = html_input_text("name_drop", ($nres['first'] . " " . $nres['last']), 25, "textbox_red");
    $nstart_textbox = html_input_text("name_drop", $nres["begin"], 2, "textbox_red");
    $table = str_replace("##NSTART##", $nstart_textbox, $table);
    $table = str_replace("##ACTIVITYSTOP##", $nactivitystop_textbox, $table);
    $table = str_replace("##NAMEDROPSTOP##", $nname_textbox, $table);

    //$name_dropdown = html_drop_down_arrays("name_drop", $names, $values, $nres["person_id"], "dropdown_red");
    //$activity_stop_dropdown = html_drop_down_arrays("activity_drop", $ActivityName, $ActivityValue, $nres["work_id"], "dropdown_red");
    //$table = str_replace("##NAMEDROPSTOP##", $name_dropdown, $table);
    //$table = str_replace("##ACTIVITYSTOP##", $activity_stop_dropdown, $table);
    $table = str_replace("##DDESCRIPTION##", $nres["comm"], $table);
    $nwhole_table.=$table;
}
$tem = str_replace("##NLOGS##", $nwhole_table, $tem);
$tem = str_replace("##NMESSAGE##", $message, $tem);



for ($i = 1; $i < $count + 1; $i++) {
    if ($_REQUEST['editform' . $i] == "Končaj") {
        $stop_time = time ();
        $pause_time = $pause_hour_time_drop * 3600 + $pause_min_time_drop * 60;

        //dejansko vnesemo
        $db->query('UPDATE work_log SET end="' . $stop_time . '", comm="' . $tekst . '" where id =' . $nid . '');

        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

///////////////Konec vpisov
// $ass_name_dropdown
$tem = str_replace("##SELF##", $REQUEST_URI, $tem);
$tem = str_replace("##ADDPERSONDROP##", $person_dropdown, $tem);
$tem = str_replace("##ADDRESPONSNAME##", $responisble_dropdown, $tem);
$tem = str_replace("##ADDACTIVITY##", $activity_dropdown, $tem);
$tem = str_replace("##ADDDESCRIPTION##", $aim_description_textbox, $tem);
$tem = str_replace("##ADDDURATION##", $aim_duration_textbox, $tem);
$tem = str_replace("##ADDACTIVITYNAME##", $aim_name_textbox, $tem);
$tem = str_replace("##LOGS##", $whole_table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
