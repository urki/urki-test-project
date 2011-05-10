<?php

require_once("inc/config.php");

$tem = template_open("ocenjevanje.tpl");
$sql = "SELECT * FROM persons"; 

/*$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($names)) {
		$names[] ="izberi ime...";
		$values[]="";
	}
	$names[] .= $res["first"]." ".$res["last"];
	$values[] .= $res["first"]." ".$res["last"];
}

$name_dropdown = html_drop_down_arrays("entry.1.single",$names,$values,$name_drop); 
*/


$sql = "SELECT * FROM applic"; 

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($aname)) {
		$aname[] ="izberi program...";
		$avalue[]="";
	}
	$aname[] .= $res["name"];
	$avalue[] .= $res["name"];
}

$appl_dropdown = html_drop_down_arrays("entry.4.single",$aname,$avalue,$appl_drop); 



$sql = "SELECT * FROM work WHERE $ROLE_USER>=`group`  order by applic";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($wname)) {
		$wname[] ="izberi delo...";
		$wvalue[]="";
	}
	$wname[] .= $res["applic"]."; ".$res["name"];
	$wvalue[] .= $res["applic"]."; ".$res["name"];
	
}
$work_dropdown = html_drop_down_arrays("entry.5.single",$wname,$wvalue,$work_drop); 



$tem = str_replace('##USER##',$identity,$tem);
//$tem = str_replace('##NAMES##',$name_dropdown,$tem);
//$tem = str_replace('##PROGRAM##',$appl_dropdown,$tem);



$tem = str_replace('##WORK##',$work_dropdown,$tem);
$tem=template_clean_up_tags($tem,"##");
echo $tem;

?>