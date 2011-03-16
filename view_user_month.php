<?

require_once("inc/config.php");
check_role($ROLE_LEADER);

$TITLE = "Poro&#269;ilo evidence prisotnosti za";




//pogoj, da se ob razlicnem role_id odpre razlicen template
if ($role_id < 80) {
    //$tem = template_open("view_user_month_leader.tpl");
    $tem = template_open("view_user_month.tpl");
} else {
    $tem = template_open("view_user_month.tpl");
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

if (!$unit)
//ne vem zakja sem dal na role_id saj mora ja oddati za svojo enoto ali pač????
//$unit = $role_id;
    $unit = $unit;

//za izpis poročila, da so vse enote zaključile poročilo in tako tudi za izpise poročila posamezne enote
if (!$selunit)
    $selunit = "75,77,78,79";


$mesec_start = mktime(0, 0, 0, $mon, 1, $year);
$last_day = date("t", $mesec_start);
$mesec_end = mktime(0, 0, 0, $mon, $last_day, $year);
//////////////////////////
//pogoj, da ce imajo role_id nizji od 80 visijo samo svoj unit in ce je porocilo ze oddano vidijo oddanega iz log_reporta
if ($role_id < 80) {
    $sql = "SELECT * FROM persons where unit=$role_id and id_role>30 order by first ASC";

//If there's already log inserted we take it out of the DB//
    $sql_log = "SELECT *
	   FROM  `log_report`
	   WHERE date='" . $mon . $year . $unit . "' order by log_id DESC limit 1";
    $get_log = $db->fetchAll($sql_log);

    if ($get_log[0]["data"]) {
        //we delete ##IF_SAVE##
        $tem = template_clean_up_tags($tem, "##IF_SAVE##", 1);
        $LOG = unserialize($get_log[0]["data"]);
    }
}
//pogoj, da lahko vsi ki imajo nad 80 role_id vidijo vse
else {
    $sql = "SELECT * FROM persons where id_role>30 and unit in ($selunit)  order by first ASC";
}







if (!$LOG) {
    $result = $db->fetchAll($sql);

    foreach ($result as $res) {
        $person_id_db = $res['id_person'];
        $person_holiday = $res['holiday'];

        //kolk dopusta za celo leto//
        //$year_start = mktime (0, 0, 0, 1, 1, $year );
        //$sql_person = "select * from log where person_id='$person_id_db' and start>=$year_start";
        $sql_person = "select * from log where person_id='$person_id_db'";

        $result_person_year = $db->fetchAll($sql_person);
        if (is_array($result_person_year)) {
            foreach ($result_person_year as $rs_py) {
                switch ($rs_py['jobtype_id']) {
                    //sluzba
                    case "1":
                        $LOG[$person_id_db]["working_days_all"] +=1;
                        $LOG[$person_id_db]["working_hours_all"] += ( ($day_r['end'] - $day_r['start']));
                        //echo "SLUZBA!!";

                        break;

                    //izobra�evanje//
                    case "2":
                        $LOG[$person_id_db]["education_all"] +=1;
                        break;

                    //Izhodi//
                    case "3":
                        $LOG[$person_id_db]["offtime_hours_all"] += ( ($rs_py['end'] - ($rs_py['start'])));

                        break;

                    //bolniska//
                    case "6":
                        $LOG[$person_id_db]["sick_days_all"] +=1;
                        break;

                    //nadure
                    case "7":
                        $LOG[$person_id_db]["overtime_hours_all"] += ( ($rs_py['end'] - ($rs_py['start'])));
                        // $LOG[$person_id_db]["overtime_hours_all"] += sec_to_time(($rs_py['end']- ($rs_py['start'])));
                        break;

                    //nega//
                    case "8":
                        $LOG[$person_id_db]["care_all"] +=1;
                        break;


                    //dopust//
                    case "12":
                        $LOG[$person_id_db]["holiday_days_all"] +=1;
                        $LOG[$person_id_db]["holiday_hours_all"] += ( ($rs_py['end'] - $rs_py['start']));
                        break;

                    //porodniska//
                    case "13":
                        $LOG[$person_id_db]["pregnancy_all"] +=1;
                        break;

                    //drzavni praznik//
                    case "15":
                        $LOG[$person_id_db]["public_holiday_all"] +=1;
                        break;


                    //Izrednega dopusta skupaj//
                    case "16":
                        $LOG[$person_id_db]["special_leave_all"] +=1;
                        $LOG[$person_id_db]["specila_leave_all_hours"] += ( ($rs_py['end'] - $rs_py['start']));
                        break;


                    //Letni dopust odlocba//
                    case "20":
                        $LOG[$person_id_db]["holid_all_res"] += ( $rs_py['wdays']);
                        $LOG[$person_id_db]["holid_all_res_hours"] += ( ($rs_py['end'] - $rs_py['start']));
                        break;

                    //izravnava ur
                    case "21":
                        $LOG[$person_id_db]["compensation_hours_all"] += ( ($rs_py['end'] - ($rs_py['start'])));
                        break;

                    //študijski dopust//
                    case "22":
                        $LOG[$person_id_db]["sabbatical_leave_all"] +=1;
                        $LOG[$person_id_db]["sabbatical_leave_hours_all"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;

                    //Odločba Študijski dopust //
                    case "23":
                        $LOG[$person_id_db]["sabbatical_leave_all_res"] += ( $rs_py['wdays']);
                        $LOG[$person_id_db]["sabbatical_leave_all_res_hours"] += ( ($rs_py['end'] - $rs_py['start']));
                        break;

                    //Odločba Izrednega dopusta //
                    case "24":
                        $LOG[$person_id_db]["special_leave_all_res"] += ( $rs_py['wdays']);
                        $LOG[$person_id_db]["specila_leave_all_res_hours"] += ( ($rs_py['end'] - $rs_py['start']));
                        break;

                    //Izravnava dopustov ob poteku leta v katerem jih je đe možno izkoristiti//
                    case "25":
                        $LOG[$person_id_db]["compensation_wdays_all"] += ( $rs_py['wdays']);
                        break;


                    //ce ni zgoraj navedeno potem je zabusaval//
                    default:
                        $LOG[$person_id_db]["other_hours_all"] += ( ($rs_py['end'] - $rs_py['start']) / 3600 );
                }
            }
        }
        //kolk dopusta za celo leto KONEC//
        //KOLK ZA TRENUTNI MESEC//
        ////////////////////////////////////////////////////////////////////////////
        //	for ($x = 1; $x<=$last_day; $x++) {
        //	if ($x<10)
        //		$x = "0".$x;
        $ts = "$year" . " " . $mon . " " . $x;
        $ts_start = "$year" . " " . $mon . " " . "01";
        $ts_end = "$year" . " " . $mon . " " . $last_day;

        $sql = "select * from log where person_id='$person_id_db' and (date_format(from_unixtime(`end`),'%Y %m %d') >= '$ts_start' and date_format(from_unixtime(`end`),'%Y %m %d') <= '$ts_end')";
        //echo $sql."<Br>";
        $result_day = $db->fetchAll($sql);
        if (is_array($result_day))
            foreach ($result_day as $day_r) {
                //echo $day_r['jobtype_id']."<br>";
                switch ($day_r['jobtype_id']) {
                    //sluzba
                    case "1":
                        $LOG[$person_id_db]["working_days"] +=1;
                        $LOG[$person_id_db]["working_hours"] += ( ($day_r['end'] - $day_r['start']));
                        //echo "SLUZBA!!";
                        break;

                    //izobra�evanje//
                    case "2":
                        $LOG[$person_id_db]["education"] +=1;
                        break;

                    //Privat izhodi//
                    case "3":
                        $LOG[$person_id_db]["offtime_hours"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;

                    //bolniska//
                    case "6":
                        $LOG[$person_id_db]["sick_days"] +=1;
                        break;


                    //nadure
                    case "7":
                        $LOG[$person_id_db]["overtime_hours"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;

                    //nega//
                    case "8":
                        $LOG[$person_id_db]["care"] +=1;
                        break;

                    //Sluzbeno potovanje//
                    case "11":
                        $LOG[$person_id_db]["mission"] +=1;
                        $LOG[$person_id_db]["mission_hours"] += ( ($day_r['end'] - $day_r['start']));
                        break;


                    //dopust//
                    case "12":
                        $LOG[$person_id_db]["holiday_days"] +=1;
                        $LOG[$person_id_db]["holiday_hours"] += ( ($day_r['end'] - $day_r['start']));
                        break;



                    //porodniska//
                    case "13":
                        $LOG[$person_id_db]["pregnancy"] +=1;
                        break;



                    //drzavni praznik//
                    case "15":
                        $LOG[$person_id_db]["public_holiday"] +=1;
                        break;


                    //izredni dopust//
                    case "16":
                        $LOG[$person_id_db]["special_leave"] +=1;
                        $LOG[$person_id_db]["special_leave_hours"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;


                    //poškodba pri delu//
                    case "17":
                        $LOG[$person_id_db]["work_injury"] +=1;
                        $LOG[$person_id_db]["work_injury_hours"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;


                    //krvodajalska akcija//
                    case "18":
                        $LOG[$person_id_db]["blooday"] +=1;
                        $LOG[$person_id_db]["blooday_hours"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;

                    //študijski dopust//
                    case "22":
                        $LOG[$person_id_db]["sabbatical_leave"] +=1;
                        $LOG[$person_id_db]["sabbatical_leave_hours"] += ( ($day_r['end'] - ($day_r['start'])));
                        break;



                    //ce ni zgoraj navedeno potem je zabusaval//
                    default:
                        $LOG[$person_id_db]["other_hours"] += ( ($day_r['end'] - $day_r['start']) / 3600 );
                }
            }
        //	}
        $LOG[$person_id_db]["first"] = $res["first"];
        $LOG[$person_id_db]["last"] = $res["last"];
    }
}












$table = render_log_table($LOG, $row);
if ($save) {
    //save log file//
    $data = array(
        'date' => $mon . $year . $unit,
        'type' => 1,
        'data' => serialize($LOG)
    );
    $db->insert('log_report', $data);
    $tem = template_clean_up_tags($tem, "##IF_SAVE##", 1);



//pošiljanje pošte na računovodstvo ob zaključku
    //pridobi ime prijavljenega uporabnika in spremeni sumnike v brez sumnikov
    $sql_temp = "SELECT first FROM persons where username='$identity'";
    $user_first = $db->fetchOne($sql_temp);
    $user_first_sumniki = $user_first;
    $user_first = str_sumniki($user_first);
    $user_first_low = str_lower($user_first);
    ///////
    //pridobi priimek prijavljenega uporabnika in spremeni sumnike v brez sumnikov
    $sql_temp = "SELECT last FROM persons where username='$identity'";
    $user_last = $db->fetchOne($sql_temp);
    $user_last_sumniki = $user_last;
    $user_last = str_sumniki($user_last);
    $user_last_low = str_lower($user_last);
    ///////////
    //pridobi ime enote in spremeni sumnike v brez sumnikov
    $sql_temp = "SELECT name FROM unit, persons where unit.persons_unit=persons.unit and persons.username='$identity'";
    $user_unit = $db->fetchOne($sql_temp);
    $user_unit = str_sumniki($user_unit);
    ///////////
    $message_sumnik = 'Mesečno poročilo evidence prisotnosti zaposlenih na: "' . $user_unit . '" je zaključeno http://192.168.50.2/intranet/view_user_month.php';
    $message = str_sumniki(message_sumnik);


    // $to     = 'uros.gabrovec@gmail.com';
    $to = 'janja.skrabelj@vdcsasa.si'; //'janja.skrabelj@vdcsasa.si'; //tega pa ne rabim vec--  . ', ';
    $subject = 'Porocilo ' . $mon . '/' . $year . " " . $user_unit;

    // message
    $message = '
            <html>  <p>Poročilo <b> </html>
                  ' . $user_unit . '<html></b> je zaključeno! </p></html>' . '<a href="http://192.168.50.2/intranet/view_user_month.php?mon=' . $mon . "&year=" . $year . "&selunit=" . $unit . '" class="text"><b>Poročilo za mesec ' . $mon . '/' . $year . '</b></a><br>
                    <br>
                    <br>' . $user_first . " " . $user_last;

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
    $headers .= 'From:' . $user_first . " " . $user_last . '<' . $user_first_low . "." . $user_last_low . '@vdcsasa.si>' . "\r\n" .
            'Reply-To: admin@vdcsasa.si' . "\r\n" .
            //  'X-Mailer: PHP/' . phpversion();
            $headers .= 'Cc:' . $user_first_low . "." . $user_last_low . '@vdcsasa.si' . "\r\n";
    $headers .= 'Cc: info@vdcsasa.si' . "\r\n";
    $headers .= 'Bcc: admin@vdcsasa.si' . "\r\n";

    mail($to, $subject, $message, $headers);


    /////////////////
    ///QUERY ZA PREVERJANJE, ČE SO ŽE VSI ODDALI in pošiljanje rezutata
    $sql_log = "SELECT  count(log_id) as blef
	   FROM  `log_report`
	   WHERE date like '" . $mon . $year . "%' order by log_id DESC";

    $get_blog = $db->fetchAll($sql_log);
    if (is_array($get_blog))
        foreach ($get_blog as $test) {

            if ($test[blef] >= $NUM_OF_REPORT) {
                //echo "zdej pa ošlji nekaj saj jih je:".$test[blef];
                //Pošiljanje potrdila, da so vsi oddali
                //    $to     = 'uros.gabrovec@gmail.com';
                $to = 'janja.skrabelj@vdcsasa.si'; //'janja.skrabelj@vdcsasa.si'; //tega pa ne rabim vec--  . ', ';
                $subject = 'Zakljucena porocila za  ' . $mon . '/' . $year . " ";

                // message
                $message = '
            <html>  <p>Poročila vseh enot za mesec ' . $mon . '/' . $year . ' so bila zaključena!</p></html>' . '<a href="http://192.168.50.2/intranet/view_user_month.php?mon=' . $mon . "&year=" . $year . '" class="text"><b>Poročila za mesec ' . $mon . '/' . $year . '</b></a><br>
                    <br>
                    <br>' . "admin@vdcsasa.si";

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
                $headers .= 'From: admin@vdcsasa.si' . "\r\n" .
                        'Reply-To: admin@vdcsasa.si' . "\r\n" .
                        //  'X-Mailer: PHP/' . phpversion();
                        $headers .= 'Cc: info@vdcsasa.si' . "\r\n";
                $headers .= 'Bcc: admin@vdcsasa.si' . "\r\n";

                mail($to, $subject, $message, $headers);
            }
        }

    /////////////

    $message.="Poročilo je bilo uspešno poslano";

//$message= substr($message_sumnik, 0, -49);
//header("location:log_accepted.php?message=".'$message');
//exit;	   exit;
    header("location:view_user_month.php");
    exit;
}






///if za prikrivanje gumba pošlji za vse ki imajo visjo role_id kot 81
if ($role_id < 81) {
    $tem = str_replace("##IF_ADMIN##", "", $tem);
    $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
} else {
    $tem = template_clean_up_tags($tem, "##IF_ADMIN##", 1);
    $tem = template_clean_up_tags($tem, "##IF_SAVE##", 1);
}



$tem = str_replace("##UNIT##", $unit, $tem);
$tem = str_replace("##SELF##", $REQUEST_URI, $tem);#SELF##", $REQUEST_URI, $tem);
$tem = str_replace("##MONTH##", " " . $mon . "/" . $year, $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");

echo $tem;
