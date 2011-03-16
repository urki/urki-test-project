<?
require_once("inc/config.php");
check_role($ROLE_USER);


$tem = template_open("help_main.tpl");
$tem = template_add_head_foot($tem,head,foot);

if ($role_id) {
	switch ($role_id) {
		case ($role_id >= $ROLE_ADMIN):
			$tem = str_replace("##IF_ADMIN##","",$tem);
			$tem = str_replace("##IF_LEADER##","",$tem);
		break;
		case ($role_id <= $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
		break;
					
		case ($role_id <= $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
			$tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
		break;
						
		default:
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
			$tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
			$tem =  template_clean_up_tags($tem,"##IF_EMPLOYED##",1);
			//$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
	}
				
	} else  {
			$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
			$head =  template_clean_up_tags($head,"##IF_USER##",1);
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
			$tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
			$tem =  template_clean_up_tags($tem,"##IF_EMPLOYED##",1);
}

$tem = str_replace('##TEXT##',"prijavljen uporabnik:",$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem=template_clean_up_tags($tem,"##");
echo $tem;

?>
