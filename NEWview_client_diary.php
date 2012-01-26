<?php

require_once(__DIR__."/inc/config.php");
check_role($ROLE_EMPLOYED);

$tem = template_open("NEWview_client_diary.tpl");

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

//spremenljivki za mesec ine leto
if ($mon<1 or $mon>12)
	$mon ='';

if (!$mon)
	$mon = date("m",time());

if (!$year)
	$year = date("Y",time());

//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id<$ROLE_LEADER){
	$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and `assessor_id`=$person_id and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, priim_varov, ime_varov,  zacetek ";
	//    $sql = "SELECT date(from_unixtime(`end`)) datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`="77" and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year";
}
elseif ($role_id<$ROLE_ADMIN and $role_id>$ROLE_LEADER){
	$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, priim_varov, ime_varov, zacetek";
}

else{
	$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id`,`work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, priim_varov asc, ime_varov,  zacetek";
}



$result = $db->fetchAll($sql);


foreach ($result as $res) {
	$table = $row;
	$table = str_replace("##LID##",$res["log_id"],$table);
	$table = str_replace("##LUSERS##",$res["priim_varov"]." ".$res["ime_varov"],$table);
	$table = str_replace("##LDAY##",$res["datum"],$table);
	$table = str_replace("##LSTART##",$res["zacetek"],$table);
	$table = str_replace("##LSTOP##",$res["konec"],$table);
	$table = str_replace("##LNAME##",$res["name"],$table);
	$table = str_replace("##LDESCRIPTION##",$res["comm"],$table);
	$whole_table.=$table;
}
$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");

echo $tem;