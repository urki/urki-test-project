<?php

require_once("inc/config.php");
check_role($ROLE_EMPLOYED);
$TITLE = "Lastna evidenca za";

$tem = template_open("view_user_aim.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

////////////////////////////
//dodatek za izbiro meseca vendar bi dal v nov php in tega dal v header view_user_log.tpl, kjer bi bil tudi gumb submit.  Solution2 - �e bolje kar AJAX
/*$sql = "SELECT * FROM arrays where type='1' order by name ASC"; 

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($names_arrays)) {
		$names_arrays[] ="izberi mesec...";
		$values_arrays[]="";
	}
	$names_arrays[] .= $res["name"];
	$values_arrays[] .= $res["job_id"];
}

$job_dropdown = html_drop_down_arrays("job_drop",$names_arrays,$values_arrays,$job_drop); 
$mon=$values_arrays;*/
/////////////////////


//spremenljivki za mesec ine leto//
if ($mon<1 or $mon>12)
	$mon ='';

if (!$mon)
	$mon = date("m",time());

if (!$year)
	$year = date("Y",time());

/* //zacasni poiskusi//
$mesec_start = mktime (0, 0, 0, $mon, 1, $year );
$last_day = date("t",$mesec_start);
$mesec_end  = mktime (0,0,0,$mon,$last_day,$year);
//////////////////////////
echo "mesec_start=".$mesec_start;
echo " "."in"."last day".$last_day;
echo " "."in"."mesec_end".$mesec_end;*/

///////////////////////////
//izpis po trenutnem mesecu ampak ker rabim dolocenega sem tega zakomentiral
/*$sql = "SELECT * FROM log,jobtype where person_id = '$person_id' and jobtype_id=job_id and  year( from_unixtime(START ) ) = year( current_date ) 
AND month( from_unixtime(START ) ) = month( current_date )order by start ASC";*/
//izpis po trenutnem mesecu ampak ker rabim dolocenega sem dodal spremenljivki za mesec in leto in tako dobil naslednjo vrstico
///////////////////////////


$sql = "SELECT * FROM log,jobtype where person_id = '$person_id' and jobtype_id=job_id and  year( from_unixtime(START ) ) = $year 
AND month( from_unixtime(START ) ) = $mon order by start ASC";


//izpis brez dolocenega meseca - tega sem zacsno onesposobil
//$sql = "SELECT * FROM log,jobtype where person_id = '$person_id' and jobtype_id=job_id order by start ASC"; 
///////////////

//prvotni query
//$sql = "SELECT * FROM log,jobtype where  jobtype_id=job_id order by timestamp ASC"; 
/////////////////

$result = $db->fetchAll($sql);

//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
	$table.=$row;
	$table = str_replace("##DAY##",date("d.m.Y",$res[start]),$table);
	$table = str_replace("##START##",date("H:i",$res["start"]),$table);
	$table = str_replace("##STOP##",date("H:i",$res["end"]),$table);
	$table = str_replace("##NAME##",$res["name"],$table);
	$table = str_replace("##DESCRIPTION##",$res["note"],$table);
	//echo "<br>".$res['timestamp']." - ".date("H:i",$res['start'])." - ".date("H:i",$res['stop'])." - ".$res['name']." - ".$res['description'];
}

$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##LOGS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");

echo $tem;