<?php
require_once("inc/config.php");

$sql = "SELECT  `person_id`,YEAR( FROM_UNIXTIME(  `start` ) )year,COUNT( applic ) as st, work.type
FROM work ,  `work_log` 
WHERE
 person_id=152
AND work.work_id = work_log.work_id
GROUP BY `person_id`,YEAR( FROM_UNIXTIME(  `start` ) )"; 

$result = $db->fetchAll($sql);
foreach ($result as $res) {
 	$out.= '<set label ="'.$res["type"].' tip " value="'.$res["st"].'" /> '."\n";
}		

?>
<chart caption='Kje dela Moudy2' subcaption='2009' xAxisName='Delavnica' yAxisName='Kje dela' numberSuffix=' %'  >
<? echo $out; ?>
</chart>