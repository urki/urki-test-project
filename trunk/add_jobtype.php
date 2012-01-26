<?php
require_once("inc/config.php");
check_role($ROLE_ADMIN);

$tem = template_open("add_jobtype.tpl");
$tem = template_add_head_foot($tem);

$name = $_REQUEST['name'];
$desc = $_REQUEST['description'];


if ($_REQUEST['add'] == "Dodaj") {
	if ($name and $desc ) {
		//pogledamo kaj imamo in ce je ze tak notr slucajn..        
		$sql = "SELECT job_id FROM jobtype  where name='$name'"; 
		
		$result = $db->fetchOne($sql); 
	
		if ( $result ) {
			$message.="Delo ze obstaja";
		} else {
			//dejansko vnesemo 
			$data = array( 
			    'name'      => $name, 
			    'description'		 => $desc
			); 
			$db->insert('jobtype', $data); 
			$message .= "Delo je  dodano..";
			
		}

	} else {
		$message.= "Izpolni vsa polja!"; 
	}
}



$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>