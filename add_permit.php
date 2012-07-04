<?php

//*$DO_NOT_REDIRECT="true";*/
require("inc/config.php");


//za dovoljenje submitanja
$submit = 1;



//check_role($ROLE_LEADER);
check_role($ROLE_EMPLOYED);

$tem = template_open("add_permit.tpl");
$tem = template_add_head_foot($tem, head, foot);
$TITLE = "Vloge";



//Za izpis tistih katere hočem videti  - to moram prestavit v funkcijo!!!!!!!

if ($role_id) {

    switch ($role_id) {

        case ($role_id >= $ROLE_ADMIN):
            $tem = template_clean_up_tags($tem, "##IF_BUT_ADMIN##", 1);
            $tem = str_replace("##IF_ADMIN##", "", $tem);
            $tem = str_replace("##IF_LEADER##", "", $tem);
            $conditionUnit = ""; //to be in that unit
            break;

        case ($role_id < $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = str_replace("##IF_BUT_LEADER##", "", $tem);
            $conditionUnit = "and unit=$unit"; //to be in that unit
            break;

        case ($role_id < $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
            $tem = str_replace("##IF_BUT_LEADER##", "", $tem);
            $conditionUnit = "and unit=$unit"; //to be in that unit
            break;

        default:

            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
            $tem = template_clean_up_tags($tem, "##IF_EMPLOYED##", 1);
        //$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
    }
} else {

    $tem = template_clean_up_tags($tem, "##IF_ZALEC##", 1);
    $head = template_clean_up_tags($head, "##IF_USER##", 1);
    $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
    $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
    $tem = template_clean_up_tags($tem, "##IF_EMPLOYED##", 1);
}
$year_drop = date("Y");

$fyear = range((date("Y", time())) - 1, (date("Y", time())) + 1);
$fyear_dropdown = html_drop_down_arrays("fyear_drop", $fyear, $fyear, date("Y", time())); //$year_drop);
$fmonth = range(1, 12);
$fmonth_dropdown = html_drop_down_arrays("fmonth_drop", $fmonth, $fmonth, date("m", time())); //$fmonth_drop);
$fday = range(1, 31);
$fday_dropdown = html_drop_down_arrays("fday_drop", $fday, $fday, date("d", time())); // $fday_drop);
$fhour = range(0, 23);
$fhour_dropdown = html_drop_down_arrays("fhour_drop", $fhour, $fhour, $fhour_drop);
$fmin = range(0, 59);
$fmin_dropdown = html_drop_down_arrays("fmin_drop", $fmin, $fmin, $fmin_drop);

$syear = range((date("Y", time())) - 1, (date("Y", time())) + 1);
$syear_dropdown = html_drop_down_arrays("syear_drop", $syear, $syear, date("Y", time())); //$fyear_drop);
$smonth = range(1, 12);
$smonth_dropdown = html_drop_down_arrays("smonth_drop", $smonth, $smonth, date("m", time())); //$fmonth_drop);
$sday = range(1, 31);
$sday_dropdown = html_drop_down_arrays("sday_drop", $sday, $sday, date("d", time())); //$fday_drop);
$shour = range(0, 23);
$shour_dropdown = html_drop_down_arrays("shour_drop", $shour, $shour, $shour_drop);
$smin = range(0, 59);
$smin_dropdown = html_drop_down_arrays("smin_drop", $smin, $smin, $smin_drop);

//pogoj, da se vpiše sam če ima role id <70
if ($role_id < 70) {
    $name_drop = $person_id;
}
//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id < 80) {
    $sql = "SELECT * FROM persons where unit=$role_id and id_role>30 order by last ASC";
} else {
    $sql = "SELECT * FROM persons where id_role>30 order by first ASC";
}
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($names)) {
        $names[] = "ime in priimek zaposlenega…";
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
        $names_job[] = "izberi tip…";
        $values_job[] = "";
    }
    $names_job[] .= $res["name"];
    $values_job[] .= $res["job_id"];
}

$job_dropdown = html_drop_down_arrays("job_drop", $names_job, $values_job, $job_drop);


$name = $_REQUEST['name'];

if ($_REQUEST['add'] == "    Dodaj    ") {
    if ($submit==0){
        $stop_time=$checkTimeIfUntouched;
    }
    if (!$name_drop) {
        $messagetype = "notice";
        $message.= "Izberi ime in priimek!";
    } else {
        $start_time = mktime($fhour_drop, $fmin_drop, 0, $fmonth_drop, $fday_drop, $fyear_drop);
        $stop_time = mktime($shour_drop, $smin_drop, 0, $smonth_drop, $sday_drop, $syear_drop);
        $checkTimeIfUntouched = mktime($shour_drop, $smin_drop, 0, date("n", time()), date("j", time()), date("Y", time()));
        if ($checkTimeIfUntouched==$stop_time) {
            $stop_time = mktime($shour_drop, $smin_drop, 0, $fmonth_drop, $fday_drop, $fyear_drop );
            }
          
        $diffUnixTime = $stop_time - $start_time;
        if ($diffUnixTime > 86400) {
            $messagetype = "notice";
            $message.= "Delovni dan ne more biti daljši od 24 ur";
            $submit = false;
            ////exit;
        }
        $date = $fyear_drop . '-' . $fmonth_drop . '-' . $fday_drop;
        $DayOfWeek = date("w", mktime(0, 0, 0, $fmonth_drop, $fday_drop, $fyear_drop));
        $todaySubMonth = time() - 2592000;
        $todayAddMonth = time() + 2592000;

        $today=time();
        echo "startTime: $start_time <br/>";
          echo "stopTime: $stop_time <br>";
          echo "CheckTime: $checkTimeIfUntouched<br>";
          echo "today: $today <br>";
          echo "submit: $submit <hr>";
        
          echo 'startTime:'. date("y-m-d G:i:s", $start_time).'<br>';
          echo 'stopTime:'. date("y-m-d G:i:s",  $stop_time) .'<br>';
          echo 'CheckTime:'. date("y-m-d G:i:s",  $checkTimeIfUntouched).'<br>';
          echo 'today: '. date("y-m-d G:i:s", $today).'<br>';
          echo "submit: $submit <hr>";
        
//preveri ce je v month reportu ze izpisan in ce je ga ne dovoli vpisat
        if ($fmonth_drop < 10) {
            $mesec = "0" . $fmonth_drop;
        } else {
            $mesec = $fmonth_drop;
        };
        if (!$job_drop) {
            $messagetype = "notice";
            $message.= "Manjka tip vloge";
            $submit = 0;
        } elseif (!$fmonth_drop or !$fday_drop) {
            $messagetype = "notice";
            $message.= "Manjka datum";
            $submit = 0;
        } elseif ($todaySubMonth > $start_time or $todayAddMonth < $stop_time) {
            $messagetype = "notice";
            $message.= "Datum je lahko le današnji dan +- 30 dni";
            $submit = 0;
        } elseif (!$start_time) {
            $messagetype = "notice";
            $message.= "Manjka čas začetka!";
            $submit = 0;
        } elseif (!$stop_time) {
            $messagetype = "notice";
            $message.= "Manjka čas konca";
        } elseif ($start_time > $stop_time) {
            $messagetype = "notice";
            $message.= "Začetni čas ne more biti večji od končnega";
            $submit = 0;
        } elseif ($start_time == $stop_time) {
            $messagetype = "notice";
            $message.= "Začetni čas ne more biti enak končnemu";
            $submit = 0;
        } elseif (!$job_drop) {
            $messagetype = "notice";
            $message.= "Manjka tip vloge";
            $submit = 0;
        }

        if ($submit <> 0 ) {
            $sql = "SELECT timestamp FROM working_time  
                         where jobtype_id=$job_drop 
                          and person_id = '$name_drop'  
                          and  unix_timestamp(concat(valid_from, ' ', minStart)) >'$start_time' 
                          AND unix_timestamp(concat(valid_to, ' ', maxEnd))<'$stop_time'";

            $result = $db->fetchOne($sql);
            if (!$result) {

                //preveri če že ima za ta dan defaukt službo in če je ji vzame dolžino službe in max dolžino službe iz default
                $sql3 = "SELECT * 
                             FROM  `working_time` 
                             WHERE( '$date' between `valid_from` and `valid_to`) and  `person_id` =$name_drop
                             and DayOfWeek=dayofweek('$date')
                             ORDER BY id DESC 
                             LIMIT 0 , 1";
                $result = $db->fetchAll($sql3);

                if ($result) {

                    foreach ($result as $res) {
                        $weekday = $res["DayOfWeek"];
                        $maxJobTime = $res["maxJobTime"];
                        $workingTime = $res["workingTime"];
                    }
                } else {

                    $myClasse = new myClasses();
                    $workingTime = $diffUnixTime;
                    $workingTime = $myClasse->sec2hms($workingTime, $padHours = true);
                    $maxJobTime = $workingTime;
                    $weekday = $DayOfWeek;
                }



                $now = date("Y-m-d H:i:s");
                //dejansko vnesemo
                $data = array(
                    'timestamp' => $now,
                    'person_id' => $name_drop, //name_drop sem zamenjal z user_id saj se avtomatsko…
                    'jobtype_id' => $job_drop,
                    'valid_from' => $fyear_drop . '-' . $fmonth_drop . '-' . $fday_drop,
                    'valid_to' => $syear_drop . '-' . $smonth_drop . '-' . $sday_drop,
                    'minStart' => $fhour_drop . ':' . $fmin_drop . ':00',
                    'maxEnd' => $shour_drop . ':' . $smin_drop . ':00',
                    'DayOfWeek' => $weekday,
                    'EvenOrOddWeek' => 'all',
                    'maxJobTime' => $maxJobTime,
                    'workingTime' => $workingTime,
                    'note' => $note . " " . "//dodal" . " " . $identity
                );
             
                $db->insert('working_time', $data);
                $lastInsertedId = $db->lastInsertId();

                $messagetype = "success";
                $message .= "Vloga številka $lastInsertedId je oddana";

                $sql = "SELECT * FROM working_time
                          WHERE id=$lastInsertedId";

                $result = $db->fetchAll($sql);
                //var_dump($sql); die;
                if (!$result) {
                    $messagetype = "error";
                    $message .= "Napaka pri zapisu. Obvestite administratorja!";
                }

                foreach ($result as $res) {
                    $workingTime_id = $res["id"];
                }
                $data = array(
                    'workingTime_id' => $workingTime_id,
                    'id_approver' => $person_id,
                    'status' => '0'
                );
                $db->insert('working_time_status', $data);
            }
        }
    }
}

//Izpis zadnjih 3 vnosov:
//za izpisovanje vnosov
$tmp = template_get_repeat_text("##START_LOG##", "##STOP_LOG##", "##LOGS##", $tem);
$row = $tmp[1];
$tem = $tmp[0];

if ($role_id >= 70) {
    $enota = $dal->get_data_lastX_inserts_by_status_person();
    //print_r($enota[2]); 
} else {
    ($enota = $dal->get_data_lastX_inserts_by_status_person($status, $person_id, 3));
}

// id 	timestamp	first	last	valid_from	valid_to	minStart	maxEnd	name
for ($x = 0; $x < count($enota); $x++) {

    //for ($x = count($enota); $x >= 0; $x--) {   
    $table.=$row;
    $table = str_replace("##RECORDID##", $enota[$x][id], $table);
    $table = str_replace("##TYPENAME##", $enota[$x][name], $table); //substr($res["note"], 0, 120) . '...', $table);
    $table = str_replace("##VALID##", $enota[$x][valid_from], $table);
    $table = str_replace("##MINSTART##", $enota[$x][minStart], $table);
    $table = str_replace("##MAXEND##", $enota[$x][maxEnd], $table);
    $table = str_replace("##NAME##", $enota[$x][last] . ' ' . $enota[$x][first], $table);
}


$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace('##MESSAGETYPE##', $messagetype, $tem);
$tem = str_replace('##SHOUR##', $shour_dropdown, $tem);
$tem = str_replace('##SMIN##', $smin_dropdown, $tem);
$tem = str_replace('##SDAY##', $sday_dropdown, $tem);
$tem = str_replace('##SMONTH##', $smonth_dropdown, $tem);
$tem = str_replace('##SYEAR##', $syear_dropdown, $tem);
$tem = str_replace('##FHOUR##', $fhour_dropdown, $tem);
$tem = str_replace('##FMIN##', $fmin_dropdown, $tem);
$tem = str_replace('##FDAY##', $fday_dropdown, $tem);
$tem = str_replace('##FMONTH##', $fmonth_dropdown, $tem);
$tem = str_replace('##FYEAR##', $fyear_dropdown, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##JOB_DROP##", $job_dropdown, $tem);
$tem = str_replace("##NAME_DROP##", $name_dropdown, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = str_replace("##MESSAGERIGHT##", $messageRight, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
?>