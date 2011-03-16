<?

require_once("inc/config.php");


check_role($ROLE_USER);


$TITLE = "Editiranje";
$tem = template_open("scan_last_insert.tpl");
$tem = template_add_head_foot($tem, head, foot);


echo "scan zadnjega";
echo $did;
$edit = $_REQUEST['edit'];


if ($_REQUEST['edit'] == "edit") {

              for($i=0;$i<$count;$i++){
              $data = array('person_assessor' => $did[$i]);
              $db->insert('LogInventory', $data);
             }
    
   /*
    //dejansko vnesemo
    $data = array(
        'person_assessor' => $did


    );
    $db->insert('LogInventory', $data);
*/
    //$message .= "Vnos je dodan";
    header("location:" ."scan_inventory.php");

    exit;
    }





$tem = str_replace("##TEST##", $unit, $tem);
$tem = str_replace("##EAN##", $myname, $tem);
$tem = str_replace('##MESSAGE##', $message, $tem);
$tem = str_replace('##USER##', $identity, $tem);


$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = template_clean_up_tags($tem, '##');
echo $tem;
?>
