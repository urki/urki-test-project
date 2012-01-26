<?php
$time = time();
require_once("inc/config.php");

check_role($ROLE_LEADER);
$TITLE = "Grafično poročilo uporabnikov";


$tem = template_open("view_report.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];
$mon = $_REQUEST["mon"];
$year =(int)$_REQUEST["year"];
$name_drop =(int)$_REQUEST["name_drop"];
$year_only =$_REQUEST["year_only"];

include 'month_dropdown.php';
include 'year_dropdown.php';
include 'name_dropdown.php';
///year dropdown//
// ce se dela vrzi v smeti - moralo bi delat  $names ='';

///////////////////

/* get names */

//////////////////////


//spremenljivki za mesec ine leto
if ($mon<1 or $mon>12)
	$mon ='';


if (!$year)
	$year = date("Y",time());



if ($mon and $year and $name_drop) {
	//Query za izpis dela varovancev po tipu (izpis naj bo mesečni in letni)
	$whole_table.= $row;
	$params = "?type_q=##TYPE_Q##&period=##PERIOD##&person_id=##PERSON_ID##&subtitle=##SUBTITLE##&title_graph=##TITLE_GRAPH##";
	$params = str_replace("##TITLE_GRAPH##","Aktivnosti uporabnikov po tipu",$params);
	$whole_table = str_replace("##PIE_TYPE##","Pie3D",$whole_table);
	$params = str_replace("##PERSON_ID##",$name_drop,$params);
	if ($year_only=="on") {
		//potem prikazemo samo za leto 
		$params = str_replace("##PERIOD##",$year,$params);
		$params = str_replace("##SUBTITLE##","za leto $year",$params);
	} else {
		//potem prikazemo za mesec in leto 
		$params = str_replace("##PERIOD##",$mon.$year,$params);
		$params = str_replace("##SUBTITLE##","za mesec $mon - $year",$params);
	}
	$params = str_replace("##TYPE_Q##",1,$params);
	$whole_table = str_replace("##PARAMS##",urlencode($params),$whole_table);
	/// end query one//
	
	//Query zuery za izpis dela varovancev zgrupiranih po programu del izpisanih po mesecu un zgrupi(Column3D) 
	$whole_table.= $row;
	$params = "?type_q=##TYPE_Q##&period=##PERIOD##&person_id=##PERSON_ID##&subtitle=##SUBTITLE##&title_graph=##TITLE_GRAPH##";
	$params = str_replace("##TITLE_GRAPH##","aktivnosti uporabnikov po programu",$params);
	$whole_table = str_replace("##PIE_TYPE##","Column3D",$whole_table);
	$params = str_replace("##PERSON_ID##",$name_drop,$params);
	if ($year_only=="on") {
		//potem prikazemo samo za leto 
		$params = str_replace("##PERIOD##",$year,$params);
		$params = str_replace("##SUBTITLE##","za leto $year",$params);
	} else {
		//potem prikazemo za mesec in leto 
		$params = str_replace("##PERIOD##",$mon.$year,$params);
		$params = str_replace("##SUBTITLE##","za mesec $mon - $year",$params);
	}
	$params = str_replace("##TYPE_Q##",2,$params);
	$whole_table = str_replace("##PARAMS##",urlencode($params),$whole_table);
	/// end query two//
	
	//Query zuery Prisotnost
	$whole_table.= $row;
	$params = "?type_q=##TYPE_Q##&period=##PERIOD##&person_id=##PERSON_ID##&subtitle=##SUBTITLE##&title_graph=##TITLE_GRAPH##";
	$params = str_replace("##TITLE_GRAPH##","prisotnost uporabnika",$params);
	$whole_table = str_replace("##PIE_TYPE##","Column3D",$whole_table);
	$params = str_replace("##PERSON_ID##",$name_drop,$params);
	if ($year_only=="on") {
		//potem prikazemo samo za leto 
		$params = str_replace("##PERIOD##",$year,$params);
		$params = str_replace("##SUBTITLE##","za leto $year",$params);
                $titleDATE=" za"." ".$year;
	} else {
		//potem prikazemo za mesec in leto 
		$params = str_replace("##PERIOD##",$mon.$year,$params);
		$params = str_replace("##SUBTITLE##","za mesec $mon - $year",$params);
                $titleDATE=" za"." ".$mon."/".$year;
	}
	$params = str_replace("##TYPE_Q##",3,$params);
	$whole_table = str_replace("##PARAMS##",urlencode($params),$whole_table);
	/// end query two//
}


$tem = str_replace("##AMOUNT##",$amount,$tem);



$tem = str_replace("##MONTH##"," ".$titleDATE,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");


echo $tem;
