<?php
$time = time();
require_once("inc/config.php");

check_role($ROLE_LEADER);

$TITLE = "Grafično poročilo zap.";
$tem = template_open("view_report.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];
$mon = $_REQUEST["mon"];
$year =(int)$_REQUEST["year"];
$name_drop =(int)$_REQUEST["name_drop"];
$year_only =$_REQUEST["year_only"];
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

$Y = date("Y",time());

$names ='';
for ($x=2009; $x<=$Y;$x++) {
	$names[].= $x;
}

$values = $names;

$year_dropdown = html_drop_down_arrays("year",$names,$values,date("Y",time()));
///////////////////

/* get names */
$names ="";
$values = "";
$sql = "SELECT * FROM persons WHERE id_role>10 AND unit>0 order by letter ASC"; 
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
	//Query za izpis dela varovancev po tipu (izpis naj bo mesečni in letni)
	$whole_table.= $row;
	$params = "?type_q=##TYPE_Q##&period=##PERIOD##&person_id=##PERSON_ID##&subtitle=##SUBTITLE##&title_graph=##TITLE_GRAPH##";
	$params = str_replace("##TITLE_GRAPH##","Pregled ur",$params);
	$whole_table = str_replace("##PIE_TYPE##","Column3D",$whole_table);
	$params = str_replace("##PERSON_ID##",$name_drop,$params);
	if ($year_only=="on") {
		//potem prikazemo samo za leto 
		$params = str_replace("##PERIOD##",$year,$params);
		$params = str_replace("##SUBTITLE##","za leto $year",$params);
                $titleDate='za '.$year;
	} else {
		//potem prikazemo za mesec in leto 
		$params = str_replace("##PERIOD##",$mon.$year,$params);
		$params = str_replace("##SUBTITLE##","za mesec $mon - $year",$params);
                $titleDate=$mon."/".$year;
	}
	$params = str_replace("##TYPE_Q##",4,$params);
	$whole_table = str_replace("##PARAMS##",urlencode($params),$whole_table);
	/// end query one//

}


$tem = str_replace("##AMOUNT##",$amount,$tem);
$tem = str_replace("##YDROP##",$year_dropdown,$tem);
$tem = str_replace("##MDROP##",$month_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
//$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace("##MONTH##"," ".$titleDate,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");


echo $tem;
