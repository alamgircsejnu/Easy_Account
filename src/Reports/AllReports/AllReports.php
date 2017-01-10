<?php
namespace App\Reports\AllReports;

use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2017-01-04
 * Time: 4:13 PM
 */
class AllReports
{
    public $id = '';
    public $companyId = '';
    public $employeeId = '';
    public $from = '';
    public $to = '';


    public function __construct()
    {
        $conn = new dbConnection();
        $connection = $conn->connect();
    }

    public function prepare($data = '')
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists('companyId', $data)) {
            $this->companyId = $data['companyId'];
        }
        if (array_key_exists('employeeId', $data)) {
            $this->employeeId = $data['employeeId'];
        }
        if (array_key_exists('from', $data)) {
            $this->from = $data['from'];
        }
        if (array_key_exists('to', $data)) {
            $this->to = $data['to'];
        }
//        print_r($this);
//
//        die();

    }

    public function employeeAttendanceReport(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense_log` WHERE `tbl_attendense_log`.`company_id`='".$this->companyId."' AND `tbl_attendense_log`.`employee_id`='".$this->employeeId."' AND `tbl_attendense_log`.`date` BETWEEN '".$this->from."' AND '".$this->to."' ORDER BY date ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function employee(){
        $mydata=array();
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }


    public function holiday($date = ''){
        $query="SELECT * FROM `tbl_holiday` WHERE `tbl_holiday`.`company_id`='".$this->companyId."' AND `tbl_holiday`.`date`='".$date."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function summaryReport(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense_log` WHERE `tbl_attendense_log`.`company_id`='".$this->companyId."' AND `tbl_attendense_log`.`date` BETWEEN '".$this->from."' AND '".$this->to."' ORDER BY date ASC";

        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
}