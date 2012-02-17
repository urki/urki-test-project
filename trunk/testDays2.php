<?php
require_once("inc/config.php");

check_role($ROLE_LEADER);


function dates_inbetween($date1, $date2) {

    $day = 60 * 60 * 24;

    $date1 = strtotime($date1);
    $date2 = strtotime($date2);

    $days_diff = round(($date2 - $date1) / $day); // Unix time difference devided by 1 day to get total days in between

    $dates_array = array();

    $dates_array[] = date('Y-m-d', $date1);

    for ($x = 1; $x < $days_diff; $x++) {
        $dates_array[] = date('Y-m-d', ($date1 + ($day * $x)));
    }

    $dates_array[] = date('Y-m-d', $date2);

    return $dates_array;
}

// Usage
$dates_array = dates_inbetween('2010-01-01', '2010-01-31');


for ($x=1;$x<13;$x++) { 
//gremo cez vse mesce ///

$from_date = "2010-".$x."-01";
$to_date = "2010-".$x."-".date("t",strtotime($from_date));


$dates_array = dates_inbetween($from_date, $to_date);



$prazniki = array('2010-01-01', '2010-02-08','2010-04-05', '2010-04-27','2010-06-25','2010-11-01');

$number_days=0;
unset($percentage_month);

$percentage_month=array();
foreach ($dates_array as $date) {
    $weekday = date('l', strtotime($date)); // note: first arg to date() is lower-case L
    $weekdaynum = date('w', strtotime($date));


    if (($weekdaynum > 0) && ($weekdaynum < 6)) {

	$free_day = FALSE;
        foreach ($prazniki as $praznik) {
            if ($praznik == $date) {
             $free_day = $praznik;
	     $continue;
            }
        }
       
	if ($free_day) {
	       //echo $date ." = " .$free_day."<br>"; // praznik//
		continue; //za ta datum in gremo na novga//
 	} else  {
 	
		//gledama za ta dan//
		$number_days++;
		$q = new DAL();
		$q2 = new DAL();
		unset($res_work);
		$res_work = $q->get_count_persons_available_by_date($date);
		//if ($x==12) print_r($res_work);
		//var_dump($res_work);
		//die()
		
		foreach ($res_work as $work_c) {

			$unit_id = $work_c["unit_id"];
			$stevilo = $work_c["stevilo"];
			//if ($unit_id==77 and $x==12) echo $date." ".$stevilo."   ----   ".print_r($work_c)."<br><br><hr>";
			$work_count[$date][$unit_id]=$stevilo;
			//echo $stevilo." - u:". $unit_id."  $date <br>";		
		}
				  
		unset($res_full);
		$res_full =  $q2->get_count_persons_registered_by_unit($date);
		
		//if ($x==12  ) print_r($res_full);
	//	var_dump($res_full);
		foreach ($res_full as $all) { 
                        $unit_id = $all["unit_id"];
			$stevilo = $all["stevilo"];
			$all_sum[$unit_id]=$stevilo;
			if ($work_count[$date][$unit_id]==0) continue;
			//echo $stevilo." ALL -".$unit_id."<br>";
			//if ($unit_id==77 and $x==12)	echo "dodal bom v percentage month:". $work_count[$date][$unit_id]/$all_sum[$unit_id]. " ( ".$work_count[$unit_id]." / ". $all_sum[$unit_id].") $date <br>"; 
			$percentage_month[$unit_id]+=$work_count[$date][$unit_id]/$all_sum[$unit_id];
                	//echo "noter";	
		} 

	}
    }
}

///print out report///
//print_r($percentage_month);
//die();

foreach ($percentage_month as $key => $percent) {
	//echo $key." - value ".$percent."/".$number_days." =====";
	$end_result[$key][$x]=$percent*100/$number_days;
	
}
}

foreach ($end_result as $key => $value ) {
	if ($key == 0)  continue;
	echo "$key;";
	$sum ='';
	for ($x=1;$x<13;$x++) {
		echo $value[$x].";";
		$sum += $value[$x];
	}
	$sum= $sum/12;
	//rtrim($out,";");
	echo  $sum."\n";
}

?>
