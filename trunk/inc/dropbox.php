<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function persondrop(){
$sql = "SELECT * FROM persons";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($lname)) {
        $lname[] ="izberi lokacijo...";
        $lvalue[]="";
    }
    $lname[] .= $res["id"]."; ".$res["name_location"];
    $lvalue[] .= $res["id"];

}
$location_dropdown = html_drop_down_arrays("location_drop",$lname,$lvalue,$location_drop);
return $location_drop;
}//////////////////////

function arraysql($sql,$defname){
    $result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($lname)) {
        $lname[] ="izberi lokacijo...";
        $lvalue[]="";
    }
    $lname[] .= $res["id"]."; ".$res["name_location"];
    $lvalue[] .= $res["id"];

}
$location_dropdown = html_drop_down_arrays("location_drop",$lname,$lvalue,$location_drop);
};
?>
