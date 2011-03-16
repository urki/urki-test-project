<?



function render_log_table($log_array,$row) {

	if (!$log_array or !$row)
		return false;


      

	foreach ($log_array as $L) {	
		$table.=$row;
		//print_r($overtime_hours_all);

		$table = str_replace("##FIRST##",$L["first"],$table);
		$table = str_replace("##LAST##",$L["last"],$table);
		$table = str_replace("##WORKING_DAYS##",empty_table($L["working_days"]),$table);
		$table = str_replace("##WORKING_HOURS##",empty_table(change_sec_hm($L["working_hours"])),$table);
                $table = str_replace("##HOLIDAY_HOURS##",empty_table(change_sec_hm($L["holiday_hours"])),$table);
                $table = str_replace("##OVERTIME_HOURS##",empty_table(change_sec_hm($L["overtime_hours"])),$table);
                $table = str_replace("##OVERTIME_HOURS_ALL##",empty_table(change_sec_hm($L["overtime_hours_all"])),$table);
                $table = str_replace("##OFFTIME_HOURS##",empty_table(change_sec_hm($L["offtime_hours"])),$table);
                $table = str_replace("##HOURS_LEFT##",empty_table(change_sec_hm(($L["overtime_hours_all"])-($L["offtime_hours_all"])-($L["compensation_hours_all"])  )),$table);
                $table = str_replace("##SICK_DAYS##",empty_table($L["sick_days"]),$table);
		$table = str_replace("##HOLIDAY_DAYS##",empty_table($L["holiday_days"]),$table);
		$table = str_replace("##HOLIDAYS_LEFT##",empty_table($person_holiday-($L["holiday_days"])),$table);
		$table = str_replace("##CARE##",empty_table($L["care"]),$table);
		$table = str_replace("##PREGNANCY##",empty_table($L["pregnancy"]),$table);
		$table = str_replace("##EDUCATION##",empty_table($L["education"]),$table);
		$table = str_replace("##PUBLIC_HOLIDAY##",empty_table($L["public_holiday"]),$table);
		$table = str_replace("##HOLIDAYS_DAYS_ALL##",empty_table($L["holiday_days_all"]),$table);
		$table = str_replace("##MISSION_DAYS##",empty_table($L["mission"]),$table);
		$table = str_replace("##MISSION_HOURS##",empty_table(change_sec_hm($L["mission_hours"])),$table);
                $table = str_replace("##HOLID_ALL_RES##",empty_table(($L["holid_all_res"])-($L["holiday_days_all"])-($L["compensation_wdays_all"])),$table);
	        $table = str_replace("##BLOODAY##",empty_table($L["blooday"]),$table);
                $table = str_replace("##SABBATICAL_ALL_RES##",empty_table(($L["sabbatical_leave_all_res"])-(($L["sabbatical_leave_all"]))),$table);
                $table = str_replace("##SPECIALEAVE##",empty_table($L["special_leave"]),$table);
                $table = str_replace("##SPECIALLEAVE_LEFT##",empty_table(($L["special_leave_all_res"])-(($L["special_leave_all"]))),$table);
                $table = str_replace("##WORKINJURY##",empty_table($L["work_injury"]),$table);
                $table = str_replace("##SABBATICAL##",empty_table($L["sabbatical_leave"]),$table);
	}
	return $table;
}

?>