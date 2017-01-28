<?php

namespace App\Employee\ManageEmployee;
use App\dbConnection;
//session_start();

/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-08
 * Time: 11:19 AM
 */
class Employee
{

    public $id = '';
    public $companyId = '';
    public $employeeId = '';
    public $department = '';
    public $firstName = '';
    public $lastName = '';
    public $designation = '';
    public $cardId = '';
    public $shift = '';
    public $dateOfBirth = '';
    public $joiningDate = '';
    public $contactNo = '';
    public $bloodGroup = '';
    public $presentAddress = '';
    public $permanentAddress = '';
    public $status = '';
    public $remarks = '';


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
        if (array_key_exists('department', $data)) {
            $this->department = $data['department'];
        }
        if (array_key_exists('firstName', $data)) {
            $this->firstName = $data['firstName'];
        }
        if (array_key_exists('lastName', $data)) {
            $this->lastName = $data['lastName'];
        }
        if (array_key_exists('designation', $data)) {
            $this->designation = $data['designation'];
        }
        if (array_key_exists('cardId', $data)) {
            $this->cardId = $data['cardId'];
        }
        if (array_key_exists('shift', $data)) {
            $this->shift = $data['shift'];
        }
        if (array_key_exists('dateOfBirth', $data)) {
            $this->dateOfBirth = $data['dateOfBirth'];
        }
        if (array_key_exists('joiningDate', $data)) {
            $this->joiningDate = $data['joiningDate'];
        }

        if (array_key_exists('contactNo', $data)) {
            $this->contactNo = $data['contactNo'];
        }

        if (array_key_exists('bloodGroup', $data)) {
            $this->bloodGroup = $data['bloodGroup'];
        }

        if (array_key_exists('presentAddress', $data)) {
            $this->presentAddress = $data['presentAddress'];
        }

        if (array_key_exists('permanentAddress', $data)) {
            $this->permanentAddress = $data['permanentAddress'];
        }

        if (array_key_exists('status', $data)) {
            $this->status = $data['status'];
        }

        if (array_key_exists('remarks', $data)) {
            $this->remarks = $data['remarks'];
        }



//        print_r($this);
//
//        die();


    }


    public function store(){
        if(isset($this->employeeId) && !empty($this->employeeId)){
            $query="INSERT INTO `tbl_employee` (`id`,`company_id`, `employee_id`,`first_name`,`last_name`,`card_id`,`department`,`designation`,`date_of_birth`,`joining_date`,`shift`,`contact_no`,`present_address`,
`permanent_address`,`status`,`blood_group`,`remarks`,`created_at`) VALUES ('','".$this->companyId."', '".$this->employeeId."','". $this->firstName."','". $this->lastName."','". $this->cardId."','". $this->department."','". $this->designation."','". $this->dateOfBirth."','". $this->joiningDate."','". $this->shift."','". $this->contactNo."','". $this->presentAddress."','". $this->permanentAddress."','". $this->status."','". $this->bloodGroup."','". $this->remarks."','". date('Y-m-d')."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }
        }  else {
            $_SESSION['errorMessage']="Fill All the Field";

        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY employee_id";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function show($id=''){
        $this->id=$id;
        $query="SELECT * FROM `tbl_employee` where `tbl_employee`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update(){
        $query="UPDATE `tbl_employee` SET `employee_id` = '".$this->employeeId."',`first_name`='".$this->firstName."',`last_name`='".$this->lastName."',`card_id`='".$this->cardId."',`department`='".$this->department."',`designation`='".$this->designation."',`date_of_birth`='".$this->dateOfBirth."',`joining_date`='".$this->joiningDate."',`shift`='".$this->shift."',`contact_no`='".$this->contactNo."',`present_address`='".$this->presentAddress."',`permanent_address`='".$this->permanentAddress."',`status`='".$this->status."',`blood_group`='".$this->bloodGroup."',`remarks`='".$this->remarks."' WHERE `tbl_employee`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }

    public function trash()
    {

        $query = "UPDATE `tbl_employee` SET `deleted_at` = '" . date('Y-m-d') . "' WHERE `tbl_employee`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

        header('location:index.php');
    }
    public function lastEntry(){
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function shift(){
        $mydata=array();
        $query="SELECT * FROM `tbl_shift` WHERE `tbl_shift`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`is_user`='0' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

}