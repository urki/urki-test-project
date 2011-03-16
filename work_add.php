<?
require_once("inc/config.php");

$tem = template_open("work_add.tpl");
$tem = template_add_head_foot($tem,head,foot);

$title = $_REQUEST['title'];
$desc = $_REQUEST['desctiption'];
$price = $_REQUEST['price'];

if ($_REQUEST['form_submit'] == "true") {
	if ($title and $desc and $price) {
		//pogledamo kaj imamo in ce je ze tak notr slucajn..        
		$sql = "SELECT naziv FROM delo  where naziv='$title'"; 
		
		$result = $db->fetchOne($sql); 
	
		if ( $result ) {
			$message.="Delo ze obstaja";
		} else {
			//dejansko vnesemo 
			$data = array( 
			    'naziv'      => $title, 
			    'opis'		 => $desc, 
			    'cena'      => $price 
			); 
			$db->insert('delo', $data); 
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