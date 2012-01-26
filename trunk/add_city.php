<?php
require_once("inc/config.php");
check_role($ROLE_ADMIN);

$tem = template_open("add_city.tpl");
$tem = template_add_head_foot($tem,head,foot);

$name = $_REQUEST['name'];
$zipcode = $_REQUEST['zip_code'];


if ($_REQUEST['add'] == "Dodaj") {
    if (!is_numeric($zipcode)){
       $message.="Poštna številka mora biti številka";
    }
    Else {
    if($zipcode>9999 || $zipcode<1000){
          $message.="Poštna številka mora biti med 1000 in 9999";}
         else {
	if ($name and $zipcode) {
		//pogledamo kaj imamo in ce je ze tak notr slucajn..        
		$sql = "SELECT id_city FROM city where name='$name' or zip_code='$zipcode'";
		
		$result = $db->fetchOne($sql); 
	
		if ( $result ) {
			$message.="Mesto že obstaja";
		} else {
			//dejansko vnesemo 
			$data = array( 
			    'name'      => $name, 
			    'zip_code'  => $zipcode
			); 
			$db->insert('city', $data);
			$message .= "Mesto je dodano..";
			
		}

	} else {
		$message.= "Izpolni vsa polja!"; 
	}
         }
    }
}



$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>