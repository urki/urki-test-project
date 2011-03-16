<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$Y = date("Y",time());
for ($x=2009; $x<=$Y;$x++) {
	$ynames[].= $x;
}
$yvalues = $ynames;
$year_dropdown = html_drop_down_arrays("year",$ynames,$yvalues,date("Y",time()));

$tem = str_replace("##YDROP##",$year_dropdown,$tem);

?>