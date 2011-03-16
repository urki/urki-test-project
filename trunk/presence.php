<?
//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE__EMPLOYED,"login.php");
$TITLE = "Evidenca prisotnosti";


$tem = template_open("index.tpl");
$tem = template_add_head_foot($tem,head,foot);


///////test za izpis 
/*$drek=GetHostByName($REMOTE_ADDR);
echo $drek;
$cvek=gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo " ".$cvek;
$box=php_uname('n');
echo "uname".$box;*/

/////////
/*$sql = "SELECT * FROM persons"; 
//za izbiro person - vendar trenutno ne rabim

$result = $db->fetchAll($sql);
foreach ($result as $res) {
	$names[] .= $res["first"]." ".$res["last"];
	$values[] .= $res["id_person"];
}

$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop); */


/*
##########
#Za zaposlene naj bo dostopen samo vpis slu�be, torej tega en rabijo
#$sql = "SELECT * FROM jobtype order by name ASC"; 
#
#$result = $db->fetchAll($sql);
#foreach ($result as $res) {
#	if (!is_array($names_job)) {
#		$names_job[] ="izberi tip zapisa...";
#		$values_job[]="";
#	}
#	$names_job[] .= $res["name"];
#	$values_job[] .= $res["job_id"];
#}
#
#$job_dropdown = html_drop_down_arrays("job_drop",$names_job,$values_job,$job_drop); 
###########
*/
//trenutni mesec
$mesec_start =date("n",time());



//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql); 

//get user unit
$sql ="SELECT unit FROM persons where username='$identity'";
$user_unit=$db->fetchOne($sql);

$name = $_REQUEST['name'];

   
  

if ($_REQUEST['add'] == "    Shrani    ") {

	$start_time = mktime ($HOUR_START, $MIN_START, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
	$stop_time = mktime ($HOUR_STOP, $MIN_STOP, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));


   //zacasno spravljen pri preiskusanju concata)
//WHERE date='"."0".$MONTH_START.$year.$role_id."' order by log_id DESC limit 1";

        //preveri ce je v month reportu ze izpisan in ce je ga ne dovoli vpisat
	$sql_log = "SELECT date
	FROM  `log_report`
	WHERE date=concat('0','$mesec_start','$year',$user_unit) order by log_id DESC limit 1";


       // concat('0','8','2010','77')

    $get_log = $db->fetchAll($sql_log);

   
    
     if ($get_log[0]["date"]) {
    	//header("location:log_error.php");
		$message .= "Vnasati v mesec katerega porocilo je bilo oddano ni mogoce!";
		//exit;
	}

	else {



///testiramo če se vpis prekriva z katerim vpisom in če so vsa polja izpolnjena
	if ($user_id and/*$name_dropdown and $job_dropdown and*/ $start_time and $stop_time and ($start_time < $stop_time)) {
		$sql = "SELECT timestamp FROM log  where person_id = '$user_id'  and  (end >'$start_time' AND start<'$stop_time')";
		$result = $db->fetchOne($sql);
		if (!$result) {


			//dejansko vnesemo 
			$data = array( 
				'person_id'      => $user_id, //name_drop sem zamenjal z user_id saj se avtomatsko...
     			        'jobtype_id'	 => "1",
				'start'		 => $start_time,
				'end'		 => $stop_time,
				'note'		 => $note
				); 
			$db->insert('log', $data); 
			$message .= "Vnos je dodan";
			header("location:log_accepted.php");
			exit;
		}
                else  {$message.="Vpis se prekriva!";}
        }
        else {$message.="Ura konca ne more biti vecja od ure zacetka!";}
        }

	// else {
	//	$message.= "Izpolni vsa polja!";
	//}
}





$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace("##JOB_DROP##",$job_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");
echo $tem;

?>