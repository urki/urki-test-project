<?php

require_once("inc/config.php");

header( "refresh:120;url=view_notice.php" );


check_role($ROLE_EMPLOYED);
$TITLE = "Glavna stran";

$tem = template_open("view_notice.tpl");
$tem = template_add_head_foot($tem, head, foot);

$tmp = template_get_repeat_text("##START_LOG##", "##STOP_LOG##", "##LOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];

/**
 * Obdelava feedback 
 */
$sql = "SELECT * FROM `feedback` WHERE `modified_by`=$person_id and `status` in (0, 1) order by id desc";
$result = $db->fetchAll($sql);

foreach ($result as $res) {
    $table.=$row;
    $table = str_replace("##FEEDBTIME##", $res[timestamp], $table);
    $table = str_replace("##FEEDBNOTE##", substr($res["note"], 0, 120) . '...', $table);
}


/**
 *Izpis končanih v feedback 
 */
$tmp = template_get_repeat_text("##START END##", "##STOP_END##", "##LOGS2##", $tem);
$row = $tmp[1];
$tem = $tmp[0];
unset($result);
$sql = "SELECT * FROM `feedback` WHERE `modified_by`=$person_id and `status` =2 order by id desc LIMIT 0 , 4";
$result = $db->fetchAll($sql);


foreach ($result as $res) {
    $table2.=$row;
    $table2 = str_replace("##FEEDBTIME DONE##", $res[timestamp], $table2);
    $table2 = str_replace("##FEEDBNOTE DONE##", substr($res["note"], 0, 120) . '...', $table2);
}



$sql = " SELECT person_id, jobtype_id, count(log_id) as sest FROM `log` WHERE person_id=$person_id and jobtype_id in (1, 12, 22, 16) group by person_id, jobtype_id";
$result = $db->fetchAll($sql);



if (is_array($result)) {

    foreach ($result as $res) {
        switch ($res[jobtype_id]) {
            //navadni dopust
            case 12:
                $leave = ($res[sest]);

                break;
            //studijski dopust
            case 22:
                $sabbatical = ($res[sest]);

                break;
            //sluzb
            case 16:
                $specialLeave = ($res[sest]);

                break;

            default:
                $leave = 0;
                $sabbatical = 0;
                $specialLeave = 0;
                break;
        }
    }
}






/**
 * Urna sestevanja, sestevanja dni 
 */
$sql = "SELECT person_id, 
              jobtype_id,
              sum(wdays) sestDni,
              sum(whours) sestUr, 
              sum(end-start) as EndStart 
       FROM `log` 
       WHERE person_id=$person_id 
            and jobtype_id in (3,7, 20, 21, 23, 24, 25) 
       GROUP BY person_id, 
                jobtype_id";
$result = $db->fetchAll($sql);


if (is_array($result)) {

    foreach ($result as $res) {
        switch ($res[jobtype_id]) {
            //prosti izhodi
            case 3:
                $PrivateOutput = ($res[EndStart]);

                break;
            //sum end -start plus hours
            case 7:
                $plusHour = ($res[EndStart]);


                break;
            //LD odlocba
            case 20:
                $annLeavDeci = ($res[sestDni]);

                break;
            //izravnava ur
            case 21:
                $hourCompensate = ($res[EndStart]);

                break;
            //LD studijski dopust 
            case 23:
                $annualSabbaticalDecision == ($res[sestDni]);

                break;
            //izredni dopust
            case 24:
                $annualSpecialLeaveDecision = ($res[sestDni]);

                break;
            //izravnava dni
            case 25:
                $dayCompensate = ($res[sestDni]);

                break;


            default:
                $PrivateOutput = 0;
                $plusHour = 0;
                $annLeavDeci = 0;
                $hourCompensate = 0;
                $annualSabbaticalDecision = 0;
                $annualSpecialLeaveDecision = 0;
                $dayCompensate = 0;

                break;
        }
    }
}

/**
 * Just this year decisions - filtered query by year(timestamp) to get yearly decison
 */
$sql = "SELECT * FROM `log` 
      WHERE `person_id`=$person_id
            and `jobtype_id` in (20,23,24) 
            and year(`timestamp`)=year(now())";
$result = $db->fetchAll($sql);
if (is_array($result)) {

    foreach ($result as $res) {
        switch ($res[jobtype_id]) {
            case 20:
                $CurrentAnnualLeaveDecision = ($res[wdays]);
                break;

            case 23:
                $CurrAnnSabbDeci = ($res[wdays]);
                break;

            case 24:
                $CurrAnnSpecLeavDeci = ($res[wdays]);
                break;

            default:
                $CurrentAnnualLeaveDecision = 0;
                $CurrAnnSpecLeavDeci = 0;
                $CurrAnnSabbDeci = 0;

                break;
        }
    }
}

/**
 * Results of hours 
 */
$hhmmu = new myClasses();

$HourResult = $plusHour - $PrivateOutput - $hourCompensate;
$HourResult = $hhmmu->sec2hms($HourResult);


/**
 * Results of leave days 
 */
/**
 * AnnualLeave results
 */
$CurrLeavStat = $annLeavDeci - $leave - $dayCompensate;

$CheckYearLeaveStatus = $CurrentAnnualLeaveDecision - $CurrLeavStat;

if ($CheckYearLeaveStatus < 0) {
    $LastYearLeaveStatus = $CheckYearLeaveStatus * -1;
    $ThisYearLeaveStatus = $CurrentAnnualLeaveDecision;
} elseif ($CheckYearLeaveStatus >= 0) {
    $ThisYearLeaveStatus = $CurrLeavStat;
    $LastYearLeaveStatus = 0;
}
/**
 * AnnualSabbaticalStatus results
 *
 * @TODO dodaj v bazo tudi izravnavo studentskega dopusta 
 */
$CurrAnnSabbStat = $CurrAnnSabbDeci - $sabbatical;
$CheckAnnualSabbaticalStatus = $CurrAnnSabbDeci - $CurrAnnSabbStat;
if ($CheckAnnualSabbaticalStatus < 0) {
    $LastYearSabbaticalStatus = $CheckAnnualSabbaticalStatus * -1;
    $ThisYearSabbaticalStatus = $CurrAnnSabbDeci;
} elseif ($CheckAnnualSabbaticalStatus >= 0) {
    $ThisYearSabbaticalStatus = $CurrAnnSabbStat;
    $LastYearSabbaticalStatus = 0;
}

/**
 * AnnualSpecialLeaveStatus
 *
 * @TODO dodaj v bazo tudi izravnavo izrednega dopusta 
 */
$CurrAnnSpecLeavStat = $CurrAnnSpecLeavDeci - $specialLeave;

$CheckYearSpecialLeaveStatus = $CurrAnnSpecLeavDeci - $CurrAnnSpecLeavStat;
if ($CheckYearSpecialLeaveStatus < 0) {
    $LastYearSprecialLeaveStatus = $CheckYearSpecialLeaveStatus * -1;
    $ThisYearSpecialLeaveStatus = $CurrAnnSpecLeavDeci;
} elseif ($CheckYearSpecialLeaveStatus >= 0) {
    $ThisYearSpecialLeaveStatus = $CurrAnnSpecLeavStat;
    $LastYearSprecialLeaveStatus = 0;
}


//echo "$CurrentLeaveStatus"; die;


$tem = str_replace('##THISYEAR##', $ThisYearLeaveStatus, $tem);
$tem = str_replace('##LASTYEAR##', $LastYearLeaveStatus, $tem);
$tem = str_replace('##THISSPECIAL##', $ThisYearSpecialLeaveStatus, $tem);
$tem = str_replace('##LASTSPECIAL##', $LastYearSprecialLeaveStatus, $tem);
$tem = str_replace('##THISSABBA##', $LastYearSabbaticalStatus, $tem);
$tem = str_replace('##LASTSABBA##', $ThisYearSabbaticalStatus, $tem);
$tem = str_replace('##HOUR##', $HourResult, $tem);

$tem = str_replace("##DATE##", " " . returnDate(date("N"), "day") . ", " . date("j") . " " . returnDate(date("n"), "month") . " " . date("Y"), $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace("##DATEYEARNOW##", date("Y", time()), $tem);
$tem = str_replace("##DATELASTYEAR##", date("Y", time()) - 1, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##LOGS2##", $table2, $tem);

$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");

echo $tem;


