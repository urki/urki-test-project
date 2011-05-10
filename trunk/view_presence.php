<?php

require_once("inc/config.php");
check_role($ROLE_LEADER);

$TITLE = "Mese&#269;na evidenca prisotnosti uporabnikov za";


$tem = template_open("view_presence.tpl");
$tem = template_add_head_foot($tem, head, foot);

$tmp = template_get_repeat_text("##START_LOG_NOT##", "##STOP_LOG_NOT##", "##LOGS_NOT##", $tem);
$rownot = $tmp[1];
$tem = $tmp[0];



$tmp = template_get_repeat_text("##START_LOG##", "##STOP_LOG##", "##LOGS##", $tem);
$row = $tmp[1];
$tem = $tmp[0];



//zacetek in konec meseca//
if ($mon < 1 or $mon > 12)
    $mon = '';

if (!$mon)
    $mon = date("m", time());

if (!$year)
    $year = date("Y", time());

$mesec_start = mktime(0, 0, 0, $mon, 1, $year);
$last_day = date("t", $mesec_start);
$mesec_end = mktime(0, 0, 0, $mon, $last_day, $year);
//////////////////////////
$ts = "$year" . " " . $mon . "%";

//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id < 80) {
       $sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum, 
                      DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,
                      '%d' ) dan,
                      `persons`.`first` ime,
                      `persons`.`last` priimek,
	              person_id
               FROM  `work_log` ,  `persons`
	       WHERE  `persons`.`id_person` =  `work_log`.`person_id`
                 and id_role<20
                 and unit=$role_id
                 AND DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%Y %m' ) LIKE  '$ts'
               GROUP BY dan, person_id order by letter ASC";
} else {
       $sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum,
                      DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,
                      '%d' ) dan,
                      `persons`.`first` ime,
                      `persons`.`last` priimek,
		      person_id FROM  `work_log` ,  `persons`
		WHERE  `persons`.`id_person` =  `work_log`.`person_id` 
                  and id_role<20
                  AND DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%Y %m' ) LIKE  '$ts'
	        GROUP BY dan, person_id order by letter ASC";
}



$result_day = $db->fetchAll($sql);

if (is_array($result_day))
    $persons_id = array();

foreach ($result_day as $day_r) {
    //echo $day_r['person_id']."<br>";
    $person_id_db = $day_r['person_id'];
    $current_day = $day_r['dan'];
    if (!in_array($person_id_db, $persons_id))
        array_push($persons_id, $person_id_db);

    $LOG[$person_id_db][$current_day] = "x";
    $LOG[$person_id_db]['first'] = $day_r["ime"];
    $LOG[$person_id_db]['last'] = $day_r["priimek"];
}
//izpis za userja....

foreach ($persons_id as $person_id_db) {


    $table.=$row;
    $table = str_replace("##FIRST##", $LOG[$person_id_db]["first"], $table);
    $table = str_replace("##LAST##", $LOG[$person_id_db]["last"], $table);
    $table = str_replace("##WORKING_DAYS##", count($LOG[$person_id_db]) - 2, $table);
    for ($i = 1; $i <= 31; $i++) {
        if ($i < 10) {
            $ix = '0' . $i;
        } else {
            $ix = $i;
        }
        $table = str_replace("##D" . $i . "##", empty_table($LOG[$person_id_db][$ix]), $table);
    }
}
$table2.=$rownot;
for ($stevec = 1; $stevec <= 31; $stevec++) {

    $spremenljivka = 0;
    if ($stevec < 10) {
        $stevecy = '0' . $stevec;
    } else {
        $stevecy = $stevec;
    }
    foreach ($persons_id as $person_id_db) {

        $spremenljivka = $spremenljivka + (count($LOG[$person_id_db][$stevecy]));
    }
    $sumday[$stevecy] = $spremenljivka;
    if ($sumday[$stevecy] == 0) {
        $sumday[$stevecy] = " ";
    }
    $table2 = str_replace("##TEST" . $stevec . "##", $sumday[$stevecy], $table2);
}



$tem = str_replace("##MONTH##", " " . $mon . "/" . $year, $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##LOGS_NOT##", $table2, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;