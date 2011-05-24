<?php

//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE_EMPLOYED,"login.php");
$TITLE = "Evidenca zaposlenih";

$tem = template_open("NEWaktivnosti_employe.tpl");
$tem = template_add_head_foot($tem,head,foot);



$sql = "SELECT `work_id`,`work`.`applic_id`,`subcat_id`, `applic`.`name` Program, `work`.`name` name, `opis` FROM `work`,`applic` WHERE '$role_id'>=`group` and `group`>'$ROLE_USER' and `work`.`applic_id`=`applic`.`applic_id` ORDER BY `work`.`applic_id`,`subcat_id`"; 



$qhour_start_time = range(0,23);
//$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,"8");//date("H",time()));
$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,$hour_start_time_drop);//date("H",time()));



$qmin_start_time = range(0,59);
$qmin_start_time_dropdown = html_drop_down_arrays("min_start_time_drop",$qmin_start_time,$qmin_start_time,$min_start_time_drop);//date("H",time()));



$qhour_stop_time = range(0,23);
$qhour_stop_time_dropdown = html_drop_down_arrays("hour_stop_time_drop",$qhour_stop_time,$qhour_stop_time,$hour_stop_time_drop);//date("H",time()));

$qmin_stop_time = range(0,59);
$qmin_stop_time_dropdown = html_drop_down_arrays("min_stop_time_drop",$qmin_stop_time,$qmin_stop_time,$min_stop_time_drop);//date("H",time()));



$qday = range(1,31);
$day_dropdown = html_drop_down_arrays("day_drop",$qday,$qday,date("j",time()));

$qmonth = range(1,12);
$month_dropdown = html_drop_down_arrays("month_drop",$qmonth,$qmonth,date("n",time()));

$qyear = range(2009,(date("Y",time()))+1);
$year_dropdown = html_drop_down_arrays("year_drop",$qyear,$qyear,date("Y",time()));


   


//$sql = 'SELECT * FROM `work` WHERE $role_id>=`group` and `group`>$ROLE_USER ORDER BY `work`.`applic_id`,`subcat_id`"; 
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($aname)) {
		$aname[] ="izberi aktivnost...";
		$avalue[]="";
	}
	$aname[] .= $res["applic_id"].".".$res["subcat_id"]." --> ".$res["name"];
	$avalue[] .= $res["work_id"];
	
}


$work_dropdown = html_drop_down_arrays("work_drop",$aname,$avalue,$work_drop); 


$sql = "SELECT * FROM locations where `type`=1 order by `name_location`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($lname)) {
		$lname[] ="izberi lokacijo...";
		$lvalue[]="";
	}
	$lname[] .= $res["name_location"];
	$lvalue[] .= $res["id"];
	
}
$location_dropdown = html_drop_down_arrays("location_drop",$lname,$lvalue,$location_drop); 




//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql); 


$name = $_REQUEST['name'];

if ($_REQUEST['add'] == "    Shrani    ") {


     $start_time = mktime ($hour_start_time_drop, $min_start_time_drop, 0,  date("n",time()) , date("j",time()) , $year= date("Y",time()));
     $stop_time  = mktime ($hour_stop_time_drop , $min_stop_time_drop , 0,  date("n",time()) , date("j",time()) , $year= date("Y",time()));


      //Preveri, če so vsa polja izpolnjena in če se vpis slučajno ne prikeriva s kaksnim
	if ($user_id and/*$name_dropdown and $job_dropdown and*/  $location_drop and $start_time and $stop_time and ($start_time < $stop_time)) {
		//$sql = "SELECT timestamp FROM work_log  where person_id = '$user_id' and work_id=$work_drop and location_id =$location_drop and start='$start_time' and end='$stop_time'";
                $sql = "SELECT timestamp,id FROM work_log  where (person_id = '$user_id'  and  (end >'$start_time' AND start<'$stop_time')) or assessor_id= '$user_id' and  (end >'$start_time' AND start<'$stop_time')";
		$result = $db->fetchAll($sql);
                $success=true;
                $check_id=$result[0]["id"];
     
		if (!$result) {


			//dejansko vnesemo 
			$data = array( 
				'person_id'      => $user_id, //name_drop sem zamenjal z user_id saj se avtomatsko...
     		      	        'work_id'	 => $work_drop,
				'location_id'    => $location_drop,
				'start'		 => $start_time,
				'end'		 => $stop_time,
				'comm'		 => $note
				); 
			$db->insert('work_log', $data); 
			//$message .= "Vnos je dodan";
			header("location:add_work_emplo.php");
                       // header("location:NEWaktivnost.php");
			exit;
		}



               else {
                                    
                  if ($success) {
                      echo "<script>alert('Vnos se prekriva z  vnosom številka $check_id')</script>";
                  }

               }
	} else {
             echo "<script>alert('Izpolni vsa polja!')</script>";
		//$message.= "Izpolni vsa polja!";
	}
}



$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##WORK_DROP##",$work_dropdown,$tem);
$tem= str_replace('##STARTTIMEHOUR##',$qhour_start_time_dropdown,$tem);
$tem= str_replace('##STARTTIMEMIN##',$qmin_start_time_dropdown,$tem);
$tem= str_replace('##STOPTIMEHOUR##',$qhour_stop_time_dropdown,$tem);
$tem= str_replace('##STOPTIMEMIN##',$qmin_stop_time_dropdown,$tem);
$tem = str_replace("##LOCATION_DROP##",$location_dropdown,$tem);
$tem = str_replace("##JOB_DROP##",$job_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>