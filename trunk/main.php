<?php
require_once("inc/config.php");


check_role(78,"index.php");
$tem = template_open("main.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tem = str_replace('##USER##',$identity,$tem);
$tem=template_clean_up_tags($tem,"##");
echo $tem;

?>