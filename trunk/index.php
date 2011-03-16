<?

//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE__EMPLOYED, "login.php");
$TITLE = "Evidenca prisotnosti";


$tem = template_open("index.tpl");
$tem = template_add_head_foot($tem, head, foot);



//trenutni mesec
$mesec_start = date("m", time());
$year=date("Y", time());

$shour = range(0, 23);
$shour_dropdown = html_drop_down_arrays("shour_drop", $shour, $shour, "7");

$smin = range(0, 59);
$smin_dropdown = html_drop_down_arrays("smin_drop", $smin, $smin, $smin_drop);

$ehour = range(0, 23);
$ehour_dropdown = html_drop_down_arrays("ehour_drop", $ehour, $ehour, "15");


$emin = range(0, 59);
$emin_dropdown = html_drop_down_arrays("emin_drop", $emin, $emin, $emin_drop);



$name = $_REQUEST['name'];



if ($_REQUEST['add'] == "   Shrani    ") {

    $start_time = mktime($shour_drop, $smin_drop, 0, date("n", time()), date("j", time()), $year = date("Y", time()));
    $stop_time = mktime($ehour_drop, $emin_drop, 0, date("n", time()), date("j", time()), $year = date("Y", time()));


    //zacasno spravljen pri preiskusanju concata)
//WHERE date='"."0".$MONTH_START.$year.$role_id."' order by log_id DESC limit 1";
    //preveri ce je v month reportu ze izpisan in ce je ga ne dovoli vpisat
    $sql_log = "SELECT date
	FROM  `log_report`
	WHERE date=concat('$mesec_start','$year',$unit) order by log_id DESC limit 1";

    // concat('0','8','2010','77')

    $get_log = $db->fetchAll($sql_log);



    if ($get_log[0]["date"]) {
        //header("location:log_error.php");
        $messagetype = "error";
        $message .= "Vnašati v mesec katerega poročilo je bilo oddano ni mogoče!";
        //exit;
    } else {



///testiramo če se vpis prekriva z katerim vpisom in če so vsa polja izpolnjena
        if ($person_id and /* $name_dropdown and $job_dropdown and */ $start_time and $stop_time and ($start_time < $stop_time)) {
            $sql = "SELECT timestamp FROM log  where person_id = '$person_id'  and  (end >'$start_time' AND start<'$stop_time')";
            $result = $db->fetchOne($sql);
            if (!$result) {


              
                //dejansko vnesemo
                $data = array(
                    'person_id' => $person_id, //name_drop sem zamenjal z user_id saj se avtomatsko...
                    'jobtype_id' => "1",
                    'start' => $start_time,
                    'end' => $stop_time,
                    'note' => $note
                );
                $db->insert('log', $data);
                $messagetype="success";
                $message .= "Vnos je dodan";
                //header("location:log_accepted.php");
                //exit;
            } else {
                  $messagetype="error";
                $message.="Vpis se prekriva!";
            }
        } else {
            $messagetype="notice";
            $message.="Ura konca ne more biti večja od ure začetka!";
        }
    }

    // else {
    //	$message.= "Izpolni vsa polja!";
    //}
}


$tem = str_replace('##SHOUR##', $shour_dropdown, $tem);
$tem = str_replace('##SMIN##', $smin_dropdown, $tem);
$tem = str_replace('##EHOUR##', $ehour_dropdown, $tem);
$tem = str_replace('##EMIN##', $emin_dropdown, $tem);

$tem = str_replace('##MESSAGETYPE##', $messagetype, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##JOB_DROP##", $job_dropdown, $tem);
$tem = str_replace("##NAME_DROP##", $name_dropdown, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
?>