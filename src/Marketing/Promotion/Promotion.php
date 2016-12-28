<?php
namespace App\Marketing\Promotion;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-27
 * Time: 10:54 AM
 */
class Promotion
{
    public $id = '';
    public $companyId = '';
    public $promotionId = '';
    public $customerName = '';
    public $media = '';
    public $contactPerson = '';
    public $eventDate = '';
    public $mobilePhone = '';
    public $promotedBy = '';
    public $product = '';
    public $nextSched = '';
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
        if (array_key_exists('promotionId', $data)) {
            $this->promotionId = $data['promotionId'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('media', $data)) {
            $this->media = $data['media'];
        }
        if (array_key_exists('contactPerson', $data)) {
            $this->contactPerson = $data['contactPerson'];
        }
        if (array_key_exists('eventDate', $data)) {
            $this->eventDate = $data['eventDate'];
        }
        if (array_key_exists('mobilePhone', $data)) {
            $this->mobilePhone = $data['mobilePhone'];
        }
        if (array_key_exists('promotedBy', $data)) {
            $this->promotedBy = $data['promotedBy'];
        }
        if (array_key_exists('product', $data)) {
            $this->product = $data['product'];
        }
        if (array_key_exists('nextSched', $data)) {
            $this->nextSched = $data['nextSched'];
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
        if(isset($this->promotionId) && !empty($this->promotionId)){
            $query="INSERT INTO `tbl_promotion` (`id`,`company_id`, `promotion_id`,`customer_name`,`contact_person`,`next_sched`,`mobile_number`,`description`,`product`,`promotion_date`,`entry_date`,`promoted_by`,`entry_by`,`media`) VALUES ('','".$this->companyId."', '".$this->promotionId."','". $this->customerName."','". $this->contactPerson."','". $this->nextSched."','". $this->mobilePhone."','". $this->description."','". $this->product."','". $this->eventDate."','".date('Y-m-d H:i:s')."','". $this->promotedBy."','". $this->entryBy."','". $this->media."')";
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
        $query="SELECT * FROM `tbl_promotion` WHERE `tbl_promotion`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_promotion` where `tbl_promotion`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_promotion` SET `promotion_id` = '".$this->promotionId."',`customer_name`='".$this->customerName."',`contact_person`='".$this->contactPerson."',`next_sched`='".$this->nextSched."',`mobile_number`='".$this->mobilePhone."',`description`='".$this->description."',`product`='".$this->product."',`promotion_date`='".$this->eventDate."',`promoted_by`='".$this->promotedBy."',`media`='".$this->media."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_promotion`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_promotion` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_promotion`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_promotion` WHERE `tbl_promotion`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function contactPersons(){
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
}