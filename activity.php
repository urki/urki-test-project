<?

require_once("inc/config.php");


check_role($ROLE_USER);
$TITLE = "Aktivnosti";



$tem = template_open("activitySelect.tpl") .
        $tem = template_open("activity_start.tpl") .
        $tem = template_open("activity_stop.tpl");

$tem = template_add_head_foot($tem, head, foot);





//dropdown ocene
$qrating = range(1, 5);


//dropdown pause hour
$qpause_hour_time = range(0, 23);

//dropdown pause minutes
$qpause_min_time = range(0, 59);


//multi drop down
//$sql = "SELECT * FROM persons  where id_role<11  and unit<>0 order by unit, letter ASC";
$sql = "select * from persons
where
id_person not in 
(
SELECT person_id
FROM  work_log 
WHERE 
      end=0 and
      start=0
)
and id_role<11
and unit<>0
order by unit, letter ASC
";


$result = $db->fetchAll($sql);
foreach ($result as $res) {

    $names[] .= $res["last"] . " " . $res["first"];
    $values[] .= $res["id_person"];
}
///////////
$multiname_dropdown = html_drop_down_arrays_multiple(multiname_drop, $names, $values, $selected, $size = FALSE, $style = true);
$countMultiName = count($multiname_drop);
//
//
//activity drop down
$sql = "SELECT * FROM `work` WHERE `group`<'11'";
$result = $db->fetchAll($sql);
foreach ($result as $res) {
    if (!is_array($ActivityName)) {
        $ActivityName[] = "izberi aktivnost...";
        $ActivityValue[] = "";
    }

    $ActivityName[] .= $res["applic"] . " --> " . $res["name"];
    $ActivityValue[] .= $res["work_id"];
}
///////////
$activity_dropdown = html_drop_down_arrays(activity_drop, $ActivityName, $ActivityValue, $ActivityName);



$activity1 = $_REQUEST['add'];


if ($_REQUEST['add'] == "    Vstavi    ") {


    //Če je administrator se štejejo tudi dnevi in se lahko izbere tudi ocenjevalec
    If ($role_id > 80) {
        $start_time = mktime($hour_start_time_drop, $min_start_time_drop, 0, $month_drop, $day_drop, $year_drop);
        $stop_time = mktime($hour_stop_time_drop, $min_stop_time_drop, 0, $month_drop, $day_drop, $year_drop);
        $pause_time = $pause_hour_time_drop * 3600 + $pause_min_time_drop * 60;
    }
    //če pa je "samo" vodja pa ne more vpisovati dni in ocenjevalca
    else {
        $ass_name_drop = $person_id;
    }

    for ($i = 0; $i < $countMultiName; $i++) {
        //dejansko vnesemo
        $data = array(
            'person_id' => $multiname_drop[$i],
            'work_id' => $activity_drop,
            'assessor_id' => $person_id, // $ass_name_drop, //$user_id,
            'testing' => $identity
        );

        $db->insert('work_log', $data);
    }
    //$message .= "Vnos je dodan";
    header("location:" . $_SERVER['HTTP_REFERER']);

    exit;
}


///////////////Konec pregle x vpisov
//Activity START
//
//
///////////Izpis vnešenih za vnos začetka ur



if ($_REQUEST['edit'] == "Začni") {
    $start_time = time ();



    $dsql = "SELECT * FROM `work_log` WHERE `assessor_id`=" . $person_id . "  and start=0";
$dresult = $db->fetchAll($dsql);

$count = 0;
foreach ($dresult as $dres) {
    $count++;}


    //dejansko vnesemo
    for ($i = 0; $i < $count; $i++) {

        if ($activity_drop[$i] <> 0) {


            $testiranje = "select *
                          from  persons right join (SELECT * FROM work_log
                                                    WHERE person_id=" . $name_drop[$i] . "
                                                    AND
                                                     ((END =0
                                                     AND START <>0)
                                                    OR (unix_timestamp( now( ) ) < END 
                                                    AND START < unix_timestamp( now( ) )))
                                                    )checked on person_id=id_person";


            $testresult = $db->fetchAll($testiranje);

            if (!$testresult) {
                $db->query('UPDATE work_log SET  work_id="' . $activity_drop[$i] . '", person_id="' . $name_drop[$i] . '", start="' . $start_time . '" , comm="' . $ddescription[$i] . '" where id = (' . $did[$i] . ')' . '');
                // header("location:" . $_SERVER['HTTP_REFERER']);
                //  header("Refresh: 3; location:"."http://localhost/intranetDevelop/activity.php");
                //header("location:" . $_SERVER['HTTP_REFERER']);
            }
            else
                foreach ($testresult as $testres) {
                    $check_id = $testres["id"];
                    $kdoid[].=$testres[last] . " " . $testres[first];
                    $izpis = $kdoid[$i] . " ";
                    {
                        $messagetype = "error";
                        $message .= " " . $izpis . " ŽE opravlja aktivnost (zapis:" . $check_id . ")<br />";
                    }
                }
        } else {
            $messagetype = "error";
            $message .= " Zapis: " . $did[$i] . "  nima izbrane aktivnosti!<br />";
        }

        //exit;
        /* }
          else {
          $check_id = $testresult[0]["id"];
          $check_name = $testresult[person_id];
          print_r($check_name);
          $messagetype = "error";
          $message .= "Vnos se prekriva z  vnosom številka ".$check_id." in osebe:".$check_name." so že v delu!";

         */
    }
}

$tmp = template_get_repeat_text("##DSTART_LOG##", "##DSTOP_LOG##", "##DLOGS##", $tem);
$row = $tmp[1];
$tem = $tmp[0];

$dsql = "SELECT * FROM `work_log` WHERE `assessor_id`=" . $person_id . "  and start=0";
$dresult = $db->fetchAll($dsql);


$dnamesql = "SELECT * FROM `persons` WHERE unit<>0 and id_role<11";
$dnameresult = $db->fetchAll($dnamesql);
foreach ($dnameresult as $dres) {

    $dnames[] .= $dres["last"] . " " . $dres["first"];
    $dvalues[] .= $dres["id_person"];
}

//if(!$dresult) echo "No results were given for the following SQL statement<p>".$dsql."</p>";
if ($dresult) {
    $sss = html_submit_button('edit', 'Začni', 'btn');
    $tem = str_replace("##BUTTON##", $sss, $tem);
};




$count = 0;
foreach ($dresult as $dres) {
    $count++;
    $table = $row;
    $table = str_replace("##DID##", $dres["id"], $table);
    $name_dropdown = html_drop_down_arrays("name_drop[]", $dnames, $dvalues, $dres["person_id"], "dropdown_green");
    $activity_start_dropdown = html_drop_down_arrays("activity_drop[]", $ActivityName, $ActivityValue, $dres["work_id"], "dropdown_green");
    $table = str_replace("##NAMEDROP##", $name_dropdown, $table);
    $table = str_replace("##ACTIVITYSTART##", $activity_start_dropdown, $table);
    $table = str_replace("##DDESCRIPTION##", $dres["descr"], $table);
    $dwhole_table.=$table;
}

$tem = str_replace("##DLOGS##", $dwhole_table, $tem);
$tem = str_replace("##DMESSAGE##", $message, $tem);


//
//ACTIVITY STOP
//
//
//
//
///////////Izpis pe ne končanih vpisov
$tmp = template_get_repeat_text("##NSTART_LOG##", "##NSTOP_LOG##", "##NLOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];


$nsql = "SELECT work_log.id, persons.first, persons.last, time_format(from_unixtime(work_log.start),'%H:%i') as begin, work.name as wname, applic.name as aname, work_log.comm
FROM persons right join
                   (`work_log`  left join
                (work
               LEFT JOIN applic on applic.applic_id=work.applic_id) on work_log.work_id=work.work_id)ON persons.id_person=work_log.person_id
 WHERE start<>0 and end=0 and assessor_id=" . $person_id . " order by letter";

$nresult = $db->fetchAll($nsql);
$count = 0;





foreach ($nresult as $nres) {
    $count++;
    $table = $row;
    $table = str_replace("##EDITFORMNAME##", "editform" . $count, $table);
    $table = str_replace("##NID##", $nres["id"], $table);
    $qpause_hour_time_dropdown = html_drop_down_arrays("pause_hour_time_drop", $qpause_hour_time, $qpause_hour_time, $pause_hour_time_drop); //date("H",time()));
    $qpause_min_time_dropdown = html_drop_down_arrays("pause_min_time_drop", $qpause_min_time, $qpause_min_time, $pause_min_time_drop); //date("H",time()));
    $table = str_replace("##PAUSEHOUR##", $qpause_hour_time_dropdown, $table);
    $table = str_replace("##PAUSEMINUTES##", $qpause_min_time_dropdown, $table);
    $qrating_dropdown = html_drop_down_arrays("rating_drop", $qrating, $qrating, "3"); //date("H",time()));
    $table = str_replace("##RATING##", $qrating_dropdown, $table);
    $table = str_replace("##NSTART##", $nres["begin"], $table);
    $table = str_replace("##ACTIVITYSTOP##", (substr($nres[aname], 0, 8) . "...   " . $nres[wname]), $table);
    $table = str_replace("##NAMEDROPSTOP##", (toUpper($nres['last']) . " " . $nres['first']), $table);
    $table = str_replace("##DDESCRIPTION##", $nres["comm"], $table);
    $table = str_replace("##FORM_NUM##", $count, $table); // za Javascript hide
    $nwhole_table.=$table;

    // $pausintest.=print_r( $pause_hour_time_drop[$i]);
}
$tem = str_replace("##NLOGS##", $nwhole_table, $tem);
$tem = str_replace("##NMESSAGE##", $message, $tem);




for ($i = 1; $i < $count + 1; $i++) {

    if ($_REQUEST['editform' . $i] == "Končaj") {
        $stop_time = time ();
        $pht = $pause_hour_time_drop[0];
        $pmt.=$pause_min_time_drop[0];
        $pause_time = $pht * 3600 + $pmt * 60;
        //dejansko vnesemo
        $db->query('UPDATE work_log SET pause="' . $pause_time . '", end="' . $stop_time . '", comm="' . $stopactivitytekst . '" where id =' . $nid . '');
       // header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
}








///////////////Konec vpisov
$tem = str_replace('##MESSAGETYPE##', $messagetype, $tem);
$tem = str_replace("##ACTIVITY##", $activity_dropdown, $tem);
$tem = str_replace("##MULTINAME##", $multiname_dropdown, $tem);
$tem = str_replace("##LOGS##", $whole_table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
///////////////Konec Izpis vpisov trenutnega dne urejenih po abecedi
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##EAN##', $ean_dropdown, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
