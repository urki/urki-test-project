<?php
$s="čšžčk";

 header("Content-type: text/html; charset=utf-8");?>
<html>
 <head>
  <meta http-equiv="Content-type" value="text/html; charset=utf-8">
 </head>
</html>
<?php

/*
//$s is a string from whatever source
mb_detect_encoding($s, "UTF-8") == "UTF-8" ? : $s = utf8_encode($s);
*/
echo $s;
 
?>
