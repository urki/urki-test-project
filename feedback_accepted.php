<?php

require_once("inc/config.php");
//Role id protection//
check_role($ROLE_USER);


$tem = template_open("feedback_accepted.tpl");
$tem = template_add_head_foot($tem,head,foot);
$tem = str_replace('##USER##',$identity,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>