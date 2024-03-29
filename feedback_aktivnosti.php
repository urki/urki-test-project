<?php

require_once("inc/config.php");


check_role($ROLE_USER);
$TITLE = "Vloga za vpis aktivnosti";



//$tem = template_open("NEWadd_work_emplo.tpl").
//$tem = template_open("feedback_aktivnosti_employe.tpl"); .
        $tem = template_open("feedback_aktivnosti.tpl");// . //NEWaktivnosti_head.tpl").
   //     $tem = template_open("NEWview_last_insert_client_diary.tpl") .
    //    $tem = template_open("NEWview_client_diary.tpl");

//$tem = template_add_head_foot($tem,head,blank);
$tem = template_add_head_foot($tem, head, foot);


   
//Za izpis tistih katere hočem videti  - to moram prestavit v funkcijo!!!!!!!

if ($role_id) {

    switch ($role_id) {

        case ($role_id >= $ROLE_ADMIN):
            $tem = template_clean_up_tags($tem, "##IF_BUT_ADMIN##", 1);
            $tem = str_replace("##IF_ADMIN##", "", $tem);
            $tem = str_replace("##IF_LEADER##", "", $tem);
            $conditionUnit="";//to be in that unit
            break;

        case ($role_id < $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = str_replace("##IF_BUT_LEADER##", "", $tem);
            if ($unit>=77 or $unit>=78){
            $conditionUnit="and unit in (77,78)";
            }
            else   {$conditionUnit="and unit=$unit"; }
            break;
 
       case ($role_id < $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
            $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
            $tem = template_clean_up_tags($tem, "##IF_LEADER##", 1);
            $tem = str_replace("##IF_BUT_LEADER##", "", $tem);
               if ($unit>=77 or $unit>=78){
                 $conditionUnit="and unit in (77,78)";
               }
               else {  $conditionUnit="and unit=$unit";}//to be in that unit
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
//KONEC  Za izpis tistih katere hočem  - to moram prestavit v funkcijo!!!!!!!
///////////////////////////////////////////////////////////////////////////////////7
//get name of login person
   
   

/*Začasna pogoj za skupni mozirje in velenje
 * 
 */
 
    
       
   
   
   
$nameOfloginPerson = $db->fetchOne("SELECT first FROM `persons` WHERE id_person=$person_id");




///for activity of employed
$emphour_start_time = range(0, 23);
$emphour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop", $emphour_start_time, $emphour_start_time, $hour_start_time_drop); //date("H",time()));

$empmin_start_time = range(0, 59);
$empmin_start_time_dropdown = html_drop_down_arrays("emp_min_start_time_drop", $empmin_start_time, $empmin_start_time, $emp_min_start_time_drop); //date("H",time()));

$emphour_stop_time = range(0, 23);
$emphour_stop_time_dropdown = html_drop_down_arrays("emp_hour_stop_time_drop", $emphour_stop_time, $emphour_stop_time, $emp_hour_stop_time_drop); //date("H",time()));

$empmin_stop_time = range(0, 59);
$empmin_stop_time_dropdown = html_drop_down_arrays("emp_min_stop_time_drop", $empmin_stop_time, $empmin_stop_time, $emp_min_stop_time_drop); //date("H",time()));


$empday = range(1, 31);
$emp_day_dropdown = html_drop_down_arrays("emp_day_drop", $empday, $empday, date("j", time()));

$empmonth = range(1, 12);
$emp_month_dropdown = html_drop_down_arrays("emp_month_drop", $empmonth, $empmonth, date("n", time()));

$empyear = range(2009, (date("Y", time())) + 1);
$emp_year_dropdown = html_drop_down_arrays("emp_year_drop", $empyear, $empyear, date("Y", time()));




//dropdown locations
$sql = "SELECT * FROM locations where `type`=1 order by `name_location`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($wlname)) {
        $wlname[] = "izberi lokacijo...";
        $wlvalue[] = "";
    }
    $wlname[] .= $res["name_location"];
    $wlvalue[] .= $res["id"];
}
$wlocation_dropdown = html_drop_down_arrays("wlocation_drop", $wlname, $wlvalue, $wlocation_drop);
//
//drop down za dolocitev vpisovalca aktivnosti
$emp_sql = "SELECT * FROM persons WHERE 20<`id_role` and unit<>0 order by unit, letter ASC";
$result = $db->fetchAll($emp_sql);
foreach ($result as $res) {
    if (!is_array($emp_assnames)) {
        $emp_assnames[] = "zaposleni"; //"ime in priimek...";
        $emp_assvalues[] = "";
    }
    $emp_assnames[] .= $res["last"] . " " . $res["first"];
    $emp_assvalues[] .= $res["id_person"];
}
$emp_ass_name_dropdown = html_drop_down_arrays("emp_ass_name_drop", $emp_assnames, $emp_assvalues, $emp_ass_name_drop);




//dropdown za izbiro aktivnosti uporabnika
$emp_sql = "SELECT * FROM `work` WHERE `group` between 11 and 99  ORDER BY `applic`";
$result = $db->fetchAll($emp_sql);
foreach ($result as $res) {
    if (!is_array($emp_wname)) {
        $emp_wname[] = "izberi aktivnost...";
        $emp_wvalue[] = "";
    }
    $emp_wname[] .= $res["applic"] . " --> " . $res["name"];
    $emp_wvalue[] .= $res["work_id"];
}
$emp_work_dropdown = html_drop_down_arrays("emp_work_drop", $emp_wname, $emp_wvalue, $emp_work_drop);



//$name = $_REQUEST['name'];



if ($_REQUEST['addemploy'] == "   Shrani   ") {

        $emp_start_time = mktime($hour_start_time_drop, $emp_min_start_time_drop, 0, $emp_month_drop, $emp_day_drop, $emp_year_drop);
        $emp_stop_time = mktime($emp_hour_stop_time_drop, $emp_min_stop_time_drop, 0, $emp_month_drop, $emp_day_drop, $emp_year_drop);
        $emp_ass_name_drop = $person_id;
  




//Preveri če so vsa polja izpolnjena

    //  if ($person_id and $emp_work_drop and $emp_start_time and $emp_stop_time and ($emp_start_time < $emp_stop_time) and (($emp_stop_time - $emp_start_time) > $pause_time) and $name_drop != 0) {
    if ($person_id and $emp_work_drop and $emp_start_time and $emp_stop_time and $emp_ass_name_drop != 0 and $wlocation_drop != 0) {

        //test
        //$messagetype = "notice";
        //$message .= ' Izpolnil se je pogoj, da so vsa polja polna!!<br />';
        //konecTesta

        $allow = true;
        $all_fields = true;
    } else {
        $allow = false;
        $messagetype = "error";
        $message .= ' Izpolni vsa polja!!<br />';
        //test
        //$message .= "Izpolni vsa polja!! person_id=$person_id, emp_work=$emp_work_drop, emp_start_time=$emp_start_time, emp_stop_time=$emp_stop_time, emp_ass_name_drop=$emp_ass_name_drop <br />";
        //test
    }

    //če so izpolnjna...
    if ($allow == true) {

//preveri če se prekriva

        $emp_sql = "SELECT timestamp ,id FROM work_log  where (person_id = 'emp_ass_name_drop'  and  (end >'$emp_start_time' AND start<'$emp_stop_time')) or person_id= '$emp_ass_name_drop' and  (end >'$emp_start_time' AND start<'$emp_stop_time')";
        try {
            $result = $db->fetchAll($emp_sql);
            $overlap = true;
            if (!$result) {
                $allow = true;
            } else {
                $check_id = $result[0]["id"];

                $messagetype = "error";
                //začasno izklopljena
                $message .= 'Vnos se prekriva z  vnosom številka: <a href="view_client_work.php?id=' . $check_id . '" target="_blank">' . $check_id . '</a> <br />';
               // $message .= 'Vnos se prekriva z vnosom številka: <b>' . $check_id . '</b></a> <br />';
                $allow = false;
            }
        } catch (Exception $e) {
            $messagetype = "error";
            $message .= ' Napaka. Prosim obvestite administratorja!';
        }

        //preveri čase
        if ($emp_start_time > $emp_stop_time) {
            $allow = false;
            $messagetype = "error";
            $message .= ' Začetni čas ne more biti večji od končnega!';
        }

        //preveri če je neaktivnost večja od aktivnosti
        if (($emp_stop_time - $emp_start_time and ($emp_stop_time - $emp_start_time) > 0) < $pause_time) {
            $allow = false;
            $messagetype = " error";
            $message .= ' Čas neaktivnost ne more biti daljši od celotne časa aktivnost!';
        }

        //preveri če sta časa enaka
        if (($emp_stop_time == $emp_start_time)) {
            $allow = false;
            $messagetype = " error";
            $message .= ' Časa začetka in konca sta enaka - vnos ni mogoč!';
        }


        //Preveri če je takrat na šihtu

        $emp_sql_job = "select *
              from log
              where person_id=$emp_ass_name_drop and $emp_start_time>=start and $emp_stop_time<=end";
        //  where person_id=$emp_ass_name_drop and $emp_start_time<end and $emp_stop_time>start";
        try {
            $result_onjob = $db->fetchAll($emp_sql_job);
            if ($result_onjob) {
                $allow_onjob = true;
            } else {
                $notonjob = true;
                $messagetype = "error";
                $message .= ' Ocenjevalca ni v službi!<br />';
                $allow_onjob = false;
            }
        } catch (Exception $e) {
            if ($notonjob == false) {
                $messagetype = "error";
                $message .= ' Ocenjevalec ni bil izbran!<br />';
                echo $emp_sql_job;
                $allow_onjob = false;
            }
        }
    }


//če je še vedno dovoljeno potem...
   // if ($allow == true and $allow_onjob == true) {

        //dejansko vnesemo
        $data = array(
            'person_id' => $emp_ass_name_drop,
            'assessor_id' => "0", //$person_id,
            'work_id' => $emp_work_drop,
            'start' => $emp_start_time,
            'end' => $emp_stop_time,
            'location_id' => $wlocation_drop,
            'comm' => $noteemploy.' napake so:'. $message,
        );
       
        $db->insert('feedback_work_log', $data);
        $allow = false;
        $allow_onjob = false;
        //$message .= "Vnos je dodan";
        //header("location:".$_SERVER['HTTP_REFERER']);
      //  header("location:aktivnosti.php" . $param);
      //  exit;

         $messagetype = "success";
        $message .= ' Prošnja je oddana!<br />';

  //  }
}
$tem = str_replace("##WADAY##", $emp_day_dropdown, $tem);
$tem = str_replace("##WAMONTH##", $emp_month_dropdown, $tem);
$tem = str_replace("##WAYEAR##", $emp_year_dropdown, $tem);
$tem = str_replace("##WWORK_DROP##", $emp_work_dropdown, $tem);
$tem = str_replace('##WSTARTTIMEHOUR##', $emphour_start_time_dropdown, $tem);
$tem = str_replace('##WSTARTTIMEMIN##', $empmin_start_time_dropdown, $tem);
$tem = str_replace('##WSTOPTIMEHOUR##', $emphour_stop_time_dropdown, $tem);
$tem = str_replace('##WSTOPTIMEMIN##', $empmin_stop_time_dropdown, $tem);
$tem = str_replace("##WLOCATION_DROP##", $wlocation_dropdown, $tem);
$tem = str_replace("##WJOB_DROP##", $emp_work_dropdown, $tem);
$tem = str_replace("##WNAME_DROP##", $emp_ass_name_dropdown, $tem);
//$tem = str_replace("##WMESSAGE##", $wmessage, $tem);
////////////////
/////////////////
/////////////////$emp_ass_name_dropdown
////////////////
////////////////
// Activity of users

$qhour_start_time = range(0, 23);
//$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop",$qhour_start_time,$qhour_start_time,"8");//date("H",time()));
$qhour_start_time_dropdown = html_drop_down_arrays("hour_start_time_drop", $qhour_start_time, $qhour_start_time, $hour_start_time_drop); //date("H",time()));



$qmin_start_time = range(0, 59);
$qmin_start_time_dropdown = html_drop_down_arrays("min_start_time_drop", $qmin_start_time, $qmin_start_time, $min_start_time_drop); //date("H",time()));



$qhour_stop_time = range(0, 23);
$qhour_stop_time_dropdown = html_drop_down_arrays("hour_stop_time_drop", $qhour_stop_time, $qhour_stop_time, $hour_stop_time_drop); //date("H",time()));

$qmin_stop_time = range(0, 59);
$qmin_stop_time_dropdown = html_drop_down_arrays("min_stop_time_drop", $qmin_stop_time, $qmin_stop_time, $min_stop_time_drop); //date("H",time()));



$qpause_hour_time = range(0, 23);
$qpause_hour_time_dropdown = html_drop_down_arrays("pause_hour_time_drop", $qpause_hour_time, $qpause_hour_time, $pause_hour_time_drop); //date("H",time()));

$qpause_min_time = range(0, 59);
$qpause_min_time_dropdown = html_drop_down_arrays("pause_min_time_drop", $qpause_min_time, $qpause_min_time, $pause_min_time_drop); //date("H",time()));


$qrating = range(1, 5);
$qrating_dropdown = html_drop_down_arrays("rating_drop", $qrating, $qrating, "3"); //date("H",time()));




$qday = range(1, 31);
$day_dropdown = html_drop_down_arrays("day_drop", $qday, $qday, date("j", time()));

$qmonth = range(1, 12);
$month_dropdown = html_drop_down_arrays("month_drop", $qmonth, $qmonth, date("n", time()));

$qyear = range(2009, (date("Y", time())) + 1);
$year_dropdown = html_drop_down_arrays("year_drop", $qyear, $qyear, date("Y", time()));



//drop down za dolocitev uporabnika katerega se vpisuje
$sql = "SELECT * FROM persons WHERE $ROLE_USER>=`id_role` and unit<>0  $conditionUnit order by unit, letter ASC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($names)) {
        $names[] = "uporabnik"; //ime in priimek...";
        $values[] = "";
    }
    $names[] .= $res["last"] . " " . $res["first"];
    $values[] .= $res["id_person"];
}
//$name_drop=isset($name_drop);

$name_dropdown = html_drop_down_arrays("name_drop", $names, $values, $name_drop);


////////////////
//drop down za dolocitev vpisovalca aktivnosti
$sql = "SELECT * FROM persons WHERE 20<`id_role` and unit<>0 order by unit, letter ASC";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($assnames)) {
        $assnames[] = "ocenjevalec"; //"ime in priimek...";
        $assvalues[] = "";
    }
    $assnames[] .= $res["last"] . " " . $res["first"];
    $assvalues[] .= $res["id_person"];
}
$ass_name_dropdown = html_drop_down_arrays("ass_name_drop", $assnames, $assvalues, $ass_name_drop);

//dropdown za izbiro aktivnosti uporabnika
$sql = "SELECT * FROM `work` WHERE $ROLE_USER>=`group` ORDER BY `applic`";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($wname)) {
        $wname[] = "izberi aktivnost...";
        $wvalue[] = "";
    }
    $wname[] .= $res["applic"] . " --> " . $res["name"];
    $wvalue[] .= $res["work_id"];
}
//$work_drop=isset($work_drop);
$work_dropdown = html_drop_down_arrays("work_drop", $wname, $wvalue, $work_drop);
////////////
//get user id
$sql = "SELECT id_person FROM persons where username='$identity'";
$user_id = $db->fetchOne($sql);


//$name = isset($name);
$name = $_REQUEST['name'];


if ($_REQUEST['add'] == "    Shrani    ") {




    //Če je administrator se štejejo tudi dnevi in se lahko izbere tudi ocenjevalec
    If ($role_id >= 80) {
        $start_time = mktime($hour_start_time_drop, $min_start_time_drop, 0, $month_drop, $day_drop, $year_drop);
        $stop_time = mktime($hour_stop_time_drop, $min_stop_time_drop, 0, $month_drop, $day_drop, $year_drop);
        $pause_time = $pause_hour_time_drop * 3600 + $pause_min_time_drop * 60;
        $note.="//dodal $nameOfloginPerson";
    }
    //če pa je "samo" vodja pa ne more vpisovati dni in ocenjevalca
    else {
        $start_time = mktime($hour_start_time_drop, $min_start_time_drop, 0, $month_drop, $day_drop, $year_drop);
        $stop_time = mktime($hour_stop_time_drop, $min_stop_time_drop, 0, $month_drop, $day_drop, $year_drop);
        $pause_time = $pause_hour_time_drop * 3600 + $pause_min_time_drop * 60;
        $ass_name_drop = $user_id;
    }




//Preveri če so vsa polja izpolnjena
    //  if ($user_id and $work_drop and $start_time and $stop_time and ($start_time < $stop_time) and (($stop_time - $start_time) > $pause_time) and $name_drop != 0) {
    if ($user_id and $work_drop and $start_time and $stop_time and $name_drop != 0) {
        $allow = true;
        $all_fields = true;
    } else {
        $allow = false;
        $messagetype = "error";
        $message .= ' Izpolni vsa polja!!<br />';
    }

    //če so izpolnjna...
    if ($allow == true) {

//preveri če se prekriva

        $sql = "SELECT timestamp ,id FROM work_log  where (person_id = '$name_drop'  and  (end >'$start_time' AND start<'$stop_time')) or person_id= '$ass_name_drop' and  (end >'$start_time' AND start<'$stop_time')";
        try {
            $result = $db->fetchAll($sql);
            $overlap = true;
            if (!$result) {
                $allow = true;
            } else {
                $check_id = $result[0]["id"];
                //echo $sql;
                $messagetype = "error";
                //začasno izklopljena
                //$message .= 'Vnos se prekriva z  vnosom številka: <a href="view_client_work.php?id=' . $check_id . '" target="_blank">' . $check_id . '</a> <br />';


                $message .= 'Vnos se prekriva z vnosom številka: <b>' . $check_id . '</b></a> <br />';
                $allow = false;
            }
        } catch (Exception $e) {
            $messagetype = "error";
            $message .= ' Napaka. Prosim obvestite administratorja!';
        }

        //preveri čase
        if ($start_time > $stop_time) {
            $allow = false;
            $messagetype = "error";
            $message .= ' Začetni čas ne more biti večji od končnega!';
        }

        //preveri če je neaktivnost večja od aktivnosti
        if (($stop_time - $start_time and ($stop_time - $start_time) > 0) < $pause_time) {
            $allow = false;
            $messagetype = " error";
            $message .= ' Čas neaktivnost ne more biti daljši od celotne časa aktivnost!';
        }

        //preveri če sta časa enaka
        if (($stop_time == $start_time)) {
            $allow = false;
            $messagetype = " error";
            $message .= ' Časa začetka in konca sta enaka - vnos ni mogoč!';
        }


        //Preveri če je takrat na šihtu
       
      

        $sql_job = "select *
              from log
              where person_id=$ass_name_drop and $start_time>=start and $stop_time<=end";
        //  where person_id=$ass_name_drop and $start_time<end and $stop_time>start";
        try {
            $result_onjob = $db->fetchAll($sql_job);
            if ($result_onjob) {
                $allow_onjob = true;
            } else {
                $notonjob = true;
                $messagetype = "error";
                $message .= ' Ocenjevalca ni v službi!<br />';
                $allow_onjob = false;
            }
        } catch (Exception $e) {
            if ($notonjob == false) {
                $messagetype = "error";
                $message .= ' Ocenjevalec ni bil izbran!<br />';
                echo $sql_job;
                $allow_onjob = false;
            }
        }
    }



//če je še vedno dovoljeno potem...
    //if ($allow == true and $allow_onjob == true) {

        //dejansko vnesemo
        $data = array(
            'person_id' => $name_drop,
            'assessor_id' => $ass_name_drop, //$user_id,
            'work_id' => $work_drop,
            'start' => $start_time,
            'end' => $stop_time,
            'pause' => $pause_time,
            'assessment' => $rating_drop, //$assessment,
            'comm' => $note." napake pri vnosu so bile:".$message,
            'testing' => $identity,
            'status' =>0
        );
        $db->insert('feedback_work_log', $data);


       
        //header("location:".$_SERVER['HTTP_REFERER']);
        // header("location:aktivnosti.php" . $param);
        $messagetype = "success";
        if ($message) {$obvestilo='Napake bomo preverili.';}
        else {$obvestilo="";}
        $message .= ' Vloga za vpis je oddana.<br />'.$obvestilo.'<br />';


        // exit;
    //}
}





///////////////Konec Izpis vpisov trenutnega dne urejenih po abecedi





$tem = str_replace('##MESSAGETYPE##', $messagetype, $tem);
$tem = str_replace('##ADAY##', $day_dropdown, $tem);
$tem = str_replace('##AMONTH##', $month_dropdown, $tem);
$tem = str_replace('##AYEAR##', $year_dropdown, $tem);
$tem = str_replace('##STARTTIMEHOUR##', $qhour_start_time_dropdown, $tem);
$tem = str_replace('##STARTTIMEMIN##', $qmin_start_time_dropdown, $tem);
$tem = str_replace('##STOPTIMEHOUR##', $qhour_stop_time_dropdown, $tem);
$tem = str_replace('##STOPTIMEMIN##', $qmin_stop_time_dropdown, $tem);
$tem = str_replace('##PAUSEHOURTIME##', $qpause_hour_time_dropdown, $tem);
$tem = str_replace('##PAUSEMINTIME##', $qpause_min_time_dropdown, $tem);
$tem = str_replace('##RATING##', $qrating_dropdown, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##NAMES##', $name_dropdown, $tem);
$tem = str_replace('##ASSNAMES##', $ass_name_dropdown, $tem);
$tem = str_replace("##LOCATION_DROP##", $location_dropdown, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = str_replace('##WORK##', $work_dropdown, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
?>
