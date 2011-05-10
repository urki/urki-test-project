<?php

$DO_NOT_REDIRECT="true";
require_once("inc/config.php");

$tem = template_open("eval.tpl");
$tem = template_add_head_foot($tem);



$sql = "SELECT * FROM persons"; 

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	$names[] .= $res["first"]." ".$res["last"];
	$values[] .= $res["id_person"];
}

$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop); 


$sql = "SELECT * FROM jobtype"; 

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	$names_job[] .= $res["name"];
	$values_job[] .= $res["job_id"];
}

$job_dropdown = html_drop_down_arrays("job_drop",$names_job,$values_job,$job_drop); 





$name = $_REQUEST['name'];

if ($_REQUEST['add'] == "Dodaj") {

	$start_time = mktime ($HOUR_START, $MIN_START, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
	$stop_time = mktime ($HOUR_STOP, $MIN_STOP, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));

	if ($name_drop and $job_drop and $start_time and $stop_time) {
		$sql = "SELECT timestamp FROM log  where person_id = '$name_drop' and start='$start_time' and end='$stop_time'"; 
		$result = $db->fetchOne($sql);
		if (!$result) {


			//dejansko vnesemo 
			$data = array( 
				'person_id'      => $name_drop,
				'jobtype_id'	 => $job_drop,
				'start'			 => $start_time,
				'end'			 =>	$stop_time,
				'note'		     => $note
				); 
			$db->insert('log', $data); 
			$message .= "Vnos je dodan";
		}


	} else {
		$message.= "Izpolni vsa polja!"; 
	}
}

$tem = str_replace("##JOB_DROP##",$job_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>