<?
//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE_LEADER);
$tem = template_open("add_log_admin.tpl");
$tem = template_add_head_foot($tem,head,foot);
$TITLE = "Evidenca OE";


	
//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id<80){
    $sql = "SELECT * FROM persons where unit=$role_id and id_role>30 order by last ASC";
	} 
else {
    $sql = "SELECT * FROM persons where id_role>30 order by first ASC"; 
}

$result = $db->fetchAll($sql);
foreach ($result as $res) {
if (!is_array($names)) {
		$names[] ="ime in priimek zaposlenega...";
		$values[]="";
	}
	$names[] .= $res["first"]." ".$res["last"];
	$values[] .= $res["id_person"];
}

$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop); 


//pogoj, da lahko vsi ki imajo nad 80 role_id vpisujejo vse JOBTYPE, ostali pa ne
//if ($role_id<80){
//  $sql = "SELECT * FROM jobtype where role between 30 and 79 order by name ASC";
//	} 
//else {
//    $sql = "SELECT * FROM jobtype where role > 79 order by name ASC"; 
//}
$sql = "SELECT * FROM jobtype where role between 10 and $role_id order by name ASC";

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($names_job)) {
		$names_job[] ="izberi tip izhoda...";
		$values_job[]="";
	}
	$names_job[] .= $res["name"];
	$values_job[] .= $res["job_id"];
}

$job_dropdown = html_drop_down_arrays("job_drop",$names_job,$values_job,$job_drop); 


$name = $_REQUEST['name'];

if ($_REQUEST['add'] == "    Dodaj    ") {

	/*$start_time = mktime ($HOUR_START, $MIN_START, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
	$stop_time = mktime ($HOUR_STOP, $MIN_STOP, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));*/
	
    $start_time = mktime ($HOUR_START, $MIN_START, 0, $MONTH_START , $DAY_START , $year= date("Y",time()));
	$stop_time = mktime ($HOUR_STOP, $MIN_STOP, 0, $MONTH_START , $DAY_START , $year= date("Y",time()));
	
//preveri ce je v month reportu ze izpisan in ce je ga ne dovoli vpisat	
	$sql_log = "SELECT date 
	FROM  `log_report` 
	WHERE date='"."0".$MONTH_START.$year.$role_id."' order by log_id DESC limit 1";
    $get_log = $db->fetchAll($sql_log);
     if ($get_log[0]["date"]) {
    	//header("location:log_error.php");
		$message .= "Vnasati v mesec katerega porocilo je bilo oddano ni mogoce!";
		//exit;
	}

	else {

	if ( $name_drop and $job_drop and $MONTH_START and $DAY_START and $start_time and $stop_time) {
		$sql = "SELECT timestamp FROM log  where jobtype_id=$job_drop and person_id = '$name_drop' and start='$start_time' and end='$stop_time'"; 
		$result = $db->fetchOne($sql);
		if (!$result) {    
 

			//dejansko vnesemo 
			$data = array( 
				'person_id'      => $name_drop, //name_drop sem zamenjal z user_id saj se avtomatsko...
				'jobtype_id'	 => $job_drop,
				'start'			 => $start_time,
				'end'			 =>	$stop_time,
				'note'		     => $note." "."//dodal"." ".$identity,
				'modified_by'    => $person_id
				); 
			$db->insert('log', $data); 
			$message .= "Vnos je dodan";
		}    


	}else {
		$message.= "Izpolni vsa polja!"; 
	}
}
}


$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##JOB_DROP##",$job_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>