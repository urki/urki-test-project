<?php
require_once("inc/config.php");
check_role($ROLE_ADMIN);

$tem = template_open("add_user.tpl");
$tem = template_add_head_foot($tem,head,foot);

$username = ereg_replace("[^[A-z]]","",$_REQUEST['username']);
$password = ereg_replace("[^[A-z]]","",$_REQUEST['password']);
$first = ereg_replace("[^[:alnum:] ]","",$_REQUEST['first']);
$last = ereg_replace("[^[:alnum:] ]","",$_REQUEST['last']);



$sql = "SELECT * FROM TitleGroup";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	$names[] .= $res["name"];
	$values[] .= $res["id_role"];
}

$role_dropdown = html_drop_down_arrays("role_drop",$names,$values,""); 



if ($_REQUEST['add'] == "Dodaj") {
	//echo $username."-".$password."-".$first."-".$last."-".$role_drop;
	if ($username and $password and $first and $last) {
		//pogledamo kaj imamo in ce je ze tak notr slucajn...       
		$sql = "SELECT first FROM persons where first='$first' and last='$last'"; 

		$result = $db->fetchOne($sql); 

		if ( $result ) {
			$message.="Uporabnik ze obstaja";
		} else {
			// dejansko vnesemo 
			$data = array( 
				'username'      => $username, 
				'passwd'		 => $password, 
				'first'      => $first,
				'last'		=> $last,
				'id_role'	=> $role_drop
				); 
			$db->insert('persons', $data); 
			$message .= "Uporabnik dodan..";

		}

	} else {
		$message.= "Izpolni vsa polja!"; 
	}
}



$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = str_replace("##ROLE_DROPDOWN##",$role_dropdown,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>