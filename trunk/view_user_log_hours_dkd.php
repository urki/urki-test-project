<?php

require_once("inc/config.php");
check_role($ROLE_EMPLOYED);
$TITLE = "Seštevek ur za delavce DKD";

$tem = template_open("view_user_log_hours_dkd.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

////////////////////////////
//spremenljivki za mesec ine leto//
if ($mon<1 or $mon>12)
	$mon ='';

if (!$mon)
	$mon = date("m",time());

if (!$year)
	$year = date("Y",time());



/*$sql = "SELECT * FROM log,jobtype where person_id = '$person_id' and jobtype_id=job_id and  year( from_unixtime(START ) ) = $year
AND month( from_unixtime(START ) ) = $mon order by start ASC";
*/
//ZACASNA KOPIJA CE BO KAJ NAROBE
//$sql = "SELECT first as ime, last as priimek, sec_to_time(sum(end)-sum(start))ur
//from (select * from log, persons where id_role=31 and persons.id_person=log.person_id) izpisi
//group by person_id"

$sql = "SELECT first , last , sec_to_time(sum(end)-sum(start))ur
from (select * from log, persons where id_role=31 and persons.id_person=log.person_id) izpisi
group by person_id";



$result = $db->fetchAll($sql);


//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
	$table.=$row;
	$table = str_replace("##FIRST##",$res["first"],$table);
	$table = str_replace("##LAST##",$res["last"],$table);
	$table = str_replace("##TIME##",$res["ur"],$table); //
	$table = str_replace("##DESCRIPTION##",$res["note"],$table);//komentar
//*/	echo "<br>".$res['timestamp']." - ".date("H:i",$res['start'])." - ".date("H:i",$res['stop'])." - ".$res['name']." - ".$res['description'];

}

//$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##LOGS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");

echo $tem;

