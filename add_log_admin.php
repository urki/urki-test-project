<?php

//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE_LEADER);
$tem = template_open("add_log_admin.tpl");
$tem = template_add_head_foot($tem, head, foot);
$TITLE = "Evidenca OE";

$year_drop = date("Y");


$qyear = range(2009, (date("Y", time())) + 1);
$qyear_dropdown = html_drop_down_arrays("year_drop", $qyear, $qyear, $year_drop);

$qmonth = range(1, 12);
$qmonth_dropdown = html_drop_down_arrays("month_drop", $qmonth, $qmonth, $month_drop);

$qday = range(1, 31);
$qday_dropdown = html_drop_down_arrays("day_drop", $qday, $qday, $day_drop);


$shour = range(0, 23);
$shour_dropdown = html_drop_down_arrays("shour_drop", $shour, $shour, $shour_drop);

$smin = range(0, 59);
$smin_dropdown = html_drop_down_arrays("smin_drop", $smin, $smin, $smin_drop);

$ehour = range(0, 23);
$ehour_dropdown = html_drop_down_arrays("ehour_drop", $ehour, $ehour, $ehour_drop);


$emin = range(0, 59);
$emin_dropdown = html_drop_down_arrays("emin_drop", $emin, $emin, $emin_drop);



//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id < 80) {
    $sql = "SELECT * FROM persons where unit=$role_id and id_role>30 order by last ASC";
} else {
    $sql = "SELECT * FROM persons where id_role>30 order by first ASC";
}

$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($names)) {
        $names[] = "ime in priimek zaposlenega...";
        $values[] = "";
    }
    $names[] .= $res["first"] . " " . $res["last"];
    $values[] .= $res["id_person"];
}

$name_dropdown = html_drop_down_arrays("name_drop", $names, $values, $name_drop);


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
        $names_job[] = "izberi tip...";
        $values_job[] = "";
    }
    $names_job[] .= $res["name"];
    $values_job[] .= $res["job_id"];
}

$job_dropdown = html_drop_down_arrays("job_drop", $names_job, $values_job, $job_drop);


$name = $_REQUEST['name'];

if ($_REQUEST['add'] == "    Dodaj    ") {
    if (!$name_drop) {
         $messagetype="notice";
        $message.= "Izberi ime in priimek!";
    } else {
        $start_time = mktime($shour_drop, $smin_drop, 0, $month_drop, $day_drop, $year_drop);
        $stop_time = mktime($ehour_drop, $emin_drop, 0, $month_drop, $day_drop, $year_drop);

        //pridobi enoto osebe katero vpisujem
        $sql_temp = "SELECT unit FROM persons where $name_drop=id_person";
        $enroll_unit = $db->fetchOne($sql_temp);
        ///////////
//preveri ce je v month reportu ze izpisan in ce je ga ne dovoli vpisat
        if ($month_drop < 10) {
            $mesec = "0" . $month_drop;
        } else {
            $mesec = $month_drop;
        };
        $sql_log = "SELECT date
	FROM  `log_report` 
	WHERE date='" . $mesec . $year . $enroll_unit . "' order by log_id DESC limit 1";
        $get_log = $db->fetchAll($sql_log);
        if ($get_log[0]["date"]) {
            //header("location:log_error.php");
            $messagetype="error";
            $message .= "Vna&#353ati v mesec katerega poro&#269ilo je bilo oddano ni mogo&#269e!";
            //exit;
        } else {


            if ($job_drop and $month_drop and $day_drop and $start_time and $stop_time and ($start_time < $stop_time)) {
                $sql = "SELECT timestamp FROM log  where jobtype_id=$job_drop and person_id = '$name_drop'  and  (end >'$start_time' AND start<'$stop_time')";
                $result = $db->fetchOne($sql);
                if (!$result) {


                    //dejansko vnesemo
                    $data = array(
                        'person_id' => $name_drop, //name_drop sem zamenjal z user_id saj se avtomatsko...
                        'jobtype_id' => $job_drop,
                        'start' => $start_time,
                        'end' => $stop_time,
                        'note' => $note . " " . "//dodal" . " " . $identity,
                        'modified_by' => $person_id
                    );
                    $db->insert('log', $data);
                    $messagetype = "success";
                    $message .= "Vnos je dodan";
                } else {
                    $messagetype = "error";
                    $message.="Vpis se prekriva!";
                }
            } else {
                $messagetype = "error";
                $message.= "Izpolni vsa polja!";
            }
        }
    }
}



$tem = str_replace('##MESSAGETYPE##', $messagetype, $tem);
$tem = str_replace('##SHOUR##', $shour_dropdown, $tem);
$tem = str_replace('##SMIN##', $smin_dropdown, $tem);
$tem = str_replace('##EHOUR##', $ehour_dropdown, $tem);
$tem = str_replace('##EMIN##', $emin_dropdown, $tem);
$tem = str_replace('##ADAY##', $qday_dropdown, $tem);
$tem = str_replace('##AMONTH##', $qmonth_dropdown, $tem);
$tem = str_replace('##AYEAR##', $qyear_dropdown, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##JOB_DROP##", $job_dropdown, $tem);
$tem = str_replace("##NAME_DROP##", $name_dropdown, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
?>