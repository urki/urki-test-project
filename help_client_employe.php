<?
require_once("inc/config.php");
check_role($ROLE_USER);
$TITLE = "&#352ifrant aktivnosti zaposlenih";

$tem = template_open("help_client_employe.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

$sql = "SELECT `work`.`applic_id` applic_id,`work`.`subcat_id` subcat_id,`applic`.`name` aname,`work`.`name` wname,`work`.`opis` wopis FROM work,applic where `work`.`applic_id`=`applic`.`applic_id` and `work`.`group`>$ROLE_USER and $role_id>=`group` order by `work`.`applic_id`,`work`.`subcat_id`"; 

$result = $db->fetchAll($sql);

//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
foreach ($result as $res) {
	$table.=$row;
	$table = str_replace("##APP_ID##",$res["applic_id"],$table);
	$table = str_replace("##WORK_ID##",$res["subcat_id"],$table);
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
