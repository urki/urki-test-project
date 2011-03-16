<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 $to     = 'uros.gabrovec@gmail.com';
 $subject = 'Feedback Just TEST'.$mon.'/'.$year." ".$user_unit;

 // message
    $message = 'vxyvycxvxcy';

       // To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
//$headers .= 'From:'.$user_first." ".$user_last.'<'.$user_first_low.".".$user_last_low.'@vdcsasa.si>'. "\r\n" .
$headers .= 'From:'.'uros.gabrovec@gmail.com'.'<'.'uros.gabrovec@gmail.com>'. "\r\n" .

          'Reply-To: admin@vdcsasa.si' . "\r\n" .
       //  'X-Mailer: PHP/' . phpversion();
//$headers .= 'Cc:'.$user_first_low.".".$user_last_low.'@vdcsasa.si'. "\r\n";
$headers .= 'Cc: uros.gabrovec@gmail.com'. "\r\n";
$headers .= 'Bcc: admin@vdcsasa.si' . "\r\n";

mail($to,$subject, $message, $headers);


      /////////////////
?>
