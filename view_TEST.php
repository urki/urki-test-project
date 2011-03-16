<?
$time = time();
require_once("inc/config.php");

check_role($ROLE_LEADER);
$TITLE = "Pregled vpisanih aktivnosti za";

$tem = template_open("view_TEST.tpl");
$tem = template_add_head_foot($tem,head,foot);

$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];
$mon = (int)$_REQUEST["mon"];
$amount =(int)$_REQUEST["amount"];

////month dropdown//
for( $x=1;$x<13;$x++)
	$names[] .= $x;

$values = $names;

$month_dropdown = html_drop_down_arrays("mon",$names,$values,date("m",time()));
///////////////////

/* get names */
$names ="";
$values = "";
$sql = "SELECT * FROM persons WHERE $ROLE_USER>=`id_role` order by letter ASC"; 
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

		$sql = ""; ///unit ne pozabit
	}

	else{		

		$sql = ""; //brez unit
	}

//	echo $sql;

	$result = $db->fetchAll($sql);

	$time2 = time();

	//log_id	timestamp	person_id	jobtype_id	start	end	note	job_id	name	description
	foreach ($result as $res) {
		$table = $row;
		$table = str_replace("##NAME##",$res["ime_varov"]." ".$res["priim_varov"],$table);
		$table = str_replace("##EUR##",round($res["eur"],2)."Eur",$table);	
		$whole_table.=$table;
	}
}


$tem = str_replace("##AMOUNT##",$amount,$tem);
$tem = str_replace("##MDROP##",$month_dropdown,$tem);
$tem = str_replace("##NAME_DROP##",$name_dropdown,$tem);
$tem = str_replace("##MONTH##"," ".$mon."/".$year,$tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);
$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = template_clean_up_tags($tem,"##");


echo $tem;