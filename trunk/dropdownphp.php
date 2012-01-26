<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
///// collecting form data /////

@$color= $_POST['color'];
if( is_array($color)){
while (list ($key, $val) = each ($color)) {
echo "$val <br>";
}
}//else{echo "not array";}

