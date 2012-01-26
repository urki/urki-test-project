<?php
$time = time();
require_once("inc/config.php");

check_role($ROLE_LEADER);
$TITLE = "Pregled vpisanih aktivnosti za";

$tem = template_open("view_paycheck.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];
$mon = (int)$_REQUEST["mon"];
$amount =(int)$_REQUEST["amount"];


for( $x=1;$x<13;$x++)
	$names[] .= $x;

$values = $names;

$month_dropdown = html_drop_down_arrays("mon",$names,$values,date("m",time()));


//spremenljivki za mesec ine leto
if ($mon<1 or $mon>12)
	$mon ='';


if (!$year)
	$year = date("Y",time());



if ($mon and $year and $amount) {
	//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse

	if ($role_id<$ROLE_ADMIN and $role_id>$ROLE_LEADER){

		$sql = "SELECT MONTH( FROM_UNIXTIME(  `end` ) ) mesec,  `person_id` ,  `persons`.`first` ime_varov,  `persons`.`last` priim_varov, 
		(SUM( ( ( `end` -  `start` -  `pause` ) /3600 ) *  `assessment` * IF(  `persons`.`id_role` =10,  '1', IF(  `persons`.`id_role` =5,  '0',  IF(  `persons`.`id_role` =8,  '0.1',  '0.33' ) ) )))
		 * ( ".$amount." / ( SELECT SUM( ( (`end` -  `start` -  `pause`) /3600 )
		 *  `assessment` * IF(  `persons`.`id_role` =10,  '1', IF(  `persons`.`id_role` =5,  '0',  IF(  `persons`.`id_role` =8,  '0.1',  '0.33' ) ) ) ) tocke
		FROM  `work_log` ,  `work` ,  `persons` 
		WHERE  `work`.`work_id` =  `work_log`.`work_id` 
		AND  `persons`.`id_person` =  `work_log`.`person_id` 
		AND  `work`.`payment` =1
		AND (
		MONTH( FROM_UNIXTIME(  `start` ) ) =$mon
		AND YEAR( FROM_UNIXTIME(  `start` ) ) =$year and `persons`.`unit`=$role_id)
		)
		)eur
		FROM  `work_log` ,  `work` ,  `persons` 
		WHERE  `work`.`work_id` =  `work_log`.`work_id` 
		AND  `persons`.`id_person` =  `work_log`.`person_id` 
		AND  `work`.`payment` =1
		AND (
		MONTH( FROM_UNIXTIME(  `start` ) ) =$mon
		AND YEAR( FROM_UNIXTIME(  `start` ) ) =$year
		and `persons`.`unit`=$role_id
		)
                GROUP BY  `person_id`
                order by `letter`";
		
	}
	
	
			
	else{
		

		$sql = "SELECT MONTH( FROM_UNIXTIME(  `end` ) ) mesec,  `person_id` ,  `persons`.`first` ime_varov,  `persons`.`last` priim_varov, 
		(SUM( ( ( `end` -  `start` -  `pause` ) /3600 ) *  `assessment` * IF(  `persons`.`id_role` =10,  '1', IF(  `persons`.`id_role` =5,  '0',  IF(  `persons`.`id_role` =8,  '0.1',  '0.33' ) ) )))
		 * ( ".$amount." / ( SELECT SUM( ( (`end` -  `start` -  `pause`) /3600 )
		 *  `assessment` * IF(  `persons`.`id_role` =10,  '1', IF(  `persons`.`id_role` =5,  '0',  IF(  `persons`.`id_role` =8,  '0.1',  '0.33' ) ) ) ) tocke
		FROM  `work_log` ,  `work` ,  `persons` 
		WHERE  `work`.`work_id` =  `work_log`.`work_id` 
		AND  `persons`.`id_person` =  `work_log`.`person_id` 
		AND  `work`.`payment` =1
		AND (
		MONTH( FROM_UNIXTIME(  `start` ) ) =$mon
		AND YEAR( FROM_UNIXTIME(  `start` ) ) =$year )
		)
		)eur
		FROM  `work_log` ,  `work` ,  `persons` 
		WHERE  `work`.`work_id` =  `work_log`.`work_id` 
		AND  `persons`.`id_person` =  `work_log`.`person_id` 
		AND  `work`.`payment` =1
		AND (
		MONTH( FROM_UNIXTIME(  `start` ) ) =$mon
		AND YEAR( FROM_UNIXTIME(  `start` ) ) =$year
		)
		GROUP BY  `person_id`
                order by `letter`";
	}

//	echo $sql;

	$result = $db->fetchAll($sql);

	$time2 = time();

	//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
	foreach ($result as $res) {
		$table = $row;
		//echo $table."<br><hr>";
		$table = str_replace("##NAME##",$res["priim_varov"]." ".$res["ime_varov"],$table);
		$table = str_replace("##EUR##",round($res["eur"],2)." €",$table);
		//echo "<br>".$res['timestamp']." - ".date("H:i",$res['start'])." - ".date("H:i",$res['stop'])." - ".$res['name']." - ".$res['description'];
		$whole_table.=$table;
	}
}


$tem = str_replace("##AMOUNT##",$amount,$tem);
$tem = str_replace("##MDROP##",$month_dropdown,$tem);
$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");


echo $tem;