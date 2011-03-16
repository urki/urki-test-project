<?php

require_once("inc/config.php");
check_role($ROLE_EMPLOYED);
$TITLE = "Glavna stran";

$tem = template_open("view_notice.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];



//spremenljivki za mesec ine leto//
if ($mon<1 or $mon>12)
    $mon ='';

if (!$mon)
    $mon = date("m",time());

if (!$year)
    $year = date("Y",time());


$sql = "SELECT * FROM log,jobtype where person_id = '$person_id' and jobtype_id=job_id and  year( from_unixtime(START ) ) = $year 
AND month( from_unixtime(START ) ) = $mon order by start ASC";


$result = $db->fetchAll($sql);

//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
    $table.=$row;
    $table = str_replace("##DAY##",date("d.m.Y",$res[start]),$table);
    $table = str_replace("##START##",date("H:i",$res["start"]),$table);
    $table = str_replace("##STOP##",date("H:i",$res["end"]),$table);
    $table = str_replace("##NAME##",$res["name"],$table);
    $table = str_replace("##DESCRIPTION##",$res["note"],$table);
}





$tem = str_replace("##DATE##"," ".returnDate(date("N"), "day") . ", " . date("j") . " " . returnDate(date("n"), "month") . " " . date("Y"),$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##LOGS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");

echo $tem;


