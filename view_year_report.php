<?php

require_once("inc/config.php");

check_role($ROLE_LEADER);

$TITLE = "Letno poročilo";

$tem = template_open("view_year_report.tpl");
$tem = template_add_head_foot($tem, head, foot);


$tmp = template_get_repeat_text("##START_TABLE##", "##STOP_TABLE##", "##TABLE_LOGS##", $tem);

$table_row = $tmp[1];
//echo 'row='.$row." <hr> ";
$tem = $tmp[0];


$tmp = template_get_repeat_text("##START_LOG##", "##STOP_LOG##", "##LOGS##", $tem);
//echo 'tmp='.$tmp." <hr> ";


$row = $tmp[1];
//echo 'row='.$row." <hr> ";


$tem = $tmp[0];

//echo 'tem='.$tem." <hr> ";




//spremenljivki za mesec ine leto//
if ($mon < 1 or $mon > 12)
    $mon = '';

if (!$mon)
    $mon = date("m", time());

if (!$year)
    $year = date("Y", time());







// instanciate a new DAL




$unitarray = array(75, 77, 78);
$disorderarray = array(1, 2, 3, 4, 5);


//$age_max = 106;

$age_min_array = array(18, 26, 36, 46, 56);
$age_max_array = array(25, 35, 45, 55, 200);

//Report for age and disorder by units
foreach ($unitarray as $unit_in) {

    $table.=$row;
    $enota = $dal->get_unit_by_persons_unit($unit_in);
    $enota = $enota[0];
    $table = str_replace("##UNIT##", "<b>".$enota["name"]."</b>", $table);
//    echo "<hr><b><h3>" . $enota["name"] . "</h3></b><hr>";
    $i = 0;

   
    foreach ($age_min_array as $age_min)
   // for ($z=0;$z<7;$z++)
    {
      $tableIn.=$table_row;
        // $age_max = $age_min_array[$i];
        $age_max = $age_max_array[$i];
        $tableIn = str_replace("##AGEMIN##", $age_min, $tableIn);
       // echo "<hr><b>" . $age_min . "</b>";
        if ($age_max < 56) {
            $tableIn = str_replace("##AGEMMAX##", ' in ' . $age_max, $tableIn);
          //  echo "<b> in " . $age_max . "   ->  </b>";
        } else {
            $tableIn = str_replace("##AGEMMAX##", ' in več', $tableIn);
          //  echo "<b> in več  -></b>";
        }
        $i++;
        $x = 1;
        foreach ($disorderarray as $disorder_id) {
            $disorders = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, $disorder_id);
            $disorders = $disorders[0];
            $tableIn = str_replace("##DISORDER" . $x . "##", $disorders["sestevek"], $tableIn);
           // echo $disorders["sestevek"] . "     | ";
            $x++;
        }
       
    }
   $table=str_replace("##TABLE_LOGS##", $tableIn, $table);
   $tableIn="";
}


$tem = str_replace("##LOGS_SUB##", $table, $tem);
//$tem = str_replace("##MONTH##", " " . $mon . "/" . $year, $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);

$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");

echo $tem;
?>


