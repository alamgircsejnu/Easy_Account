<?php
namespace App\Marketing\Offer;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-27
 * Time: 2:41 PM
 */
class Offer
{
    public $id = '';
    public $companyId = '';
    public $offerId = '';
    public $customerName = '';
    public $amount = '';
    public $phone = '';
    public $contactPerson = '';
    public $mobilePhone = '';
    public $promotedBy = '';
    public $offerDate = '';
    public $description = '';
    public $entryBy = '';


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
        if (array_key_exists('offerId', $data)) {
            $this->offerId = $data['offerId'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('amount', $data)) {
            $this->amount = $data['amount'];
        }
        if (array_key_exists('phone', $data)) {
            $this->phone = $data['phone'];
        }
        if (array_key_exists('contactPerson', $data)) {
            $this->contactPerson = $data['contactPerson'];
        }
        if (array_key_exists('mobilePhone', $data)) {
            $this->mobilePhone = $data['mobilePhone'];
        }
        if (array_key_exists('promotedBy', $data)) {
            $this->promotedBy = $data['promotedBy'];
        }
        if (array_key_exists('offerDate', $data)) {
            $this->offerDate = $data['offerDate'];
        }
        if (array_key_exists('description', $data)) {
            $this->description = $data['description'];
        }

        if (array_key_exists('entryBy', $data)) {
            $this->entryBy = $data['entryBy'];
        }

//        print_r($this);
//
//        die();


    }


    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->offerId) && !empty($this->offerId)){
            $query="INSERT INTO `tbl_offer` (`id`,`company_id`, `offer_id`,`customer_name`,`contact_person`,`phone_number`,`mobile_number`,`description`,`offer_amount`,`offer_date`,`entry_date`,`promoted_by`,`entry_by`) VALUES ('','".$this->companyId."', '".$this->offerId."','". $this->customerName."','". $this->contactPerson."','". $this->phone."','". $this->mobilePhone."','". $this->description."','". $this->amount."','". $this->offerDate."','".date('Y-m-d H:i:s')."','". $this->promotedBy."','". $this->entryBy."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }
        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_offer` WHERE `tbl_offer`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_offer` where `tbl_offer`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_offer` SET `offer_id` = '".$this->offerId."',`customer_name`='".$this->customerName."',`contact_person`='".$this->contactPerson."',`phone_number`='".$this->phone."',`mobile_number`='".$this->mobilePhone."',`description`='".$this->description."',`offer_amount`='".$this->amount."',`offer_date`='".$this->offerDate."',`promoted_by`='".$this->promotedBy."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_offer`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_offer` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_offer`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_offer` WHERE `tbl_offer`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function Customers(){
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

    public function Employee(){
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

    public function Projects(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function totalAmount(){
        $query="SELECT SUM(offer_amount) AS total_amount FROM `tbl_offer` where deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
}