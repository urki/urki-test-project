<?php

class DALQueryResult {

    private $_results = array();

    public function __construct() {

    }

    public function __set($var, $val) {
        $this->_results[$var] = $val;
    }

    public function __get($var) {
        if (isset($this->_results[$var])) {
            return $this->_results[$var];
        } else {
            return null;
        }
    }

}

class DAL {

    public function __construct() {

    }

//yearly report
//get number of disorder people by unit and by reole id

 
    /**
	* working_time_status querys
	* 
	* Query for getting data from working_time_query entity which was last or first inserted
	* Query:
	*
    *{@source 3 3}
    *@see DAL::get_person_data_from_persons_by_person_id, id()
        */     
        /*public function get_data_from_workingTime_status($minOrMax='<') {
        
            $sql="
             select m1.*  from working_time_status as m1 left join working_time_status as m2 
                 ON (m1.`id` $minOrMax m2.`id` and m1.`workingTime_id`=m2.`workingTime_id`)
                 Where m2.id is NULL
             ";
        return $this->query($sql);
         
         */
    public function get_data_group_from_workingTime_status_workingTime_persons_by_status($status) {
           if (isset($status)){
               $status='status='.$status;
           }
           else {
            $status='';
           }
            $sql="
             SELECT m1. * 
             FROM working_time_status AS m1
              LEFT JOIN working_time_status AS m2 ON ( m1.`id` < m2.`id`
             AND m1.`workingTime_id` = m2.`workingTime_id` )
             WHERE m2.id IS NULL $status
             ";
        return $this->query($sql);
    }
    
    
    
 
    /**
	* Aims querys
	* 
	* Query for getting data from aim entity ordered by id descending for getting aims
	* Query:
	*
    *{@source 3 3}
    *@see DAL::get_person_data_from_persons_by_person_id()
        */     
        public function get_data_from_aim_order_by_id_desc() {
        $sql="
         select * 
         from aim 
         order by id desc";
        return $this->query($sql);
    }



  
 

   /**
	* Log querys
	* 
	* Query to get person from log entity by person id. It is used in evidencaVDC action.php
	* Query:
	*
    *{@source 3 6}
    *@see 
   */  


            //used in evidencaVDC Action
 public function get_data_from_log_by_job_and_person_and_modified($jobtype_id, $person_id, $modified_by = "!=''"){
     $sql="SELECT *
           FROM `log`
           WHERE `jobtype_id` =$jobtype_id
                  AND `person_id` =$person_id 
                  AND `note` $modified_by
           order by `log_id` desc
           ";
    //var_dump($sql);
     return $this->query($sql);
 }



//Persons Query

     public function get_person_data_from_persons_by_person_id($person_id) {
        $sql= "SELECT * FROM persons
               WHERE id_person=$person_id";
        return $this->query($sql);
    }

 //

//RfidRawLOG

    public function get_data_from_rfidrawlog_by_person($person_id){
        $sql = "SELECT * FROM RfidRawLog where person_id=$person_id  order by timestamp desc limit 0, 1";
       return $this->query($sql);
        //var_dump($sql);
    }
//Rfid querys
    public function get_active_person_data_from_Rfid_by_rfid_status($rfid,$status) {
        $sql= "SELECT * FROM `Rfid` left join persons on person_id=id_person where rfid='$rfid' and status='$status'";
     //var_dump($sql);

        return $this->query($sql);
    }

    //Person without or not active rfid
     public function get_active_person_data_from_Rfid_by_rfid_disabled() {
        $sql= "select id_person, last, first from persons right join
               ((select person_id
                 from Rfid where
                            person_id   not in (
                                                SELECT distinct person_id FROM `Rfid`
                                                Where  status ='active')
                                                group by  `person_id` )
                 UNION
                (select id_person from persons where rfid_id=0
               ))unionVseh
               on id_person=person_id where id_role>40  and unit=79 order by person_id  limit 0,3";
       
      
        return $this->query($sql);
    }
    //Person without or not active rfid
     public function get_active_person_data_from_Rfid_by_rfid_status3($rfid,$status,$queryDirection) {
        $sql= "SELECT * FROM `Rfid` $queryDirection join persons on person_id=id_person where rfid=$rfid and status='$status'";
        var_dump($sql);
        return $this->query($sql);
    }
/////////////////////////////////
    public function get_count_dissorder_age_persons_by_unit($unit_in, $role_id_min, $role_id_max, $age_min, $age_max, $disorder_id, $untilyear=2011) {
        $sql = "SELECT  count(`id_person`) as sestevek
               FROM `persons` left join DisorderLog on DisorderLog.person_id=persons.id_person
               where (year(`birthday`)
                      between $untilyear -$age_max
                              and $untilyear-$age_min)
               and id_role between $role_id_min and $role_id_max
               and unit in ($unit_in) and disorder_id in ($disorder_id)  ";
        return $this->query($sql);
    }

//get name array of units by persons_unit. exp. 1, name, 78
    public function get_unit_by_persons_unit($mid) {
        $sql = "SELECT * FROM unit WHERE persons_unit=$mid";
        return $this->query($sql);
    }

    public function test($higher) {
        $sql = "SELECT persons_unit from unit where persons_unit<$higher";
        return $this->query($sql);
    }

    public function get_count_persons_available_by_date($date) {

        $sql = " select unit as unit_id, date, count(person_id) as stevilo  from
             (
               select distinct `person_id` , date(from_unixtime(start)) as date, unit
               from work_log left join persons on person_id=id_person
               where from_unixtime(`start`) like '$date%'
               and id_role between 1 and 11
               )wokres
               group by unit, date";
//echo $sql;
        return $this->query($sql);
    }

    public function get_count_persons_registered_by_unit($date) {
        $sql = ' SELECT count( `person_id` ) as stevilo, persons.unit as unit_id
                 FROM `PersonStatus` left join persons on person_id=id_person
                 WHERE (
                  ("' . $date . '") >= `created_at`
                   )
                   AND (
                   ("' . $date . '") <= `expired_at`
                   OR `expired_at` = "0000-00-00"
                   ) group by persons.unit'
        ;
//echo $sql;
//die();
        return $this->query($sql);
    }

    public function get_log_by_name($name) {
        $sql = "SELECT timestamp as created_at, log_id as id,  model.name as name, makes.name as make FROM model INNER JOIN makes ON model.make=makes.id WHERE makes.name='$name'";
        return $this->query($sql);
    }

    public function get_person_by_unit($unitQuery) {
        $sql = "SELECT id_person as id, first, last, unit FROM persons where unit=$unitQuery";
        return $this->query($sql);
    }

    public function get_log_by_date($date) {
        $sql = "SELECT * FROM log where  unit='$unitQuery'";
        return $this->query($sql);
    }

//graphs
    public function get_presence_graph_by_person_year($person_id, $year) {
        $sql = "SELECT DATE( FROM_UNIXTIME(  `end` ) ) datum, DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%d' ) dan,  `persons`.`first` ime,  `persons`.`last` priimek, person_id
		FROM  `work_log` ,  `persons`
		WHERE  `persons`.`id_person` =  `work_log`.`person_id`
		AND persons.id_person = $person_id
	AND DATE_FORMAT( FROM_UNIXTIME(  `end` ) ,  '%Y %m' ) LIKE  '" . $year . "%'
	GROUP BY datum, person_id
	ORDER BY dan desc";
        return $this->query($sql);
    }

    public function yeardropdown() {
        //require_once('../html_function.php');
        echo "ne mi tezit";
        /*
          $Y = date("Y",time());
          for ($x=2009; $x<=$Y;$x++) {
          $ynames[].= $x;
          }
          $yvalues = $ynames;
          $year_dropdown = html_drop_down_arrays("year",$ynames,$yvalues,date("Y",time()));

          $tem = str_replace("##YDROP##",$year_dropdown,$tem);
          echo $tem;
         */
    }

    /*
      public function kakodela($funkcija){
      }
      $funkcija=$this->$funkcija;
      //$test= $this->$funkcija;
      $test="to je ".$test;
      echo "to ej funkcija".$funkcija;
      return $test;
      }
     */

//
//public function kakodela($selectedFunction,$var,$nameofcolumn1){
//
//
//
//$nekaj=$this->$selectedFunction($var);
//foreach ($nekaj as $work_c) {
//    $ime = $work_c[$nameofcolumn1];
//    echo 'Jaz sem ' . $ime . '<hr/>';
//}
////return $this->$vmes;
//
//}
//
////nosilec drop down

    public function NEWhtml_drop_down_arrays($drop_name, $names, $values, $selected, $style = FALSE) {

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

    public function two_by_space_separeted_words_via_one_condition($selectedFunction, $var) {

        $result = $this->$selectedFunction($var);

        foreach ($result as $res) {
//     if (!is_array($name)){
//        $name[]="izberi...";
//        $value[]="";
//    }
            $ime = $res['first'];
//    $value[].=$res["id"];
//}
//
//// $return=$this->NEWhtml_drop_down_arrays($drop_name, $names, $values, $selected, $style = FALSE);
// $return=$this->NEWhtml_drop_down_arrays('ime', $name, $value, $name, $style = FALSE);
//$ime = $res['first'];
            //  echo 'Jaz sem ' . $ime . '<hr/>';

            $return = $this->NEWhtml_drop_down_arrays('ime', $ime, $ime, $ime, $style = FALSE);
        }
    }

    private function dbconnect() {
//global $db;
//return $db;
    }

    private function query($sql) {

        global $db;


    
                $res = $db->FetchAll($sql);


        return $res;

    }

}
?>
