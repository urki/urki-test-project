<?

$time = time();

require_once("inc/config.php");
check_role($ROLE_LEADER);

$TITLE = "Mese&#269;na evidenca prisotnosti uporabnikov za";



//pogoj, da se ob razlicnem role_id odpre razlicen template
if ($role_id < 99) {
    $tem = template_open("casetry.tpl");
} else {
    $tem = template_open("casetry.tpl");
}


$tem = template_add_head_foot($tem, head, foot);

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




if (!$unit){
  $unit="and unit=".$role_id;
}else{
    $unit="and unit=".$unit;
}
if (!$role){
    $role=$ROLE_USER+1;
};
if (!$logop){
    $logop="<";
}
if (!$tabela){
    $tabela="work_log";
}


//$logop=$vecji;  //logic operator
//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id < 80) {
    //$sql = "SELECT * FROM persons where unit=$role_id and id_role<20 order by letter ASC";
    $sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum, DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%d' ) dan,  `persons`.`first` ime,  `persons`.`last` priimek,
	person_id FROM ".$tabela.",  `persons` 
	WHERE  `persons`.`id_person` =  ".$tabela.".`person_id` and id_role".$logop.$role." ".$unit."
AND DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%Y %m' ) LIKE  '$ts'
GROUP BY dan, person_id order by letter ASC";
} else {
    // $sql = "SELECT * FROM persons where id_role<20 order by letter ASC";
    $sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum, DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%d' ) dan,  `persons`.`first` ime,  `persons`.`last` priimek,
		person_id FROM  `work_log` ,  `persons` 
		WHERE  `persons`.`id_person` =  `work_log`.`person_id` and id_role".$logop.$role."
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
//print_r($LOG);
//izpis za userja....
foreach ($persons_id as $person_id_db) {

    $table.=$row;
    $table = str_replace("##FIRST##", $LOG[$person_id_db]["first"], $table);
    $table = str_replace("##LAST##", $LOG[$person_id_db]["last"], $table);
    $table = str_replace("##WORKING_DAYS##", count($LOG[$person_id_db]) - 2, $table);
    $table = str_replace("##D1##", empty_table($LOG[$person_id_db]["01"]), $table);
    $table = str_replace("##D2##", empty_table($LOG[$person_id_db]["02"]), $table);
    $table = str_replace("##D3##", empty_table($LOG[$person_id_db]["03"]), $table);
    $table = str_replace("##D4##", empty_table($LOG[$person_id_db]["04"]), $table);
    $table = str_replace("##D5##", empty_table($LOG[$person_id_db]["05"]), $table);
    $table = str_replace("##D6##", empty_table($LOG[$person_id_db]["06"]), $table);
    $table = str_replace("##D7##", empty_table($LOG[$person_id_db]["07"]), $table);
    $table = str_replace("##D8##", empty_table($LOG[$person_id_db]["08"]), $table);
    $table = str_replace("##D9##", empty_table($LOG[$person_id_db]["09"]), $table);
    $table = str_replace("##D10##", empty_table($LOG[$person_id_db]["10"]), $table);
    $table = str_replace("##D11##", empty_table($LOG[$person_id_db]["11"]), $table);
    $table = str_replace("##D12##", empty_table($LOG[$person_id_db]["12"]), $table);
    $table = str_replace("##D13##", empty_table($LOG[$person_id_db]["13"]), $table);
    $table = str_replace("##D14##", empty_table($LOG[$person_id_db]["14"]), $table);
    $table = str_replace("##D15##", empty_table($LOG[$person_id_db]["15"]), $table);
    $table = str_replace("##D16##", empty_table($LOG[$person_id_db]["16"]), $table);
    $table = str_replace("##D17##", empty_table($LOG[$person_id_db]["17"]), $table);
    $table = str_replace("##D18##", empty_table($LOG[$person_id_db]["18"]), $table);
    $table = str_replace("##D19##", empty_table($LOG[$person_id_db]["19"]), $table);
    $table = str_replace("##D20##", empty_table($LOG[$person_id_db]["20"]), $table);
    $table = str_replace("##D21##", empty_table($LOG[$person_id_db]["21"]), $table);
    $table = str_replace("##D22##", empty_table($LOG[$person_id_db]["22"]), $table);
    $table = str_replace("##D23##", empty_table($LOG[$person_id_db]["23"]), $table);
    $table = str_replace("##D24##", empty_table($LOG[$person_id_db]["24"]), $table);
    $table = str_replace("##D25##", empty_table($LOG[$person_id_db]["25"]), $table);
    $table = str_replace("##D26##", empty_table($LOG[$person_id_db]["26"]), $table);
    $table = str_replace("##D27##", empty_table($LOG[$person_id_db]["27"]), $table);
    $table = str_replace("##D28##", empty_table($LOG[$person_id_db]["28"]), $table);
    $table = str_replace("##D29##", empty_table($LOG[$person_id_db]["29"]), $table);
    $table = str_replace("##D30##", empty_table($LOG[$person_id_db]["30"]), $table);
    $table = str_replace("##D31##", empty_table($LOG[$person_id_db]["31"]), $table);
}

$tem = str_replace("##MONTH##", " " . $mon . "/" . $year, $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");
$time2 = time();
//echo $time2-$time; 
echo $tem;