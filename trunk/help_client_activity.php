<?
require_once("inc/config.php");
check_role($ROLE_USER);
$TITLE = "&#352ifrant aktivnosti uporabnikov";

$tem = template_open("help_client_activity.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

$sql = 'SELECT `applic`.`name` aname,`work`.`name` wname,`work`.`opis` wopis FROM work,applic where 10>=`work`.`group` and `work`.`applic_id`=`applic`.`applic_id` order by `applic`.`name` '; 

$result = $db->fetchAll($sql);

//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
	$table.=$row;
	$table = str_replace("##APP_NAME##",$res["aname"],$table);
	$table = str_replace("##NAME_WORK##",$res["wname"],$table);
	$table = str_replace("##DESC_WORK##",$res["wopis"],$table);
	//echo "<br>".$res['timestamp']." - ".date("H:i",$res['start'])." - ".date("H:i",$res['stop'])." - ".$res['name']." - ".$res['description'];
}

$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##LOGS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");

echo $tem;


?>
