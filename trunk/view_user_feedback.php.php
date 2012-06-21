<?php

require_once("inc/config.php");
check_role($ROLE_LEADER);
$TITLE = "Pregled vseh zapisov za";

$tem = template_open("view_user_diary.tpl");
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

//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id<80){
     $sql = "SELECT * FROM log,jobtype,persons where jobtype_id=job_id and person_id=id_person and unit=$role_id and id_role>30 and month(from_unixtime(START))=$mon   and year( from_unixtime(START ) )=$year order by last, first, start ASC"; 
}
else {
   $sql = "SELECT * FROM log,jobtype,persons where jobtype_id=job_id and person_id=id_person and id_role>30 and month(from_unixtime(START))=$mon   and year( from_unixtime(START ) )=$year order by last, first, start ASC";
}
//$sql = "SELECT * FROM log,jobtype where  jobtype_id=job_id order by timestamp ASC"; 

$result = $db->fetchAll($sql);



//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
	$table.=$row;
	$table = str_replace("##ID##",$res["log_id"],$table);
	$table = str_replace("##USERS##",$res["last"]." ".$res["first"],$table);
	$table = str_replace("##DAY##",date("D d.M.Y",$res[start]),$table);
	$table = str_replace("##START##",date("H:i",$res["start"]),$table);
	$table = str_replace("##STOP##",date("H:i",$res["end"]),$table);
	$table = str_replace("##NAME##",$res["name"],$table);
	$table = str_replace("##DESCRIPTION##",$res["note"],$table);
	//echo "<br>".$res['timestamp']." - ".date("H:i",$res['start'])." - ".date("H:i",$res['stop'])." - ".$res['name']." - ".$res['description'];
}
$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");

echo $tem;