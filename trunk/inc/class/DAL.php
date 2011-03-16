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
    public function get_count_dissorder_age_persons_by_unit($unit_in, $role_id_min, $role_id_max, $age_min, $age_max, $disorder_id) {
        $sql = "SELECT  count(`id_person`) as sestevek
               FROM `persons` left join DisorderLog on DisorderLog.person_id=persons.id_person
               where (year(`birthday`)
                      between year(now())-$age_max
                              and year(now())-$age_min)
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
        $sql = ' SELECT count( `person_id` ) as stevilo, unit as unit_id
                 FROM `PersonStatus` left join persons on person_id=id_person
                 WHERE (
                  ("'.$date.'") >= `created_at`
                   )
                   AND (
                   ("'.$date.'") <= `expired_at`
                   OR `expired_at` = "0000-00-00"
                   ) group by unit'
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

    private function dbconnect() {
        //global $db;
        //return $db;
    }

    private function query($sql) {

        global $db;

        //$db = $this->dbconnect();

        $res = $db->FetchAll($sql);
        return $res;

        /*
          if ($res){
          if (strpos($sql,'SELECT') === false){
          return true;
          }
          }
          else{
          if (strpos($sql,'SELECT') === false){
          return false;
          }
          else{
          return null;
          }
          }

          $results = array();

          while ($row = mysql_fetch_array($res)){

          $result = new DALQueryResult();

          foreach ($row as $k=>$v){
          $result->$k = $v;
          }

          $results[] = $result;
          }
          return $results;

         */
    }

}
?>
