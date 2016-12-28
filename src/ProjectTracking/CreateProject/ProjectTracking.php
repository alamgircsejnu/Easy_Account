<?php
namespace App\ProjectTracking\CreateProject;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-12
 * Time: 10:12 AM
 */
class ProjectTracking
{


    public $id = '';
    public $companyId = '';
    public $projectId = '';
    public $projectName = '';
    public $customerId = '';
    public $customerName = '';
    public $POAmount = '';
    public $PODate = '';
    public $deliveryDate = '';
    public $description = '';


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
        if (array_key_exists('projectId', $data)) {
            $this->projectId = $data['projectId'];
        }
        if (array_key_exists('projectName', $data)) {
            $this->projectName = $data['projectName'];
        }
        if (array_key_exists('customerId', $data)) {
            $this->customerId = $data['customerId'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('POAmount', $data)) {
            $this->POAmount = $data['POAmount'];
        }
        if (array_key_exists('PODate', $data)) {
            $this->PODate = $data['PODate'];
        }
        if (array_key_exists('deliveryDate', $data)) {
            $this->deliveryDate = $data['deliveryDate'];
        }
        if (array_key_exists('description', $data)) {
            $this->description = $data['description'];
        }
        if (array_key_exists('createdBy', $data)) {
            $this->createdBy = $data['createdBy'];
        }

//        print_r($this);
//
//        die();


    }


    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->projectId) && !empty($this->projectId)){
            $query="INSERT INTO `tbl_project` (`id`,`company_id`, `project_id`,`project_name`,`customer_id`,`customer_name`,`project_description`,`project_status`,`project_price`,`po_date`,`delivery_date`,`created_by`,`created_at`) VALUES ('','".$this->companyId."', '".$this->projectId."','". $this->projectName."','". $this->customerId."','". $this->customerName."','". $this->description."','Running','". $this->POAmount."','". $this->PODate."','". $this->deliveryDate."','". $this->createdBy."','". date('Y-m-d H:i:s')."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }  else {
                $_SESSION['errorMessage']="Failed to add the Employee";
            }
        }  else {
            $_SESSION['errorMessage']="Fill All the Field";

        }
        header('location:index.php');
    }


    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project` where `tbl_project`.`company_id` = '".$this->companyId."' AND `tbl_project`.`finished_at` IS NULL AND `tbl_project`.`deleted_at` IS NULL";
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
        $query="SELECT * FROM `tbl_project` where id=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function sections($projectId=''){
        $mydata = array();
        $query="SELECT * FROM `tbl_project_detail` WHERE `project_id`='$projectId'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function update()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_project` SET `project_id` = '" . $this->projectId . "',`project_name`='" . $this->projectName . "',`customer_name`='" . $this->customerName . "',`project_description`='" . $this->description . "',`project_price`='" . $this->POAmount . "',`po_date`='" . $this->PODate . "',`delivery_date`='" . $this->deliveryDate . "',`updated_at`='" . date('Y-m-d H:i:s') . "' WHERE `tbl_project`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {

        $_SESSION['successMessage'] = "Data Updated Successfully";
        }
        header('location:index.php');
    }

    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_project` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_project`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function firstEntry(){
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id` = '".$this->companyId."' ORDER BY id ASC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function finish()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_project` SET `project_status` = 'Finished' AND `finished_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_project`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Finished Successfully";
        }
        header('location:index.php');
    }

    public function customers(){
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
    public function singleEntry($customerID=''){
        $query="SELECT * FROM `tbl_customer` where `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_id`='".$customerID."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }




}