<?
//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE_EMPLOYED);
$TITLE = "Aktivnosti";

$tem = template_open("aktiv_main.tpl");
$tem = template_add_head_foot($tem,head,blank);


$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>