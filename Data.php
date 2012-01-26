<?php

require_once("inc/config.php");

//&type_q=1&period=2009&person_id=88
$type_q = $_REQUEST["type_q"];
$period = $_REQUEST["period"];
$person_id = $_REQUEST["person_id"];
$title_graph = $_REQUEST["title_graph"];
$subtitle = $_REQUEST["subtitle"];



error_log($_SERVER["QUERY_STRING"], 0);

$suffix = "ur";
$x_axis = "Aktivnost";
$y_axis = "Ure";


if ($period>3000)  {
	$mon = $period[0].$period[1];
	$year = $period[2].$period[3].$period[4].$period[5];
} else {
	$year = $period;
}
echo $period;
switch ($type_q) {
	case "1": 
	if (!$mon) {
		$sql = "SELECT  `person_id`,YEAR( FROM_UNIXTIME(  `start` ) )year,hour(sec_to_time(sum(`end`-`start`)))as st, applic_type.name typeName
			FROM work ,  `work_log`, applic_type
			WHERE
                              applic_type.id_a_type=work.type 
                          AND person_id=$person_id
			  AND work.work_id = work_log.work_id  
                          AND YEAR( FROM_UNIXTIME(  `start` ) )=$year
		        GROUP BY type,YEAR( FROM_UNIXTIME(  `start` ) )";
} else {
	$sql = "SELECT  `person_id`,MONTH( FROM_UNIXTIME(  `start` ) )month, hour(sec_to_time(sum(`end`-`start`)))as st, applic_type.name typeName
		FROM work ,  `work_log`, applic_type 
		WHERE
                      applic_type.id_a_type=work.type
		  AND person_id=$person_id
	          AND work.work_id = work_log.work_id 
                  AND MONTH( FROM_UNIXTIME(  `start` )) =$mon 
                  AND YEAR( FROM_UNIXTIME(  `start` ) )=$year
                GROUP BY type, month( FROM_UNIXTIME(  `start` ) )";
}
$field = "typeName";
break;


case "2":
if (!$mon) {
	$sql = "SELECT  `person_id`,applic,YEAR( FROM_UNIXTIME(  `start` ) )year,hour(sec_to_time(sum(`end`-`start`)))as st, work.type  as type
		FROM work ,  `work_log`
		WHERE
		person_id=$person_id
		AND work.work_id = work_log.work_id AND YEAR( FROM_UNIXTIME(  `start` ) )=$year
	GROUP BY applic, YEAR( FROM_UNIXTIME(  `start` ) ),type order by type";
} else {
	$sql = "SELECT  `person_id`,applic,MONTH( FROM_UNIXTIME(  `start` ) )month,hour(sec_to_time(sum(`end`-`start`)))as st
		FROM work ,  `work_log`
		WHERE
	MONTH( FROM_UNIXTIME(  `start` ) )=$mon AND YEAR( FROM_UNIXTIME(  `start` ) )=$year and person_id= $person_id
	AND work.work_id = work_log.work_id
GROUP BY applic,`person_id`,MONTH( FROM_UNIXTIME(  `start` ) ) order by month, type";
}
$field = "applic";
break;



case "3":
$x_axis = "mesci";
$y_axis = "prisotnost";
if (!$mon) {
	/*$sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum, DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%d' ) dan,  `persons`.`first` ime,  `persons`.`last` priimek, person_id
		FROM  `work_log` ,  `persons` 
		WHERE  `persons`.`id_person` =  `work_log`.`person_id` 
		AND persons.id_person = $person_id
	AND DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%Y %m' ) LIKE  '".$year."%'
	GROUP BY datum, person_id
	ORDER BY dan desc";
	$result = $db->fetchAll($sql);

         */
    $dal=new DAL();
    $result=$dal->get_presence_graph_by_person_year($person_id,$year);

	$dnipri =count($result);
	$prisotnost = round($dnipri / date_work_days($year,11,"celo leto") * 100);
	$out= '<set label ="prisotnost celotna " value="'.$prisotnost.'" /> '."\n";
	$suffix = "%";
	//po mescih//
	unset($pris_mesec);
	$pris_mesec=array();
	foreach ($result as $res) {
		$datum = $res["datum"];
		$datum_mesec = explode("-",$datum);
		$datum_mesec = $datum_mesec[1];
		$pris_mesec[$datum_mesec] ++;
	}
	for($x=1;$x<13;$x++) {
		if ($x<10) $x = "0".$x;
		$prisotnost =round($pris_mesec[$x] / date_work_days($year,$x)  * 100);
		$out.= '<set label ="'.$x.' mesec " value="'.$prisotnost.'" /> '."\n";
	}
	
} else {
	$sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum, DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%d' ) dan,  `persons`.`first` ime,  `persons`.`last` priimek, person_id
		FROM  `work_log` ,  `persons` 
		WHERE  `persons`.`id_person` =  `work_log`.`person_id` 
		AND persons.id_person = $person_id
	AND DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%Y %m' ) LIKE  '".$year." ".$mon."%'
	GROUP BY datum, person_id
	ORDER BY dan desc";
	$result = $db->fetchAll($sql);
	$dnipri =count($result);
	$prisotnost = round($dnipri / date_work_days($year,$mon)  * 100);
	$out= '<set label ="prisotnost " value="'.$prisotnost.'" /> '."\n";
	$suffix = "%";
}
break;


case "4":
if (!$mon) {
	
	for ($x=1;$x<13;$x++) {
	if ($x<10) $x = "0".$x;
	
	$sql = "SELECT * , FROM_UNIXTIME( 
	START ) , FROM_UNIXTIME( 
		END ) 
		FROM  `work_log` 
	WHERE  `assessor_id` = $person_id
	AND DATE( FROM_UNIXTIME( 
		END ) ) like  '".$year."-".$x."%' order by start";
	$result = $db->fetchAll($sql);
	$whour = round(working_hours_p_day($result));
	$whour_all +=$whour;
	$out.= '<set label =" mesec '.$x.' " value="'.$whour.'" /> '."\n";
	}
	$out = '<set label =" skupaj " value="'.$whour_all.'" /> '."\n".$out;
} else {
	$sql = "SELECT * , FROM_UNIXTIME( 
	START ) , FROM_UNIXTIME( 
		END ) 
		FROM  `work_log` 
	WHERE  `assessor_id` = $person_id
	AND DATE( FROM_UNIXTIME( 
		END ) ) like  '".$year."-".$mon."%' order by start";
		
		
		$result = $db->fetchAll($sql);
		$whour = round(working_hours_p_day($result));
		$out.= '<set label =" oseba'.$person_id.' " value="'.$whour.'" /> '."\n";
}
$field = "applic";
break;

}
error_log($sql, 0);
if (!$out) {
	$result = $db->fetchAll($sql);
	foreach ($result as $res) {
		$out.= '<set label ="'.str_sumniki($res[$field]).' " value="'.$res["st"].'" /> '."\n";
	}		
}
error_log($out, 0);
?>
	<chart caption='<?php echo $title_graph; ?> ' subcaption='<?php echo $subtitle; ?>' xAxisName='<?php echo $x_axis; ?>' yAxisName='<?php echo $y_axis; ?>' numberSuffix='<?php echo $suffix; ?>'  showExportDataMenuItem='1' >
<?php echo $out; ?>
</chart>
