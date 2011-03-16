<?
require_once("inc/config.php");

$tem = template_open("add_plan.tpl");
$tem = template_add_head_foot($tem);


$work_values=array();
$work_names=array();

//get out different types of work
$sql = "SELECT id,naziv FROM delo"; 
$result = $db->fetchAll($sql);

foreach ($result as $row) {
	 $work_values[] = $row['id'];
	 $work_names[] = $row['naziv'];
}
//create a dropdown
$work_drop =  html_drop_down_arrays("work_id",$work_names,$work_values,'');
//get user id
$sql = "SELECT id FROM users where username='$identity'";
$user_id = $db->fetchOne($sql); 

///form submit

$title = $_REQUEST['title'];
$desc = $_REQUEST['desctiption'];
$price = $_REQUEST['price'];

if ($_REQUEST['form_submit'] == "true") {
	if ($title and $desc and $price) {
		//pogledamo kaj imamo in ce je ze tak notr slucajn..        

		//dejansko vnesemo 
		$data = array( 
			'naziv'      => $title, 
			'id_user'		 => $user_id, 
			'id_delo'      => $work_id 
			); 
		$db->insert('main', $data); 
		$message .= "Delo je  dodano..";



	} else {
		$message.= "Izpolni vsa polja!"; 
	}
}

//form submit end


$tem = str_replace("##WORK_DROP_DOWN##",$work_drop,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>