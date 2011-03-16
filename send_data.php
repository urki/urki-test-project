<?
require_once("inc/config.php");


//check_role($ROLE_USER);
$TITLE = "Aktivnosti";


//nid   90230
//pause_hour_time_drop  0
//pause_min_time_drop   0
//rating_drop   3
//stopactivitytekst


$stop_time = time ();
$pht=$pause_hour_time_drop;
$pmt.=$pause_min_time_drop;

$pause_time = $pht * 3600 + $pmt * 60;

//dejansko vnesemo
$sql = 'UPDATE work_log SET pause="'.$pause_time.'", end="' . $stop_time . '", comm="' . $stopactivitytekst . '" where id =' . $nid . '';

if ($db->query($sql))
        echo "OK";
else
        echo "ERROR";

exit;

?>
