<?php

require_once("inc/config.php");


check_role($ROLE_USER);
$TITLE = "Aktivnosti";



//$tem = template_open("NEWadd_work_emplo.tpl").
$tem = template_open("drekstos.tpl").//NEWaktivnosti_head.tpl").

        $tem = template_open("NEWview_last_insert_client_diary.tpl").

        $tem = template_open("NEWview_client_diary.tpl");

//$tem = template_add_head_foot($tem,head,blank);
$tem = template_add_head_foot($tem,head,foot);

//Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!

if ($role_id) {

    switch ($role_id) {

        case ($role_id >= $ROLE_ADMIN):
            $tem = template_clean_up_tags($tem,"##IF_BUT_ADMIN##",1);
            $tem = str_replace("##IF_ADMIN##","",$tem);
            $tem = str_replace("##IF_LEADER##","",$tem);
            break;

        case ($role_id < $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
            $tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
            $tem = str_replace("##IF_BUT_LEADER##","",$tem);
            break;

        case ($role_id < $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
            $tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
            $tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
            $tem = str_replace("##IF_BUT_LEADER##","",$tem);
            break;

        default:

            $tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
            $tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
            $tem =  template_clean_up_tags($tem,"##IF_EMPLOYED##",1);
        //$tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
    }

} else {

    $tem =  template_clean_up_tags($tem,"##IF_ZALEC##",1);
    $head = template_clean_up_tags($head,"##IF_USER##",1);
    $tem =  template_clean_up_tags($tem,"##IF_ADMIN##",1);
    $tem =  template_clean_up_tags($tem,"##IF_LEADER##",1);
    $tem =  template_clean_up_tags($tem,"##IF_EMPLOYED##",1);
}
//KONEC  Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!


$qhour_start_time = range(0,23);
//$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,"8");//date("H",time()));
$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,$hour_start_time_drop);//date("H",time()));



$qmin_start_time = range(0,59);
$qmin_start_time_dropdown = html_drop_down_arrays("min_start_time_drop",$qmin_start_time,$qmin_start_time,$min_start_time_drop);//date("H",time()));



$qhour_stop_time = range(0,23);
$qhour_stop_time_dropdown = html_drop_down_arrays("hour_stop_time_drop",$qhour_stop_time,$qhour_stop_time,$hour_stop_time_drop);//date("H",time()));

$qmin_stop_time = range(0,59);
$qmin_stop_time_dropdown = html_drop_down_arrays("min_stop_time_drop",$qmin_stop_time,$qmin_stop_time,$min_stop_time_drop);//date("H",time()));



$qpause_hour_time = range(0,23);
$qpause_hour_time_dropdown = html_drop_down_arrays("pause_hour_time_drop",$qpause_hour_time,$qpause_hour_time,$pause_hour_time_drop);//date("H",time()));

$qpause_min_time = range(0,59);
$qpause_min_time_dropdown = html_drop_down_arrays("pause_min_time_drop",$qpause_min_time,$qpause_min_time,$pause_min_time_drop);//date("H",time()));


$qrating = range(1,5);
$qrating_dropdown = html_drop_down_arrays("rating_drop",$qrating,$qrating,"3");//date("H",time()));




$qday = range(1,31);
$day_dropdown = html_drop_down_arrays("day_drop",$qday,$qday,date("j",time()));

$qmonth = range(1,12);
$month_dropdown = html_drop_down_arrays("month_drop",$qmonth,$qmonth,date("n",time()));

$qyear = range(2009,(date("Y",time()))+1);
$year_dropdown = html_drop_down_arrays("year_drop",$qyear,$qyear,date("Y",time()));



//drop down za dolocitev uporabnika katerega se vpisuje
$sql = "SELECT * FROM persons WHERE $ROLE_USER>=`id_role` order by unit, letter ASC"; 
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($names)) {
        $names[] ="uporabnik";//ime in priimek...";
        $values[]="";
    }
    $names[] .= $res["last"]." ".$res["first"];
    $values[] .= $res["id_person"];
}
$name_dropdown = html_drop_down_arrays("name_drop",$names,$values,$name_drop); 
////////////////


//drop down za dolocitev vpisovalca aktivnosti
$sql = "SELECT * FROM persons WHERE 20<`id_role` order by unit, letter ASC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($assnames)) {
        $assnames[] ="ocenjevalec";//"ime in priimek...";
        $assvalues[]="";
    }
    $assnames[] .= $res["last"]." ".$res["first"];
    $assvalues[] .= $res["id_person"];
}
$ass_name_dropdown = html_drop_down_arrays("ass_name_drop",$assnames,$assvalues,$ass_name_drop);




$sql = "SELECT * FROM locations";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($lname)) {
        $lname[] ="izberi lokacijo...";
        $lvalue[]="";
    }
    $lname[] .= $res["id"]."; ".$res["name_location"];
    $lvalue[] .= $res["id"];

}
$location_dropdown = html_drop_down_arrays("location_drop",$lname,$lvalue,$location_drop); 
//////////////////////


//dropdown za izbiro aktivnosti uporabnika
$sql = "SELECT * FROM `work` WHERE $ROLE_USER>=`group` ORDER BY `applic`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($wname)) {
        $wname[] ="izberi aktivnost...";
        $wvalue[]="";
}
$wname[] .= $res["applic"]." --> ".$res["name"];
    $wvalue[] .= $res["work_id"];

}
$work_dropdown = html_drop_down_arrays("work_drop",$wname,$wvalue,$work_drop); 
////////////





//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql); 


$name = $_REQUEST['name'];


if ($_REQUEST['add'] == "    Shrani    "  ) {


    //Če je administrator se štejejo tudi dnevi in se lahko izbere tudi ocenjevalec
    If ($role_id>=80) {
        $start_time = mktime ($hour_start_time_drop, $min_start_time_drop, 0,  $month_drop ,$day_drop,$year_drop);
        $stop_time  = mktime ($hour_stop_time_drop , $min_stop_time_drop , 0,  $month_drop ,$day_drop,$year_drop);
        $pause_time = $pause_hour_time_drop*3600+$pause_min_time_drop*60;
    }
    //če pa je "samo" vodja pa ne more vpisovati dni in ocenjevalca
    else {
        $start_time = mktime ($hour_start_time_drop, $min_start_time_drop, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
        $stop_time = mktime ($hour_stop_time_drop,  $min_stop_time_drop, 0, date("n",time()) , date("j",time()) , $year= date("Y",time()));
        $pause_time =$pause_hour_time_drop*3600+$pause_min_time_drop*60;
        $ass_name_drop=$user_id;
    }






    if ($user_id and $work_drop and $start_time and $stop_time and ($start_time < $stop_time) and  (($stop_time-$start_time) > $pause_time) and $name_drop!=0) {

        $sql = "SELECT timestamp ,id FROM work_log  where (person_id = '$name_drop'  and  (end >'$start_time' AND start<'$stop_time')) or person_id= '$ass_name_drop' and  (end >'$start_time' AND start<'$stop_time')";

        $result = $db->fetchAll($sql);
        $success=true;
        $check_id=$result[0]["id"];



        if (!$result) {


            //dejansko vnesemo
            $data = array(
                    'person_id'      => $name_drop,
                    'assessor_id'    => $ass_name_drop, //$user_id,
                    'work_id'	 => $work_drop,
                    'start'		 => $start_time,
                    'end'		 => $stop_time,
                    'pause'          => $pause_time,
                    'assessment'     => $rating_drop,//$assessment,
                    'comm'		 => $note,
                    'testing'        => $identity
            );
            $db->insert('work_log', $data);

            //$message .= "Vnos je dodan";
            //header("location:".$_SERVER['HTTP_REFERER']);
            header("location:NEWaktivnosti.php".$param);
            exit;
        }


        if ($success) {
            echo "<script>alert('Vnos se prekriva z  vnosom številka $check_id')</script>";
            //$message.= "Vpis prekriva HMMMMMMM vnos". $check_id;
            // exit();
        } else {
            //....failed to update info
        }
        // $message.= "Vpis prekriva vnos". $check_id;

    } else {
        //($start_time < $stop_time) and  (($stop_time-$start_time) > $pause_time) and $name_drop!=0
        if ($start_time > $stop_time) {
            echo "<script>alert('Začetni čas ne more biti večji od končnega!')</script>";
        } elseif ((($stop_time-$start_time) < $pause_time)) {

            echo "<script>alert('Čas neaktivnost ne more biti daljši od celotne časa aktivnosti')</script>";
        }
        else {
            echo "<script>alert('Izpolni vsa polja')</script>";
            // $message.= "Izpolni vsa polja!";
        }
    }
    
}


/////////////
////////////
///////////77
//////////////



///////////Izpis zadnjih x vpisov - za admina izpiše ne glede na datum
$tmp = template_get_repeat_text("##DSTART_LOG##","##DSTOP_LOG##","##DLOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

//spremenljivki za mesec ine leto
if ($mon<1 or $mon>12)
    $mon ='';

if (!$mon)
    $mon = date("m",time());

if (!$year)
    $year = date("Y",time());

$day=date("j",time());




//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id<$ROLE_LEADER) {
    $dsql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and ((`assessor_id`>0 and
`assessor_id`=$person_id)or(assessor_id=0 and
work_log.`person_id`=$person_id)) and date(from_unixtime(end))=concat($year,'-',$mon,'-',$day) /* month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year and day(from_unixtime('end'))=$day */  order by log_id desc limit 0,3";
}



elseif ($role_id<$ROLE_ADMIN and $role_id>$ROLE_LEADER) {
    //$dsql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, priim_varov, ime_varov, zacetek";
    $dsql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and date(from_unixtime(end))=concat($year,'-',$mon,'-',$day) /* month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year */ order by log_id desc limit 0,3";


}

else {
    $dsql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id`,`work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` /*and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year */ order by log_id desc limit 0,3";
}





$dresult = $db->fetchAll($dsql);


foreach ($dresult as $dres) {
    $table = $row;
    $table = str_replace("##DID##",$dres["log_id"],$table);
    $table = str_replace("##DUSERS##",$dres["priim_varov"]." ".$dres["ime_varov"],$table);
    $table = str_replace("##DDAY##",$dres["datum"],$table);
    $table = str_replace("##DSTART##",$dres["zacetek"],$table);
    $table = str_replace("##DSTOP##",$dres["konec"],$table);
    $table = str_replace("##DNAME##",$dres["name"],$table);
    $table = str_replace("##DDESCRIPTION##",$dres["comm"],$table);
    $dwhole_table.=$table;
}
$tem = str_replace("##DLOGS##",$dwhole_table,$tem);
$tem = str_replace("##DMESSAGE##",$message,$tem);


///////////////Konec pregle x vpisov
















/////////////////
////////////////
///////////Izpis vpisov trenutnega dne/za admina zadnjih 40 urejenih po abecedi
$tmp = template_get_repeat_text("##START_LOG##","##STOP_LOG##","##LOGS##",$tem);

$row = $tmp[1];
$tem = $tmp[0];

//spremenljivki za mesec ine leto
if ($mon<1 or $mon>12)
    $mon ='';

if (!$mon)
    $mon = date("m",time());

if (!$year)
    $year = date("Y",time());

$day=date("j",time());


/*//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id<$ROLE_LEADER){
	$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and `assessor_id`=$person_id and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by log_id desc limit 0,15";
}
elseif ($role_id<$ROLE_ADMIN and $role_id>$ROLE_LEADER){
	$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by log_id desc limit 0,15";
}

else{
	$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id`,`work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by log_id desc limit 0,15";
}
*/


//////spreminjanja TE;P
//

//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse in dopisujejo vse
if ($role_id<$ROLE_LEADER) {
    $sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and ((`assessor_id`>0 and
`assessor_id`=$person_id)or(assessor_id=0 and
work_log.`person_id`=$person_id)) and date(from_unixtime(end))=concat($year,'-',$mon,'-',$day) /* month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year and day(from_unixtime('end'))=$day */  order by letter limit 0,30";
}



elseif ($role_id<$ROLE_ADMIN and $role_id>$ROLE_LEADER) {
    //$sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and `assessor_id`>0 and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year order by datum desc, priim_varov, ime_varov, zacetek";
    $sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id` , `work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` and `unit`=$unit and date(from_unixtime(end))=concat($year,'-',$mon,'-',$day) /* month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year */ order by letter";


}

else {
    $sql = "SELECT id as log_id, date_format(from_unixtime(`end`),'%d.%m.%Y') datum,`persons`.`first` ime_varov,`persons`.`last` priim_varov,`work`.`name`,time(from_unixtime(`start`)) zacetek, time(from_unixtime(`end`)) konec, `work_log`.`assessor_id`,`work_log`.`comm` from `work_log`,`work`,`persons` where `work`.`work_id`=`work_log`.`work_id` and `persons`.`id_person`=`work_log`.`person_id` /* and month(from_unixtime(`end`))=$mon and year(from_unixtime(`end`))=$year*/ order by letter asc  limit 0,40";
}



//////////////////////
//"SELECT id as log_id,
//                       date_format(from_unixtime(`end`),'%d.%m.%Y') datum,
//                       `persons`.`first` ime_varov,
//                       `persons`.`last` priim_varov,
//                       `work`.`name`,
//                       time(from_unixtime(`start`)) zacetek,
//                       time(from_unixtime(`end`)) konec,
//                       `work_log`.`assessor_id` ,
//                       `work_log`.`comm`
//               FROM `work_log`,
//                    `work`,
//                    `persons`
//               WHERE `work`.`work_id`=`work_log`.`work_id` and
//                     `persons`.`id_person`=`work_log`.`person_id` and
//                     ((`assessor_id`>0 and`
//                           assessor_id`=$person_id)or
//                        (assessor_id=0 and
//                           work_log.`person_id`=$person_id)) and
//                     month(from_unixtime(`end`))=$mon and
//                     year(from_unixtime(`end`))=$year
//              ORDER BY log_id desc
//              LIMIT 0,30";
////////////////////




$result = $db->fetchAll($sql);


foreach ($result as $res) {
    $table = $row;
    $table = str_replace("##LID##",$res["log_id"],$table);
    $table = str_replace("##LUSERS##",$res["priim_varov"]." ".$res["ime_varov"],$table);
    $table = str_replace("##LDAY##",$res["datum"],$table);
    $table = str_replace("##LSTART##",$res["zacetek"],$table);
    $table = str_replace("##LSTOP##",$res["konec"],$table);
    $table = str_replace("##LNAME##",$res["name"],$table);
    $table = str_replace("##LDESCRIPTION##",$res["comm"],$table);
    $whole_table.=$table;
}

$tem = str_replace("##LOGS##",$whole_table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);

///////////////Konec Izpis vpisov trenutnega dne urejenih po abecedi











/*

///////////////
//////////////////
///////////////
///////////////
/////////////
//////////////Vpis aktivnosti zaposlenih


//$sql = "SELECT `work_id`,`work`.`applic_id`,`subcat_id`, `applic`.`name` Program, `work`.`name` name, `opis` FROM `work`,`applic` WHERE '$role_id'>=`group` and `group`>'$ROLE_USER' and `work`.`applic_id`=`applic`.`applic_id` ORDER BY `work`.`applic_id`,`subcat_id`";



$wqhour_start_time = range(0,23);
//$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,"8");//date("H",time()));
$wqhour_start_time_dropdown = html_drop_down_arrays("wqhour_start_time_drop",$wqhour_start_time,$qwhour_start_time,$whour_start_time_drop);//date("H",time()));



$wqmin_start_time = range(0,59);
$wqmin_start_time_dropdown = html_drop_down_arrays("wqmin_start_time_drop",$wqmin_start_time,$wqmin_start_time,$wmin_start_time_drop);//date("H",time()));



$wqhour_stop_time = range(0,23);
$wqhour_stop_time_dropdown = html_drop_down_arrays("wqhour_stop_time_drop",$wqhour_stop_time,$wqhour_stop_time,$whour_stop_time_drop);//date("H",time()));

$wqmin_stop_time = range(0,59);
$wqmin_stop_time_dropdown = html_drop_down_arrays("wqmin_stop_time_drop",$wqmin_stop_time,$wqmin_stop_time,$wmin_stop_time_drop);//date("H",time()));




$wqday = range(1,31);
$wqday_dropdown = html_drop_down_arrays("wqday_drop",$wqday,$wqday,date("j",time()));

$wqmonth = range(1,12);
$wqmonth_dropdown = html_drop_down_arrays("wqmonth_drop",$wqmonth,$wqmonth,date("n",time()));

$wqyear = range(2009,(date("Y",time()))+1);
$wqyear_dropdown = html_drop_down_arrays("wqyear_drop",$wqyear,$wqyear,date("Y",time()));



//$sql = 'SELECT * FROM `work` WHERE $role_id>=`group` and `group`>$ROLE_USER ORDER BY `work`.`applic_id`,`subcat_id`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($waname)) {
		$waname[] ="izberi aktivnost...";
		$wavalue[]="";
	}
	$waname[] .= $res["applic_id"].".".$res["subcat_id"]." --> ".$res["name"];
	$wavalue[] .= $res["work_id"];

}
$wwork_dropdown = html_drop_down_arrays("wwork_drop",$waname,$wavalue,$wwork_drop);


$sql = "SELECT * FROM locations where `type`=1 order by `name_location`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
	if (!is_array($wlname)) {
		$wlname[] ="izberi lokacijo...";
		$wlvalue[]="";
	}
	$wlname[] .= $res["name_location"];
	$wlvalue[] .= $res["id"];

}
$wlocation_dropdown = html_drop_down_arrays("wlocation_drop",$wlname,$wlvalue,$wlocation_drop);



//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql);


$name = $_REQUEST['name'];





if ($_REQUEST['add'] == "    Shrani    ") {

    $start_time = mktime ($wqhour_start_time_drop, $wqmin_start_time_drop, 0,  $wqmonth_drop ,$wqday_drop,$wqyear_drop);
    $stop_time  = mktime ($wqhour_stop_time_drop , $wqmin_stop_time_drop , 0,  $wqmonth_drop ,$wqday_drop,$wqyear_drop);

      //Preveri, če so vsa polja izpolnjena in če se vpis slučajno ne prikeriva s kaksnim
	if ($user_id and //$name_dropdown and $job_dropdown and
                $wlocation_drop and $start_time and $stop_time and ($start_time < $stop_time)) {
		//$sql = "SELECT timestamp FROM work_log  where person_id = '$user_id' and work_id=$work_drop and location_id =$location_drop and start='$start_time' and end='$stop_time'";
                $sql = "SELECT timestamp,id FROM work_log  where (person_id = '$user_id'  and  (end >'$start_time' AND start<'$stop_time')) or assessor_id= '$user_id' and  (end >'$start_time' AND start<'$stop_time')";
		$result = $db->fetchAll($sql);
                $success=true;
               $check_id=$result[0]["id"];

               $neki="15";
               echo $neki;
		if (!$result) {


			//dejansko vnesemo
			$data = array(


                                                        

				'person_id'      => $wwork_drop,//"dadsa",//$wuser_id, //name_drop sem zamenjal z user_id saj se avtomatsko...
     		      	        'work_id'	 => $wwork_drop,
				'location_id'    => $wlocation_drop,
				'start'		 => $start_time,
				'end'		 => $stop_time,
				'comm'		 => $note
                             
                             
				);
			$db->insert('work_log', $data);
			//$message .= "Vnos je dodan";
			header("location:NEWadd_work_emplo.php");
                       // header("location:".$_SERVER['HTTP_REFERER']);
			exit;

		}



               else {

                  if ($success) {
                      echo "<script>alert('Vnos se prekriva z  vnosom številka $check_id')</script>";
                  }

               }
	} else {
              if ($success) {
                      echo "<script>alert('Izpolni vsa polja')</script>";
	}



}


$tem = str_replace("##WWORK_DROP##",$wwork_dropdown,$tem);
$tem= str_replace('##WSTARTTIMEHOUR##',$wqhour_start_time_dropdown,$tem);
$tem= str_replace('##WSTARTTIMEMIN##',$wqmin_start_time_dropdown,$tem);
$tem= str_replace('##WSTOPTIMEHOUR##',$wqhour_stop_time_dropdown,$tem);
$tem= str_replace('##WSTOPTIMEMIN##',$wqmin_stop_time_dropdown,$tem);
$tem = str_replace("##WLOCATION_DROP##",$wlocation_dropdown,$tem);
$tem = str_replace("##WJOB_DROP##",$wjob_dropdown,$tem);
$tem = str_replace("##WNAME_DROP##",$wname_dropdown,$tem);
$tem = str_replace("##WMESSAGE##",$wmessage,$tem);
$tem = template_clean_up_tags($tem,"##");

//////////////Konec aktivnisto zaposlenih
*/





$tem = str_replace('##ADAY##',$day_dropdown,$tem);
$tem = str_replace('##AMONTH##',$month_dropdown,$tem);
$tem = str_replace('##AYEAR##',$year_dropdown,$tem);
$tem= str_replace('##STARTTIMEHOUR##',$qhour_start_time_dropdown,$tem);
$tem= str_replace('##STARTTIMEMIN##',$qmin_start_time_dropdown,$tem);
$tem= str_replace('##STOPTIMEHOUR##',$qhour_stop_time_dropdown,$tem);
$tem= str_replace('##STOPTIMEMIN##',$qmin_stop_time_dropdown,$tem);
$tem= str_replace('##PAUSEHOURTIME##',$qpause_hour_time_dropdown,$tem);
$tem= str_replace('##PAUSEMINTIME##',$qpause_min_time_dropdown,$tem);
$tem= str_replace('##RATING##',$qrating_dropdown,$tem);
$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##NAMES##',$name_dropdown,$tem);
$tem = str_replace('##ASSNAMES##',$ass_name_dropdown,$tem);
//$tem = str_replace('##PROGRAM##',$appl_dropdown,$tem);
$tem = str_replace("##LOCATION_DROP##",$location_dropdown,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = str_replace('##WORK##',$work_dropdown,$tem);


$tem = str_replace('##USER##',$identity,$tem);
$tem = str_replace('##TITLE##',$TITLE,$tem);


$tem=template_clean_up_tags($tem,"##");
echo $tem;

?>
