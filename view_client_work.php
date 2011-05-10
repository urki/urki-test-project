<?php

$time = time();
require_once("inc/config.php");

check_role($ROLE_USER);
$TITLE=("pregled aktivnosti");

$tem = template_open("view_client_work.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];
$mon = $_REQUEST["mon"];
$year =(int)$_REQUEST["year"];
$name_drop =(int)$_REQUEST["name_drop"];
////month dropdown//
for( $x=1;$x<13;$x++) {
	if ($x<10)
   		$names[] .= "0".$x;
	else 
		$names[] .=$x;
}
$values = $names;

$month_dropdown = html_drop_down_arrays("mon",$names,$values,date("m",time()));

///year dropdown//
$names ='';
$Y = date("Y",time());
for ($x=2009; $x<=$Y;$x++) {
	$names[].= $x;
}
$values = $names;
$year_dropdown = html_drop_down_arrays("year",$names,$values,date("Y",time()));
///////////////////

/* get names */
$names ="";
$values = "";
$sql = "SELECT * FROM persons WHERE  (if($role_id>70,if($role_id>80,unit>=0,unit=$role_id),(id_role<12 and (select unit from persons where id_person=$person_id)=unit ))) order by letter ASC"; 
$result = $db->fetchAll($sql);
foreach ($result as $res) {

	$names[] .= $res["last"]." ".$res["first"];
	$values[] .= $res["id_person"];
}
$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop);
//////////////////////


//spremenljivki za mesec ine leto
if ($mon<1 or $mon>12)
	$mon ='';


if (!$year)
	$year = date("Y",time());



if ($mon and $year and $name_drop) {
	//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse

	if ($role_id<$ROLE_ADMIN and $role_id>$ROLE_LEADER){

		$sql = "SELECT `id`,day(from_unixtime(start))datum,`timestamp`,
                                applic.name program,work.name delo, `testing`,`persons`.`first` ime_varov,
                                `persons`.`last` priim_varov, time(from_unixtime(`start`)) start, time(from_unixtime(`end`)) end ,
                                 sec_to_time((`end`) -(`start`)) delal,sec_to_time((`end`) -(`start`)-pause) adelal,
                                 sec_to_time(`work_log`.`pause`) odmori,`work_log`.`assessment` ocena, `work`.`name`, `comm`,`work`.`payment`, unit, id_role
                        FROM
                                (applic JOIN `work` ON applic.`applic_id`=work.`applic_id`)
                              RIGHT OUTER JOIN
                                (persons right outer join work_log on persons.id_person=work_log.person_id) ON work_log.work_id=work.work_id
                        WHERE  `persons`.`unit`=$role_id and `id_person`=$name_drop  and month(from_unixtime(start))=$mon and year(from_unixtime(start))=$year
                        ORDER BY applic.name,date(from_unixtime(start))"; ///unit ne pozabit
                    
                    /* $sql = "SELECT `id`,day(from_unixtime(start))datum,`timestamp`,
                                applic.name program,work.name delo, `testing`,`persons`.`first` ime_varov,
                                `persons`.`last` priim_varov, time(from_unixtime(`start`)) start, time(from_unixtime(`end`)) end ,
                                 sec_to_time((`end`) -(`start`)) delal,sec_to_time((`end`) -(`start`)-pause) adelal,
                                 sec_to_time(`work_log`.`pause`) odmori,`work_log`.`assessment` ocena, `work`.`name`, `comm`,`work`.`payment`, unit, id_role
                        FROM
                                (applic JOIN `work` ON applic.`applic_id`=work.`applic_id`)
                              RIGHT OUTER JOIN
                                (persons right outer join work_log on persons.id_person=work_log.person_id) ON work_log.work_id=work.work_id
                        WHERE if($role_id<$ROLE_ADMIN, if($role_id>$ROLE_LEADER,(`persons`.`unit`=$role_id),assessor_id=$person_id),unit>=0) and `id_person`=$name_drop  and month(from_unixtime(start))=$mon and year(from_unixtime(start))=$year
                        ORDER BY applic.name,date(from_unixtime(start))";                
*/
	}

	else{		

		$sql = "SELECT `id`,day(from_unixtime(start))datum,`timestamp`, 
                                applic.name program,work.name delo, `testing`,`persons`.`first` ime_varov,
                                `persons`.`last` priim_varov, time(from_unixtime(`start`)) start, time(from_unixtime(`end`)) end ,
                                 sec_to_time((`end`) -(`start`)) delal,sec_to_time((`end`) -(`start`)-pause) adelal,
                                 sec_to_time(`work_log`.`pause`) odmori,`work_log`.`assessment` ocena, `work`.`name`, `comm`,`work`.`payment`, unit, id_role
                        FROM
                            (applic JOIN `work` ON applic.`applic_id`=work.`applic_id`)
                           RIGHT OUTER JOIN
                              (persons right outer join work_log on persons.id_person=work_log.person_id) ON work_log.work_id=work.work_id
                        WHERE  `id_person`=$name_drop  and month(from_unixtime(start))=$mon and year(from_unixtime(start))=$year
                        ORDER BY applic.name,date(from_unixtime(start))"; //brez unit  
	}

//	echo $sql;

	$result = $db->fetchAll($sql);

	$time2 = time();

	//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
	foreach ($result as $res) {
                $table = $row;
 		$table = str_replace("##ID##",$res["id"],$table);	
		$table = str_replace("##DATUM##",$res["datum"],$table);	
		//$table = str_replace("##NAME##",$res["ime_varov"]." ".$res["priim_varov"],$table);
		$table = str_replace("##PROGRAM##",$res["program"],$table);	
		$table = str_replace("##DELO##",$res["delo"],$table);	
		$table = str_replace("##DELAL##",$res["delal"],$table);	
		$table = str_replace("##ODMOR##",$res["odmori"],$table);	
		$table = str_replace("##ADELAL##",$res["adelal"],$table);
		$table = str_replace("##OCENA##",$res["ocena"],$table);		
		$table = str_replace("##OCENJEV##",$res["testing"],$table);
		$table = str_replace("##COMM##",$res["comm"],$table);		
		$whole_table.=$table;
	}
}




$tem = str_replace("##AMOUNT##",$amount,$tem);
$tem = str_replace("##YDROP##",$year_dropdown,$tem);
$tem = str_replace("##MDROP##",$month_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");


echo $tem;
