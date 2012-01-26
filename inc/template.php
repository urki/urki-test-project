<?php
//!it openes template nad returns it as string
//you need to suply the filename [template dir is prefixed]
//@author Samo Gabrovec (root@velenje.cx)
//@param filename [only filename template dir is added!]  if you suply the $path then the full path is used 
//@return text [content of the file] 
//@globs  $TEMPLATE_DIR
function template_open($filename) {
	global $TEMPLATE_DIR;

	//echo $TEMPLATE_DIR.$filename."<br>";
	$f= @fopen($TEMPLATE_DIR.$filename,"r");
	if (!$f) {
		return false;
	}
	$template= fread($f,filesize($TEMPLATE_DIR.$filename));
	fclose($f);
	return $template;

}
/*function template_add_head_foot($temp) {
	$head=template_open("head.tpl");
	$foot=template_open("foot.tpl");
	return $head."\n\n".'<!-- end head -->'.$temp."\n\n".'<!-- end main template -->'."\n\n".' <!-- start foot -->'."\n\n".$foot;

	}*/

	/*function template_add_head_adminfoot($temp) {
		$head=template_open("head.tpl");
		$foot=template_open("AdminFoot.tpl");
		return $head."\n\n".'<!-- end head -->'.$temp."\n\n".'<!-- end main template -->'."\n\n".' <!-- start foot -->'."\n\n".$foot;
		}*/
		//add footer and header. you just add name of template without .tpl 
		function template_add_head_foot($temp,$header,$footer) {
			global $role_id;
			global $ROLE_ADMIN,$ROLE_LEADER,$ROLE_EMPLOYED,$ROLE_ZALEC,$unit;
			
			$header=$header.".tpl";
			$footer=$footer.".tpl";
			$head=template_open($header);
			$foot=template_open($footer);
					
			  {	
			
			
			if ($role_id) {
				switch ($role_id) {
					case ($role_id >= $ROLE_ADMIN):
					$foot = str_replace("##IF_ADMIN##","",$foot);
					$foot = str_replace("##IF_LEADER##","",$foot);
					break;
					case ($role_id <= $ROLE_ADMIN and $role_id >= $ROLE_LEADER):
					$foot =  template_clean_up_tags($foot,"##IF_ADMIN##",1);
					break;
					
					case ($role_id <= $ROLE_LEADER and $role_id >= $ROLE_EMPLOYED):
					$foot =  template_clean_up_tags($foot,"##IF_ADMIN##",1);
					$foot =  template_clean_up_tags($foot,"##IF_LEADER##",1);
					break;
						
					default:
					$foot =  template_clean_up_tags($foot,"##IF_ADMIN##",1);
					$foot =  template_clean_up_tags($foot,"##IF_LEADER##",1);
					$foot =  template_clean_up_tags($foot,"##IF_EMPLOYED##",1);
				//	$foot =  template_clean_up_tags($foot,"##IF_ZALEC##",1);
				}
				
			} else  {
				$foot =  template_clean_up_tags($foot,"##IF_ZALEC##",1);
				$head =  template_clean_up_tags($head,"##IF_USER##",1);
				$foot =  template_clean_up_tags($foot,"##IF_ADMIN##",1);
				$foot =  template_clean_up_tags($foot,"##IF_LEADER##",1);
				$foot =  template_clean_up_tags($foot,"##IF_EMPLOYED##",1);
			}
			}
	        //pogoj za zacasno blokado-vizualno zalcu
			if ($unit== $ROLE_ZALEC) {
					$foot =  template_clean_up_tags($foot,"##IF_ZALEC##",1);}
			/////////////////
			
			return $head."\n\n".'<!-- end head -->'.$temp."\n\n".'<!-- end main template -->'."\n\n".' <!-- start foot -->'."\n\n".$foot;
		}


		////
		//!this one returns what`s in the middle of the $first and $sec word and replaces what was in the middle with $change in $template
		//very good for repeating html segments from a template
		//@author Samo Gabrovec (root@velenje.cx)
		//@param first_part[##start##],second_part[##stop##],change[##table##], template [text]
		//@return array [0=template 1=the middle part]
		//@globs  none
		function template_get_repeat_text($first,$sec,$change,$template) {
			if (!$template or !$first or !$sec) {
				return false;
			}
			if (!strstr($template,$first)) {
				$out[0] = $template;
				$out[1] = "";
				return $out;
			}
			if (!strstr($template,$sec)) {
				$out[0] = $template;
				$out[1] = "";
				return $out;
			}

			$temp=explode($first,$template);
			$temp2=explode($sec,$temp[1]);
			$row=$temp2[0];
			$out[0]=str_replace($first.$row.$sec,$change,$template);
			$out[1]=$row;
			return $out;
		}


		////
		//!ok .. you have a template which has left tags and you would like to get rid of them... 
		//suply the template and the first part of the tag [note that it has to end the same way that it starts]
		// exsample: if you have ##somehthing## in the template which should be replaced by a blank letter you call it
		// template_clean_up_tags($template,"##"); and all the tags will be cleaned! 
		//@author Samo Gabrovec (root@velenje.cx)
		//@param  template and string of which the tag begins with [##mytag## ->> ##] 
		//@return cleaned template
		//@globs  none
		function template_clean_up_tags($template,$tag,$way=false) {

			if (!$template) {
				return false;
			}

			if (!stristr($template,$tag)) {
				return $template;
			}

			if ($way==1) {
				//for clearing ##TAG##text##TAG## all together
				$template=preg_replace("/".$tag.".*".$tag."/Us","",$template);
			} else {
				$template=ereg_replace($tag."[^".$tag[0]."]+".$tag,"",$template);
			}

			return $template;
		}

		function template_get_repeat_text3($tag,$change,$template) {
			if (!strstr($template,"##".$tag."_START##") || !strstr($template,"##".$tag."_END##")) {
				$out[0] = $template;
				$out[1] = "";
				$out[2] = "";
				$out[3] = "";
				return $out;
			}

			$temp = explode("##".$tag."_START##",$template);
			$out[0] = $temp[0];

			if (strstr($temp[1],"##".$tag."_IFNO##")) {
				$temp = explode("##".$tag."_IFNO##",$temp[1]);
				$out[1] = $temp[0];
				$temp = explode("##".$tag."_END##",$temp[1]);
				$out[2] = $temp[0];

			} else {
				$temp = explode("##".$tag."_END##",$temp[1]);
				$out[1] = $temp[0];
				$out[2] = "";
			}

			$out[0] = $out[0] . $change . $temp[1];
			return $out;
		}


		?>