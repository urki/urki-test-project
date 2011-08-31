<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$unit=78;
$names ="";
$values = "";
$sql = "SELECT * FROM persons WHERE $ROLE_USER>=`id_role` and unit=$unit order by letter ASC";
//var_dump($sql);
$result = $db->fetchAll($sql);
foreach ($result as $res) {

	$names[] .= $res["last"]." ".$res["first"];
	$values[] .= $res["id_person"];
}
$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop);

$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);

