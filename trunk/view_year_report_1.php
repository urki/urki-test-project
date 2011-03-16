<?php

require_once("inc/config.php");

check_role($ROLE_LEADER);

$TITLE = "Letno poročilo";

$tem = template_open("view_year_report.tpl");
$tem = template_add_head_foot($tem, head, foot);

$tmp = template_get_repeat_text("##START_LOG##", "##STOP_LOG##", "##LOGS##", $tem);

$row = $tmp[1];
$tem = $tmp[0];

//spremenljivki za mesec ine leto//
if ($mon < 1 or $mon > 12)
    $mon = '';

if (!$mon)
    $mon = date("m", time());

if (!$year)
    $year = date("Y", time());





// instanciate a new DAL
$dal = new DAL();



//enota
$age_min_array = array(18,25,35,45);
$age_max_array = array(26,36,46,56);
$age_array=array($age_min_array,$age_max_array);
echo "age_array=";

 echo '$age_array[0][0]'.$age_array[0][0].'<br />';
echo '$age_array[0][1]'.$age_array[0][1].'<br />';
echo '$age_array[1][0]'.$age_array[1][0].'<br />';
echo '$age_array[1][1]'.$age_array[1][1].'<br />';

 $enota = $dal->get_unit_by_persons_unit($unit_in);
    $enota = $enota[0];
    $table = str_replace("##UNIT##", $enota->name, $table);
$age_group1=array(18,25);
$age_group2=array(26,35);


$age_min = 18;
$age_max = 36;
$unitarray = array(75, 77, 78);
$disorderarray = array(1, 2, 3, 4, 5);


$unit_in=78;
$enota = $dal->get_unit_by_persons_unit($unit_in);
    $enota = $enota[0];
    $table = str_replace("##UNIT##", $enota->name, $table);

$array1=array(array($unit_in, 0, 11, $age_min, $age_max, 1));


echo "fdfsf";

//foreach ($array1 as $array)
{
    $table.=$row;

    
    
       $cat1 = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, 1);
     //  $cat1 = $dal->get_count_dissorder_age_persons_by_unit($array);
       $cat1=$cat1[0];
       $table = str_replace("##DISORDER##", $cat1->sestevek, $table);

    
     /*  
       $cat1 = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, 1);
       $cat1=$cat1[0];
       $table = str_replace("##DISORDER##", $cat1->sestevek, $table);

     $cat2 = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, 2);
       $cat2=$cat2[0];
       $table = str_replace("##DISORDER2##", $cat2->sestevek, $table);

        $cat3 = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, 3);
       $cat3=$cat3[0];
       $table = str_replace("##DISORDER3##", $cat3->sestevek, $table);

        $cat4 = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, 4);
       $cat4=$cat4[0];
       $table = str_replace("##DISORDER4##", $cat4->sestevek, $table);
     
        $cat5 = $dal->get_count_dissorder_age_persons_by_unit($unit_in, 0, 11, $age_min, $age_max, 5);
       $cat5=$cat5[0];
       $table = str_replace("##DISORDER5##", $cat5->sestevek, $table);
*/
}



$tem = str_replace("##MONTH##", " " . $mon . "/" . $year, $tem); //v header sem dal zraven naslova izpis meseca za katerega je izpis
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace("##LOGS##", $table, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");

echo $tem;
?>


