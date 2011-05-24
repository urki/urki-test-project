<?php

$time = time();
require_once("inc/config.php");
check_role($ROLE_EMPLOYED);
$TITLE = "Pregled vpisanih aktivnosti za";

$tem = template_open("view_client_diary.tpl");
$tem = template_add_head_foot($tem, head, foot);

$tmp = template_get_repeat_text("##START_LOG##", "##STOP_LOG##", "##LOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];


if (!$id) {
    $id = "<>0";
} else {
    $id = "=$id";
    $role_id = 80;
}
//spremenljivki za mesec ine leto
if ($mon < 1 or $mon > 12)
    $mon = '';

if (!$mon)
    $mon = date("m", time());

if (!$year)
    $year = date("Y", time());



//Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!









//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id < $ROLE_LEADER) {
    $sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where id$id and `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and `assessor_id`=$person_id and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, letter, ime_varov,  zacetek ";
   
    echo $sql;
} elseif ($role_id < $ROLE_ADMIN and $role_id > $ROLE_LEADER) {
    $sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where id$id and `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, letter, ime_varov, zacetek";
    echo $sql;
//    $sql = "SELECT *
//FROM (
//
//SELECT id AS log_id, date_format( from_unixtime( `end` ) , '%d.%m.%Y' ) datum, `persons`.`first` ime_varov, `persons`.`last` priim_varov, `work`.`name` , time( from_unixtime( `start` ) ) zacetek, time( from_unixtime( `end` ) ) konec, `work_log`.`assessor_id` , `work_log`.`comm`
//FROM `work_log` , `work` , `persons`
//WHERE id$id
//AND `work`.`work_id` = `work_log`.`work_id`
//AND `unit`=$unit
//AND `persons`.`id_person` = `work_log`.`person_id`
//AND `assessor_id` >0
//AND month( from_unixtime( `end` ) ) =$mon
//AND year( from_unixtime( `end` ) ) =$year
//ORDER BY datum DESC , letter ASC , ime_varov, zacetek
//) AS workLog
//LEFT JOIN (
//
//SELECT id, id_person,
//FIRST as assfirst, last as asslast
//FROM `work_log`
//LEFT JOIN persons ON assessor_id = id_person
//)asses ON asses.id_person = workLog.assessor_id
//";
//

} else {
    $sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id`,`work_log`.`comm` from `work_log`,`work`,`persons`  where id$id and `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, letter asc, ime_varov,  zacetek";
//    $sql = "SELECT *
//FROM (
//
//SELECT id AS log_id, date_format( from_unixtime( `end` ) , '%d.%m.%Y' ) datum, `persons`.`first` ime_varov, `persons`.`last` priim_varov, `work`.`name` , time( from_unixtime( `start` ) ) zacetek, time( from_unixtime( `end` ) ) konec, `work_log`.`assessor_id` , `work_log`.`comm`
//FROM `work_log` , `work` , `persons`
//WHERE id$id
//AND `work`.`work_id` = `work_log`.`work_id`
//AND `persons`.`id_person` = `work_log`.`person_id`
//AND `assessor_id` >0
//AND month( from_unixtime( `end` ) ) =$mon
//AND year( from_unixtime( `end` ) ) =$year
//ORDER BY datum DESC , letter ASC , ime_varov, zacetek
//) AS workLog
//LEFT JOIN (
//
//SELECT id, id_person,
//FIRST as assfirst, last as asslast
//FROM `work_log`
//LEFT JOIN persons ON assessor_id = id_person
//)asses ON asses.id_person = workLog.assessor_id
//";



    echo $sql;
}

//echo $sql;

$result = $db->fetchAll($sql);

$time2 = time();
$x=0;
//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
    $x=$x+1;
    $time4=microtime();
    $table.= $row;

    //echo $table."<br><hr>";
    $table = str_replace("##ID##", $res["log_id"], $table);
    $table = str_replace("##USERS##", $res["priim_varov"] . " " . $res["ime_varov"], $table);
    $table = str_replace("##DAY##", $res["datum"], $table);
    $table = str_replace("##START##", $res["zacetek"], $table);
    $table = str_replace("##STOP##", $res["konec"], $table);
    $table = str_replace("##NAME##", $res["name"], $table);
    $table = str_replace("##DESCRIPTION##", $res["comm"], $table);
    $time5=microtime();
    $time54=$time5-$time4;
    echo "$x. krog je trajal $time54 <hr>";
   // $table = str_replace("##ASSESSOR##", $res["asslast"] . " " . $res["assfirst"], $table);
    //echo "<br>".$res['timestamp']." - ".date("H:i",$res['start'])." - ".date("H:i",$res['stop'])." - ".$res['name']." - ".$res['description'];
   // $whole_table.=$table;
}

$tem = str_replace("##MONTH##", " " . $mon . "/" . $year, $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
//$tem = str_replace("##LOGS##", $whole_table, $tem);


$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");
$time3 = time();
$timeque=$time2-$time;
$timeres=$time3-$time2;
echo "<hr>cas query:$timeque<hr>";
echo "<hr>cas pisanja:$timeres<hr>";

echo $tem;