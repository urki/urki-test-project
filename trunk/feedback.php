<?

//*$DO_NOT_REDIRECT="true";*/
require_once("inc/config.php");
check_role($ROLE_USER);
$tem = template_open("feedback.tpl");
$tem = template_add_head_foot($tem, head, foot);
$TITLE = "Va&#353a vpra&#353anja, pripombe...";

$name = $_REQUEST['name'];

if ($_REQUEST['add'] == "    Naprej    ") {

    //if ( $tip and $note) {
    //$sql = "SELECT timestamp FROM feedback where $tip=type_id and note = '$note'";
    //	$result = $db->fetchOne($sql);
    //	if (!$result) {
    //dejansko vnesemo
    $data = array(
        'type_id' => $tip, //name_drop sem zamenjal z user_id saj se avtomatsko...
        'note' => $note,
        'modified_by' => $person_id
    );



    //// SEND MAIL to admin
    //pridobi ime pošiljatelja
    $sql_temp = "SELECT first, last FROM persons where id_person='$person_id'";
    $name = $db->fetchOne($sql_temp);
    echo $note;
    ///////
    $to = 'admin@vdcsasa.si';
    $subject = '[Feedback]' . '[uporabnik:' . $name . ']';

    $mailmessage = '
            <html>  <p>Opis: <br> </html>
                 <html>' . $note . '</html><br>
                    <br>
                    <br>' . $name;





    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
    //$headers .= 'From:'.$user_first." ".$user_last.'<'.$user_first_low.".".$user_last_low.'@vdcsasa.si>'. "\r\n" .
    $headers .= 'From:' . 'intranet@vdcsasa.si' . '<' . 'intranet@vdcsasa.si>' . "\r\n" .
            'Reply-To: admin@vdcsasa.si' . "\r\n" .
            //  'X-Mailer: PHP/' . phpversion();
    //$headers .= 'Cc:'.$user_first_low.".".$user_last_low.'@vdcsasa.si'. "\r\n";
    $headers .= 'Cc: uros.gabrovec@gmail.com' . "\r\n";
    $headers .= 'Bcc: admin@vdcsasa.si' . "\r\n";

    mail($to, $subject, $mailmessage, $headers);







    $db->insert('feedback', $data);
    $message .= "Vnos je dodan";
    header("location:feedback_accepted.php");
    exit;
    //}
    //}else {
    //$message.= "Izpolni vsa polja!";
    //}
}





$tem = str_replace('##TITLE##', $TITLE, $tem);
$tem = str_replace('##USER##', $identity, $tem);
$tem = str_replace("##JOB_DROP##", $job_dropdown, $tem);
$tem = str_replace("##NAME_DROP##", $name_dropdown, $tem);
$tem = str_replace("##MESSAGE##", $message, $tem);
$tem = template_clean_up_tags($tem, "##");
echo $tem;
?>