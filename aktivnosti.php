<?
require_once("inc/config.php");


check_role($ROLE_USER);
$TITLE = "Poročila";

$tem = template_open("aktivnosti.tpl");





if ($_REQUEST['tp'] == "head") {
		$tem = template_open("aktivnosti_head.tpl");
		$param = '?tp=head';
	} else {
		$tem = template_open("aktivnosti.tpl");
 }

//Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!
 if ($role_id) {
	switch ($role_id) {
		case ($role_id >= $ROLE_ADMIN):
			$tem = str_replace("##IF_ADMIN##","",$tem);
			$tem = str_replace("##IF_LEADER##","",$tem);
		break;
		case ($role_id <= $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
		break;

		case ($role_id <= $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
			$tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
		break;

		default:
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
			$tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
			$tem =  template_clean_up_tags($tem,"##IF_EMPLOYED##",1);
			//$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
	}

	} else  {
			$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
			$head = template_clean_up_tags($head,"##IF_USER##",1);
			$tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
			$tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
			$tem =  template_clean_up_tags($tem,"##IF_EMPLOYED##",1);
}
//KONEC  Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!


$qhour_start_time = range(0,23);
//$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,"8");//date("H",time()));
$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,$hour_start_time_drop);//date("H",time()));



$qmin_start_time = range(0,59);
$qmin_start_time_dropdown = html_drop_down_arrays("min_start_time_drop",$qmin_start_time,$qmin_start_time,$min_start_time_drop);//date("H",time()));



$qhour_stop_time = range(0,23);
$qhour_stop_time_dropdown = html_drop_down_arrays("hour_stop_time_drop",$qhour_stop_time,$qhour_stop_time,$hour_stop_time_drop);//date("H",time()));

$qmin_stop_time = range(0,59);
$qmin_stop_time_dropdown = html_drop_down_arrays("min_stop_time_drop",$qmin_stop_time,$qmin_stop_time,$min_stop_time_drop);//date("H",time()));



$qpause_hour_time = range(0,23);
$qpause_hour_time_dropdown = html_drop_down_arrays("pause_hour_time_drop",$qpause_hour_time,$qpause_hour_time,$pause_hour_time_drop);//date("H",time()));

$qpause_min_time = range(0,59);
$qpause_min_time_dropdown = html_drop_down_arrays("pause_min_time_drop",$qpause_min_time,$qpause_min_time,$pause_min_time_drop);//date("H",time()));


$qrating = range(1,5);
$qrating_dropdown = html_drop_down_arrays("rating_drop",$qrating,$qrating,"3");//date("H",time()));




$qday = range(1,31);
$day_dropdown = html_drop_down_arrays("day_drop",$qday,$qday,date("j",time()));

$qmonth = range(1,12);
$month_dropdown = html_drop_down_arrays("month_drop",$qmonth,$qmonth,date("n",time()));

$qyear = range(2009,(date("Y",time()))+1);
$year_dropdown = html_drop_down_arrays("year_drop",$qyear,$qyear,date("Y",time()));

 

//drop down za dolocitev uporabnika katerega se vpisuje
$sql = "SELECT * FROM persons WHERE $ROLE_USER>=`id_role` order by unit, letter ASC"; 
$result = $db->fetchAll($sql);
foreach ($result as $res) {
if (!is_array($names)) {
		$names[] ="uporabnik";//ime in priimek...";
		$values[]="";
	}
	$names[] .= $res["last"]." ".$res["first"];
	$values[] .= $res["id_person"];
}
$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop); 
////////////////


//drop down za dolocitev vpisovalca aktivnosti
$sql = "SELECT * FROM persons WHERE 20<`id_role` order by unit, letter ASC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
if (!is_array($assnames)) {
		$assnames[] ="ocenjevalec";//"ime in priimek...";
		$assvalues[]="";
	}
	$assnames[] .= $res["last"]." ".$res["first"];
	$assvalues[] .= $res["id_person"];
}
$ass_name_dropdown = html_drop_down_arrays("ass_name_drop",$assnames,$assvalues,$ass_name_drop);
/////////////////




/*$sql = "SELECT * FROM applic"; 

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($aname)) {
		$aname[] ="izberi program...";
		$avalue[]="";
	}
	$aname[] .= $res["name"];
	$avalue[] .= $res["name"];
}

$appl_dropdown = html_drop_down_arrays("entry.4.single",$aname,$avalue,$appl_drop); */

//drop down za določitev lokacije - te v bistvu ne uporabljam več
$sql = "SELECT * FROM locations";
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
//////////////////////


//dropdown za izbiro aktivnosti uporabnika
$sql = "SELECT * FROM `work` WHERE $ROLE_USER>=`group` ORDER BY `applic`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($wname)) {
		$wname[] ="izberi aktivnost...";
		$wvalue[]="";
	}
	$wname[] .= $res["applic"]." --> ".$res["name"];
	$wvalue[] .= $res["work_id"];
	
}
$work_dropdown = html_drop_down_arrays("work_drop",$wname,$wvalue,$work_drop); 
////////////





//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql); 


$name = $_REQUEST['name'];


if ($_REQUEST['add'] == "    Shrani    "  ) {


     //Če je administrator se štejejo tudi dnevi in se lahko izbere tudi ocenjevalec
 If ($role_id>80) {
    $start_time = mktime ($hour_start_time_drop, $min_start_time_drop, 0,  $month_drop ,$day_drop,$year_drop);
    $stop_time  = mktime ($hour_stop_time_drop , $min_stop_time_drop , 0,  $month_drop ,$day_drop,$year_drop);
    $pause_time = $pause_hour_time_drop*3600+$pause_min_time_drop*60;
 }
    //če pa je "samo" vodja pa ne more vpisovati dni in ocenjevalca
 else {
      $start_time = mktime ($hour_start_time_drop, $min_start_time_drop, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
      $stop_time = mktime ($hour_stop_time_drop,  $min_stop_time_drop, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
      $pause_time = pause_hour_time_drop*3600+$pause_min_time_drop*60;
      $ass_name_drop=$user_id;
    }






	if ($user_id and $work_drop and $start_time and $stop_time and ($start_time < $stop_time) and  (($stop_time-$start_time) > $pause_time) and $name_drop!=0) {

              $sql = "SELECT timestamp ,id FROM work_log  where (person_id = '$name_drop'  and  (end >'$start_time' AND start<'$stop_time')) or person_id= '$user_id' and  (end >'$start_time' AND start<'$stop_time')";


		$result = $db->fetchAll($sql);
                $success=true;
                $check_id=$result[0]["id"];



		if (!$result) {


			//dejansko vnesemo 
			$data = array( 
				'person_id'      => $name_drop,
			        'assessor_id'    => $ass_name_drop, //$user_id,
     			        'work_id'	 => $work_drop,
				'start'		 => $start_time,
				'end'		 => $stop_time,
				'pause'          => $pause_time,
				'assessment'     => $rating_drop,//$assessment,
				'comm'		 => $note,
				'testing'        => $identity
				); 
			$db->insert('work_log', $data); 
			
			//$message .= "Vnos je dodan";
                        	header("location:".$_SERVER['HTTP_REFERER']);
			//header("location:aktivnosti.php".$param);
			exit;
		}
                    
                      
                  if ($success) {
                      echo "<script>alert('Vnos se prekriva z  vnosom številka $check_id')</script>";
                 
               // exit();
                } else {
                   //....failed to update info
                }
	   // $message.= "Vpis se prekriva";

	} else
{
             //($start_time < $stop_time) and  (($stop_time-$start_time) > $pause_time) and $name_drop!=0
           if ($start_time > $stop_time){
                echo "<script>alert('Začetni čas ne more biti manjši od končnega!')</script>";
           } elseif ((($stop_time-$start_time) < $pause_time)){

                echo "<script>alert('Neaktivnost ne more biti večja od celotne aktivnosti')</script>";
           }
           else {
              echo "<script>alert('Izpolni vsa polja')</script>";
                  // $message.= "Izpolni vsa polja!";
}}}

$tem = str_replace('##DAY##',$day_dropdown,$tem);
$tem = str_replace('##MONTH##',$month_dropdown,$tem);
$tem = str_replace('##YEAR##',$year_dropdown,$tem);
$tem= str_replace('##STARTTIMEHOUR##',$qhour_start_time_dropdown,$tem);
$tem= str_replace('##STARTTIMEMIN##',$qmin_start_time_dropdown,$tem);
$tem= str_replace('##STOPTIMEHOUR##',$qhour_stop_time_dropdown,$tem);
$tem= str_replace('##STOPTIMEMIN##',$qmin_stop_time_dropdown,$tem);
$tem= str_replace('##PAUSEHOURTIME##',$qpause_hour_time_dropdown,$tem);
$tem= str_replace('##PAUSEMINTIME##',$qpause_min_time_dropdown,$tem);
$tem= str_replace('##RATING##',$qrating_dropdown,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##NAMES##',$name_dropdown,$tem);
$tem = str_replace('##ASSNAMES##',$ass_name_dropdown,$tem);
//$tem = str_replace('##PROGRAM##',$appl_dropdown,$tem);
$tem = str_replace("##LOCATION_DROP##",$location_dropdown,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = str_replace('##WORK##',$work_dropdown,$tem);
$tem=template_clean_up_tags($tem,"##");
echo $tem;

?>
