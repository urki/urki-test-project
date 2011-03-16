<?php


////month dropdown//
for( $x=1;$x<13;$x++) {
	if ($x<10)
   		$names[] .= "0".$x;
	else
		$names[] .=$x;
}
$values = $names;

$month_dropdown = html_drop_down_arrays("mon",$names,$values,date("m",time()));
$tem = str_replace("##MDROP##",$month_dropdown,$tem);
?>