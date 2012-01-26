<?php
require_once("inc/config.php");
check_role($ROLE_ADMIN);

$tem = template_open("add_street.tpl");
$tem = template_add_head_foot($tem,head,foot);

$name = $_REQUEST['name'];


if ($_REQUEST['add'] == "Dodaj") {
    if (is_numeric($name)){
       $message.="Vnesi samo ulico - ne številke";
    }
    Else {
    	if ($name) {
		//pogledamo kaj imamo in ce je ze tak notr slucajn..        
		$sql = "SELECT name FROM street where name='$name'";
		
		$result = $db->fetchOne($sql); 
	
		if ( $result ) {
			$message.="Ulica že obstaja";
		} else {
			//dejansko vnesemo 
			$data = array( 
			    'name'      => $name, 			
			); 
			$db->insert('street', $data);
			$message .= "Ulica je dodana..";
			
		}

	} else {
		$message.= "Izpolni vsa polja!"; 
	}
         }
   }



$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>