<?php

namespace App\Attendense\AttendenseEntry;

use App\dbConnection;
//include_once '../../../dbConnection.php';
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-07
 * Time: 11:48 AM
 */
class AttendenseEntry
{
    public $id = '';
    public $companyId = '';
    public $employeeId = '';
    public $employeeName = '';
    public $date = '';
    public $dutyLocation = '';
    public $inTime = '';
    public $outTime = '';
    public $remarks = '';
    public $approvedBy = '';
    public $approvedDate = '';

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
        if (array_key_exists('employeeName', $data)) {
            $this->employeeName = $data['employeeName'];
        }
        if (array_key_exists('date', $data)) {
            $this->date = $data['date'];
        }
        if (array_key_exists('dutyLocation', $data)) {
            $this->dutyLocation = $data['dutyLocation'];
        }
        if (array_key_exists('inTime', $data)) {
            $this->inTime = $data['inTime'];
        }
        if (array_key_exists('outTime', $data)) {
            $this->outTime = $data['outTime'];
        }
        if (array_key_exists('remarks', $data)) {
            $this->remarks = $data['remarks'];
        }
        if (array_key_exists('approvedBy', $data)) {
            $this->approvedBy = $data['approvedBy'];
        }
        if (array_key_exists('approvedDate', $data)) {
            $this->approvedDate = $data['approvedDate'];
        }



//        print_r($this);
//
//        die();


    }

    public function store()
    {
        if (isset($this->employeeId) && !empty($this->employeeId)) {

            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`, `employee_id`,`employee_name`,`date`,`duty_location`,`in_time`,`out_time`,`remarks`,`is_approved`,`created_at`) VALUES ('', '" . $this->companyId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date . "','" . $this->dutyLocation . "','" . $this->inTime . "','" . $this->outTime . "','" . $this->remarks . "','0','" . date('Y-m-d') . "')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendense added for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }

        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`employee_id`='".$this->employeeId."' ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function pendingRequests(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`is_approved`='0' ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function approvedRequests(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`is_approved`='1' ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function approve()
    {

        $query = "UPDATE `tbl_attendense` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . $this->approvedDate . "' WHERE  `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`id` =" . $this->id;

        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:pendingAttendense.php');
    }

}