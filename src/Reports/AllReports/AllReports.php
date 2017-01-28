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
    public $date = '';
    public $allDept = '';
    public $department = '';
    public $allEmp = '';


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
        if (array_key_exists('date', $data)) {
            $this->date = $data['date'];
        }
        if (array_key_exists('allDept', $data)) {
            $this->allDept = $data['allDept'];
        }
        if (array_key_exists('department', $data)) {
            $this->department = $data['department'];
        }
        if (array_key_exists('allEmp', $data)) {
            $this->allEmp = $data['allEmp'];
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
        if (isset($this->allDept) && !empty($this->allDept)){
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY department";
        } elseif (isset($this->department) && !empty($this->department)){
            $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND`tbl_employee`.`department`='".$this->department."' AND deleted_at IS NULL";

        }
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function department(){
        $mydata=array();
        $query="SELECT DISTINCT department FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function oneEmployee(){
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id`='".$this->employeeId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function oneHoliday($date=''){
        $query="SELECT * FROM `tbl_holiday` WHERE `tbl_holiday`.`company_id`='".$this->companyId."' AND `tbl_holiday`.`date`='".$date."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function holiday(){
        $mydata=array();
        $query="SELECT * FROM `tbl_holiday` WHERE `tbl_holiday`.`company_id`='".$this->companyId."' AND `tbl_holiday`.`date` BETWEEN '".$this->from."' AND '".$this->to."' AND deleted_at IS NULL ORDER BY date ASC";

        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
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

    public function inOutReport(){
        $mydata=array();
        if (isset($this->allEmp) && !empty($this->allEmp)){
        $query="SELECT * FROM `tbl_card` WHERE `tbl_card`.`company_id`='".$this->companyId."' AND `tbl_card`.`ctime` BETWEEN '".$this->from." 00:00:00' AND '".$this->to." 23:59:59' ORDER BY ctime ASC";
        } elseif (isset($this->employeeId) && !empty($this->employeeId)){
            $query="SELECT * FROM `tbl_card` WHERE `tbl_card`.`company_id`='".$this->companyId."' AND `tbl_card`.`employee_id`='".$this->employeeId."' AND `tbl_card`.`ctime` BETWEEN '".$this->from." 00:00:00' AND '".$this->to." 23:59:59' ORDER BY ctime ASC";
        }
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function holidayReport(){
        $mydata=array();
        $query="SELECT * FROM `tbl_holiday` WHERE `tbl_holiday`.`company_id`='".$this->companyId."' AND `tbl_holiday`.`date` BETWEEN '".$this->from."' AND '".$this->to."' ORDER BY date ASC";
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function leaveReport(){
        $mydata=array();
        $query="SELECT * FROM `tbl_leave` WHERE `tbl_leave`.`company_id`='".$this->companyId."' AND `tbl_leave`.`employee_id`='".$this->employeeId."' AND `tbl_leave`.`date` BETWEEN '".$this->from."' AND '".$this->to."' ORDER BY date ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function leaveSummaryReport(){
        $mydata=array();
        $query="SELECT * FROM `tbl_leave` WHERE `tbl_leave`.`company_id`='".$this->companyId."' AND `tbl_leave`.`employee_id`='".$this->employeeId."' AND `tbl_leave`.`is_approved`='1' AND `tbl_leave`.`date` BETWEEN '".$this->from."' AND '".$this->to."' ORDER BY date ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
}