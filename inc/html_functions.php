<?php

/////////////////////////////////////////////////////////////////////
//This is the file with html fucntions. Which are called from php`s//
//it makes input field, text area, hidden field, link, ordered link,//
//un-ordered link, radio button,dropdowns..                         //
/////////////////////////////////////////////////////////////////////
//for Slovenia get return today


function returnDate($num, $tipe) {
    $str;
    switch ($tipe) {
        case "month":
            $month_name = array("", "Januar", "Februar", "Marec", "April", "Maj", "Junij", "Julij", "Avgust", "September", "Oktober", "November", "December");
            $str = $month_name[floor($num)];
            break;
        case "day":
            $day_name = array("", "Ponedeljek", "Torek", "Sreda", "&#268etrtek", "Petek", "Sobota", "Nedelja");
            $str = $day_name[floor($num)];
            break;
    }

    return $str;
}

//function empty table - for IE
function empty_table($x) {
    if ($x == "") {
        $x = "&nbsp;";
    }

    return $x;
}

///ne kaze negativnih časov!!!!!!!!!!!
function formatTime($secs) {
    $times = array(3600, 60, 1);
    $time = '';
    $tmp = '';
    for ($i = 0; $i < 3; $i++) {
        $tmp = floor($secs / $times[$i]);
        if ($tmp < 1) {
            $tmp = '00';
        } elseif ($tmp < 10) {
            $tmp = '0' . $tmp;
        }
        $time .= $tmp;
        if ($i < 2) {
            $time .= ':';
        }
        $secs = $secs % $times[$i];
    }
    return $time;
}

//function to change seconds in hours and  minutes
function change_sec_hm($sec) {

    $h = intval($sec / 3600); //number without decimal - hours
    $x = $sec / 3600;  //number with decimal
    $m = round(($x - $h) * 60, 2);  //tu sem ga zaokrožil saj potrebujem samo čas natančen na minute torej 4,98 =5
    ////minutes
    if ($m < 10 and $m > -10) {
        $m = "0" . abs($m);
    }

    if ($m < -10) {
        $m = abs($m);
        ;
    }


    if ($sec < 0) {
        if ($h == 0) {
            $r = "-00" . ":" . $m;
        } else {
            $r = "" . $h . ":" . $m;
        }
    } else {
        if ($h == 0) {
            $r = "00" . ":" . $m;
        } else {
            $r = $h . ":" . $m;
        }
    }
    if ($sec == 0) {
        $r = "";
    }

    return $r;
}

//function where time difference is GMT coorect and  where 00:00 is not shown, time - is colored red
function filter_time($x, $t) {
    $y = gmstrftime('%H:%M', $x);

    switch ($t) {
        case 1: //for time in H:m
            $null = gmstrftime('%H:%M', "0");
            if ($y == $null) {
                $x = "";
            } elseif ($y < $null) {
                $x = gmstrftime('%H:%M', $x);
            }
            else
                $x=gmstrftime('%H:%M', $x);
            return $x;
            break;
        case 2: //for day
            echo "i equals 1";
            break;
        case 3:
            echo "i equals 2";
            break;
    }
}

////
//!makes a submit button $name is requred value value and style are optinal //
//@author Uroš Gabrovec (admin@acidbeta.net)
//@param  name, optional are value and css style
//@return html code for submit button
//@globs  none
function html_submit_button($name, $value, $style=FALSE) {

      if (!$style) {
        $style = "default";
    }

    
        
    $temp = '<input type="submit" name="'.$name.'" class="'. $style.'"';
    if ($value) {
        $temp.= ' value="' . $value . '"';
    }
   // if ($size) {
   //     $temp.= ' style="' . $style . '"';
   // }
    $temp.= '>';

    return $temp;
}



////
//!makes a text input field, only $name is requred value, size and style are optinal //
//@author Samo Gabrovec (root@velenje.cx)
//@param  name, optional are value, size and style
//@return html code for input type text
//@globs  none
function html_input_text($name, $value, $size, $style, $readonly=FALSE) {


    $temp = '<input '.$readonly.' type="text" name="' . $name . '"';
    if ($value) {
        $temp.= ' value="' . $value . '"';
    }
    if ($size) {
        $temp.= ' size="' . $size . '"';
    }    
    if ($style) {
        $temp.= ' class="' . $style . '"';
    }
    $temp.= '>';

    return $temp;
}

////
//!text area makes you an input text area filed
//@author Samo Gabrovec (root@velenje.cx)
//@param  name of form, optional are value row and cols  
//@return html code for texarea
//@globs   none
function html_text_area($name, $value, $row, $cols, $style, $readonly=FALSE) {
    if ($row == "") {
        $row = "8";
    }
    if ($cols == "") {
        $cols = "60";
    }
    if ($style) {
        $temp.= ' class="' . $style . '"';
    }
    $temp = '<textarea  wrap="on" rows="' . $row . '" cols="' . $cols . '" name="' . $name . '">';
    $temp.=$value . '</textarea>';

    return $temp;
}

////
//!makes an hidden field in  form
//@author Samo Gabrovec (root@velenje.cx)
//@param name and value
//@return html code for form hidden field 
//@globs  none
function html_hidden($name, $value) {

    $temp = '<input type="hidden" name="' . $name . '" value="' . $value . '">';

    return $temp;
}

////
//!makes an html link
//@author Samo Gabrovec (root@velenje.cx)
//@param link pointer, name 
//@return html code for link  
//@globs  none
function html_link($url, $name) {

    $temp = '<a href="' . $url . '">' . $name . '</a>';

    return $temp;
}

////
//!makes un-ordered list with link 
//@author Samo Gabrovec (root@velenje.cx)
//@param  link pointer and name
//@return  html code for the row part of ordered list or un-ordered list with link 
//@globs  none
function html_li_url($url, $name) {
    $temp = '<li><a href="' . $url . '">' . $name . '</a></li>';
    return $temp;
}

//  dooh sej je vedno <li> sam zgori se spremeni <ol> oz <ul> poglej ce to cudo kdo uporablja in zbrisi :)
// maker ordered list with link //
function html_ol_url($url, $name) {
    $temp = '<ol><a href="' . $url . '">' . $name . '</a></ol>';
    return $temp;
}

////
//!makes an radio button//
//@author Samo Gabrovec (root@velenje.cx)
//@param  name, value, and otptional check which can be y for checked  
//@return html code for radio button
//@globs   none
function html_radio_button($name, $value, $check) {

    if ($check == "y") {
        $check = "checked";
    } else {
        $check = "";
    }
    $temp = '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $check . '>';


    return $temp;
}

////
//!makes an check box
//@author Samo Gabrovec (root@velenje.cx)
//@param name value and an optional check which if set to "y" is checked   
//@return  html code for check box
//@globs   none
function html_check_box($name, $value, $check) {

    if ($check == "y") {
        $check = "checked";
    } else {
        $check = "";
    }
    $temp = '<input type="checkbox" name="' . $name . '" value="' . $value . '" ' . $check . '>';


    return $temp;
}

////
//!makes drop_down with numbers in it. You just need to suply lowest number and the high one..
// and of course the name of the dropdown [ you can suply which one is selected too ]
//@author Samo Gabrovec (root@velenje.cx)
//@param  name of dropdown,start from number,end number and selected value   
//@return  html code for drop_down
//@globs   none
function html_drop_down_number($name, $low, $high, $selected) {
    if (!$low or !$high) {
        $out = "Error!!";
        return $out;
    }
    if ($low >= $high) {
        $out = "Wrong usage!";
        return $out;
    }
    $out = "<select name=\"$name\">";
    while ($low <= $high) {
        if ($low == $selected and $low != "") {
            $out.="<option selected  value=$low>$low</option>";
            $low++;
        } else {
            $out.="<option value=$low>$low</option>";
            $low++;
        }
    }
    $out.="</select>";
    return $out;
}

////
//!accepts two arrays names and values for data you can also suply the selected value and of couser name//
//@author Samo Gabrovec (root@velenje.cx)
//@param  dropdown name,names [array], values[array], selected[ optional], style[ optional ]
//@return html code for dropdown
//@globs   none



function html_drop_down_arrays($drop_name, $names, $values, $selected, $style = FALSE) {
    if (!$style) {
        $style = "default";
    }
    $a = count($names);
    $b = count($values);
    if ($a != $b) {
        $out = "Wrong usage!";
        return $out;
    }

    $out = '<select class="' . $style . '" name=' . $drop_name . '>';
    for ($x = 0; $x < $a; $x++) {
        if (trim($names[$x]) == "") {
            continue;
        }
        if ($values[$x] == $selected) {

            $out.='<option selected value="' . $values[$x] . '">' . $names[$x] . '</option>';
        } else {
            $out.='<option value="' . $values[$x] . '">' . $names[$x] . '</option>';
        }
    }
    $out.="</select>";
    return $out;
}

////
//!same as above just returns the multiple choices AND accepts $selected as array!!!! [since multiple can be selected right?]//
//@author Samo Gabrovec (root@velenje.cx)
//@param  dropdown multiple name, names[array],values[array],and optional selected value
//@return html code for dropdown multiple
//@globs   none
function html_drop_down_arrays_multiple($drop_name, $names, $values, $selected, $size=FALSE, $style=false) {
    $a = count($names);
    $b = count($values);
    $c = count($selected);
    if ($a != $b) {
        $out = "Wrong usage!";
        return $out;
    }
    if (!$size){
        $out = "<select name=\"" . $drop_name . "[]\" multiple size=\"5\"";}
    if ($size){
        $out = "<select name=\"" . $drop_name . "[]\" multiple size=\"" . $size . "\"";}
     if ($style)
        $out.='style="'.$style.'"';
    $out.=">";
    for ($x = 0; $x < $a; $x++) {
        unset($SEL);
        for ($y = 0; $y < $c; $y++) {

            if ($values[$x] == $selected[$y]) {
                $out.="<option selected value=\"" . $values[$x] . "\">" . $names[$x] . "\"</option>";
                $SEL = true;
            }
        }
        if (!$SEL) {
            $out.="<option value=\"" . $values[$x] . "\">" . $names[$x] . "</option>";
        }
    }


    $out.="</select>";
    return $out;
}

function page_navigator($nrecs, $url, $TEMPLATE = FALSE) {
    global $page, $start_page, $act, $rec_no, $all_pages, $REC_ON_PAGE, $MAX_PAGES, $PAGE_NAVIG, $GENERATING, $DESC;
    $TEMPLATE = $PAGE_NAVIG;
    $tem = template_open($TEMPLATE);
    $tem = str_replace("##URL##", $url, $tem);
    if ($nrecs == 0) {
        $rec_no = 0;
        return;
    }

    if ($GENERATING) {
        if (preg_match("/##GENERATING##(.*)##GENERATING##/Us", $tem, $ar))
            $tem = $ar[1];
    } else {
        $tem = preg_replace("/##GENERATING##.*##GENERATING##/Us", "", $tem);
    }

    ///$DESC se prenasa cez global in pomeni da izpise v napacnem vrstnem redu page navig torej od zadi naprej stevilke//
    $all_pages = Ceil($nrecs / $REC_ON_PAGE);
    if ($DESC) {
        if (!$page)
            $page = $all_pages;
    } else {
        if (!$page)
            $page = 1;
    }
    if (!$start_page)
        $start_page = max($page - floor($MAX_PAGES / 2), 1);
    if ($page < $start_page)
        $start_page = max($page - floor($MAX_PAGES / 2), 1);
    if ($DESC) {
        if ($page > $start_page + $MAX_PAGES)
            $start_page = max($page - floor($MAX_PAGES / 2), 1);;
    } else {
        if ($page >= $start_page + $MAX_PAGES)
            $start_page = max($page - floor($MAX_PAGES / 2), 1);;
    }
    if ($all_pages == 1) {
        $rec_no = 0;
        return;
    }
    if ($DESC) {
        //potem mora delat obratno//
        if ($act == "back") {
            $start_page++;
            $page++;
        }
        if ($act == "next") {
            $start_page--;
            $page--;
        }
    } else {
        if ($act == "back") {
            $start_page--;
            $page--;
        }
        if ($act == "next") {
            $start_page++;
            $page++;
        }
    }
    if ($start_page > $all_pages - $MAX_PAGES + 1)
        $start_page = $all_pages - $MAX_PAGES + 1;
    if ($start_page < 1)
        $start_page = 1;
    if ($DESC) {
        $rec_no = (($all_pages) - $page) * $REC_ON_PAGE;
    } else {
        $rec_no = ($page - 1) * $REC_ON_PAGE;
    }
    $t = template_get_repeat_text3("BACK", "##BACK##", $tem);
    if ($start_page > 1) {
        $tem = str_replace("##BACK##", $t[1], $t[0]);
    } else {
        $tem = str_replace("##BACK##", $t[2], $t[0]);
    }

    $t = template_get_repeat_text3("NEXT", "##NEXT##", $tem);
    if ($start_page <= $all_pages - $MAX_PAGES) {
        $tem = str_replace("##NEXT##", $t[1], $t[0]);
    } else {
        $tem = str_replace("##NEXT##", $t[2], $t[0]);
    }

    $t = template_get_repeat_text3("FIRST", "##FIRST##", $tem);
    if ($page == 1) {
        $tem = str_replace("##FIRST##", $t[1], $t[0]);
    } else {
        $tem = str_replace("##FIRST##", $t[2], $t[0]);
    }

    $t = template_get_repeat_text3("LAST", "##LAST##", $tem);
    if ($page == $all_pages) {
        $tem = str_replace("##LAST##", $t[1], $t[0]);
    } else {
        $tem = str_replace("##LAST##", $t[2], $t[0]);
    }

    $t = template_get_repeat_text3("ONE_PAGE", "##ONE_PAGE##", $tem);
    if ($all_pages == 1) {
        $tem = str_replace("##ONE_PAGE##", $t[1], $t[0]);
    } else {
        $tem = str_replace("##ONE_PAGE##", $t[2], $t[0]);
    }

    $t = template_get_repeat_text3("NUMPAGES", "##NUMPAGES##", $tem);
    $out = "";
    $desc = $all_pages - 1;
    for ($p = 0; ($p < $MAX_PAGES) && ($p < $all_pages); $p++) {
        if ($DESC) {
            //potem odsetevam page-e 10,9,8...prenese se kot global///
            if ($desc + $start_page == $page) {
                $out .= str_replace("##PAGE_NO##", $desc + $start_page, $t[1]);
            } else {
                $out .= str_replace("##PAGE_NO##", $desc + $start_page, $t[2]);
            }
            $desc--;
        } else {

            if ($p + $start_page == $page) {
                $out .= str_replace("##PAGE_NO##", $p + $start_page, $t[1]);
            } else {
                $out .= str_replace("##PAGE_NO##", $p + $start_page, $t[2]);
            }
        }
    }


    $tem = str_replace("##NUMPAGES##", $out, $t[0]);
    $tem = str_replace("##URL-1##", str_replace("##PAGE_NO##", max($page - 1, 1), $url), $tem);
    $tem = str_replace("##URL+1##", str_replace("##PAGE_NO##", min($page + 1, $all_pages), $url), $tem);
    $tem = str_replace("##URL-FIRST##", str_replace("##PAGE_NO##", 1, $url), $tem);
    $tem = str_replace("##URL-LAST##", str_replace("##PAGE_NO##", $all_pages, $url), $tem);

    $tem = str_replace("##PAGE_NO##", $page, $tem);
    $tem = str_replace("##START_PAGE##", $start_page, $tem);
    $tem = str_replace("##ALL_PAGES##", $all_pages, $tem);

    return($tem);
}
