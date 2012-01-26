<?php

function date_work_days($year,$month, $sum = FALSE ) {
	global $db;
	if (!$year or !$month) {
		$year = date("Y",time());
	$month = date("m",time());
        }
	if (!$sum)	
		$sql = "SELECT days FROM working_days where year='$year' and month='$month'";
	else 
		$sql = "select sum(days) from working_days where year='$year'";
	error_log($sql, 0);	
	$working_days = $db->fetchOne($sql);
	return $working_days;
}

function working_hours_p_day($result = FALSE) {
	/*global $db;
	$sql = "SELECT * , FROM_UNIXTIME( 
	START ) , FROM_UNIXTIME( 
		END ) 
		FROM  `work_log` 
		WHERE  `assessor_id` =24
	AND DATE( FROM_UNIXTIME( 
		END ) ) like  '2009%' order by start";
	$result = $db->fetchAll($sql);
	*/$x=0;
	$first_time = true;
	foreach ($result as $res) {
		if ($first_time) {
			$min[$x] = $res["start"];
			$max[$x] = $res["end"];
			$first_time = false;
		}
		if ($res["start"]>$max[$x]) {
			//echo "LUKNA";
			$x++;
			$min[$x] = $res["start"];
			$max[$x] = $res["end"];
		}
		//echo $res["end"]." vs". $max["$x"]."<br>";
		if ($res["end"]>$max[$x]) {
			$max[$x]=$res["end"];
			//echo "Povecal <br>";
		}
	}

	$count = count($min);
	for ($x=0;$x<$count;$x++) {
		$sum += ($max[$x]-$min[$x]);
	}
	//print_r($min);
	//print_r($max);
	return ($sum/3600);
}
