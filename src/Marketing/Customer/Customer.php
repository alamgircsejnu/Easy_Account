<?php
namespace App\Marketing\Customer;
use App\dbConnection;
class Customer
{
    public $id = '';
    public $companyId = '';
    public $customerId = '';
    public $customerName = '';
    public $customerAddress = '';
    public $factoryAddress = '';
    public $customerContact = '';
    public $factoryContact = '';
    public $designation = '';
    public $factoryDesignation = '';
    public $customerEmail = '';
    public $factoryEmail = '';
    public $customerMobile = '';
    public $factoryMobile = '';
    public $customerPhone = '';
    public $factoryPhone = '';
    public $startingYear = '';
    public $employeeName = '';


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
        if (array_key_exists('customerId', $data)) {
            $this->customerId = $data['customerId'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('customerAddress', $data)) {
            $this->customerAddress = $data['customerAddress'];
        }
        if (array_key_exists('factoryAddress', $data)) {
            $this->factoryAddress = $data['factoryAddress'];
        }
        if (array_key_exists('customerContact', $data)) {
            $this->customerContact = $data['customerContact'];
        }
        if (array_key_exists('factoryContact', $data)) {
            $this->factoryContact = $data['factoryContact'];
        }
        if (array_key_exists('designation', $data)) {
            $this->designation = $data['designation'];
        }
        if (array_key_exists('factoryDesignation', $data)) {
            $this->factoryDesignation = $data['factoryDesignation'];
        }
        if (array_key_exists('customerEmail', $data)) {
            $this->customerEmail = $data['customerEmail'];
        }

        if (array_key_exists('factoryEmail', $data)) {
            $this->factoryEmail = $data['factoryEmail'];
        }

        if (array_key_exists('customerMobile', $data)) {
            $this->customerMobile = $data['customerMobile'];
        }

        if (array_key_exists('factoryMobile', $data)) {
            $this->factoryMobile = $data['factoryMobile'];
        }

        if (array_key_exists('customerPhone', $data)) {
            $this->customerPhone = $data['customerPhone'];
        }

        if (array_key_exists('factoryPhone', $data)) {
            $this->factoryPhone = $data['factoryPhone'];
        }

        if (array_key_exists('startingYear', $data)) {
            $this->startingYear = $data['startingYear'];
        }

        if (array_key_exists('employeeName', $data)) {
            $this->employeeName = $data['employeeName'];
        }



//        print_r($this);
//
//        die();


    }


    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->customerId) && !empty($this->customerId)){
            $query="INSERT INTO `tbl_customer` (`id`,`company_id`, `customer_id`,`customer_name`,`customer_address`,`customer_phone`,`customer_contact`,`contact_desig`,`customer_email`,`customer_mobile`,`customer_factory`,`factory_phone`,`factory_contact`,
`fac_cont_desig`,`customer_email2`,`customer_mobile2`,`starting_year`,`data_entry_date`,`entry_by`,`debit`,`credit`,`status`) VALUES ('','".$this->companyId."', '".$this->customerId."','". $this->customerName."','". $this->customerAddress."','". $this->customerPhone."','". $this->customerContact."','". $this->designation."','". $this->customerEmail."','". $this->customerMobile."','". $this->factoryAddress."','". $this->factoryPhone."','". $this->factoryContact."','". $this->factoryDesignation."','". $this->factoryEmail."','". $this->factoryMobile."','". $this->startingYear."','". date('Y-m-d H:i:s')."','". $this->employeeName."','0','0','0')";
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
        $query="SELECT * FROM `tbl_customer` WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_customer` where `tbl_customer`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_customer` SET `customer_id` = '".$this->customerId."',`customer_name`='".$this->customerName."',`customer_address`='".$this->customerAddress."',`customer_phone`='".$this->customerPhone."',`customer_contact`='".$this->customerContact."',`contact_desig`='".$this->designation."',`customer_email`='".$this->customerEmail."',`customer_mobile`='".$this->customerMobile."',`customer_factory`='".$this->factoryAddress."',`factory_phone`='".$this->factoryPhone."',`factory_contact`='".$this->factoryContact."',`fac_cont_desig`='".$this->factoryDesignation."',`customer_email2`='".$this->factoryEmail."',`customer_mobile2`='".$this->factoryMobile."',`starting_year`='".$this->startingYear."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_customer`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_customer` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_customer`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_customer` WHERE `tbl_customer`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
}