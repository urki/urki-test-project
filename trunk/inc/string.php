<?php
function str_sumniki($text) {
	$text = str_replace("&#269","c",$text);
	$text = str_replace("&#158","z",$text);
	$text = str_replace("&#353","s",$text);

      //(make iso-8859-2 v brez sumnika)
        $text = str_replace("Ä","c",$text);
        $text = str_replace("Å¾","z",$text);
        $text = str_replace("iÅ¡","s",$text);


	//$text = str_replace("&#353","C",$text);
	//$text = str_replace("&#353","Z",$text);


        $text = str_replace("&#352","S",$text);
        $text = str_replace("&#381","Z",$text);
        $text = str_replace("&#382","z",$text);
        //(Velike iso-8859-2 v brez sumnika)
          // $text = str_replace("&#352","S",$text);
          //$text = str_replace("&#381","Z",$text);
          //$text = str_replace("&#382","z",$text);

	return $text;
}


function str_lower($text) {
	$text = strtolower($text);
	return $text;
}


function toUpper($string) {
    return (strtoupper(strtr($string, 'ščžćđ','ŠČŽĆĐ' )));
    };

function toLower($string) {
    return (strtolower(strtr($string,'ŠČŽĆĐ', 'ščžćđ' )));
    };
