<?


die("NE UPORABLJAJ!!!");

require_once("inc/config.php");

$tem = template_open("aktivnosti_head.tpl");
 


$sql = "SELECT * FROM persons WHERE $ROLE_USER>=`id_role` order by letter ASC"; 
$result = $db->fetchAll($sql);
foreach ($result as $res) {
if (!is_array($names)) {
		$names[] ="ime in priimek...";
		$values[]="";
	}
	$names[] .= $res["last"]." ".$res["first"];
	$values[] .= $res["id_person"];
}
$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop); 




$sql = "SELECT * FROM persons WHERE 20<`id_role` order by unit, letter ASC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
if (!is_array($assnames)) {
		$assnames[] ="ime in priimek...";
		$assvalues[]="";
	}
	$assnames[] .= $res["last"]." ".$res["first"];
	$assvalues[] .= $res["id_person"];
}
$ass_name_dropdown = html_drop_down_arrays("ass_name_drop",$assnames,$assvalues,$ass_name_drop);






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






//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql); 


$name = $_REQUEST['name'];


if ($_REQUEST['add'] == "    Shrani    ") {

	$start_time = mktime ($HOUR_START, $MIN_START, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
	$stop_time = mktime ($HOUR_STOP, $MIN_STOP, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
    //$pause_time = mktime ($PAUSEHOUR, $PAUSEMIN, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
	$pause_time = $PAUSEHOUR*3600+$PAUSEMIN*60;
	
	if ($user_id and /*$name_dropdown and $job_dropdown and*/ $start_time and $stop_time) {
		$sql = "SELECT timestamp FROM work_log  where person_id = '$name_drop' and work_id='$work_drop' and start='$start_time' and end='$stop_time' and comm='$note' "; 
		$result = $db->fetchOne($sql);
		if (!$result) {


			//dejansko vnesemo 
			$data = array( 
				'person_id'      => $name_drop,
			    'assessor_id'    => $ass_name_drop, //$user_id,
     			'work_id'	     => $work_drop,
				'start'			 => $start_time,
				'end'			 =>	$stop_time,
				'pause'          => $pause_time,
				'assessment'     => $assessment,
				'comm'		     => $note,
				'testing'        => $identity
				); 
			$db->insert('work_log', $data); 
			
			//$message .= "Vnos je dodan";
			header("location:aktivnosti_head.php");
			exit;
		}


	} else {
		$message.= "Izpolni vsa polja!"; 
	}
}



$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##NAMES##',$name_dropdown,$tem);
//$tem = str_replace('##PROGRAM##',$appl_dropdown,$tem);
$tem = str_replace("##LOCATION_DROP##",$location_dropdown,$tem);

$tem = str_replace('##ASSNAMES##',$ass_name_dropdown,$tem);
$tem = str_replace('##WORK##',$work_dropdown,$tem);
$tem=template_clean_up_tags($tem,"##");
echo $tem;

?>