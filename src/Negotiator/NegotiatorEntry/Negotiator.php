<?php
namespace App\Negotiator\NegotiatorEntry;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2017-01-21
 * Time: 9:43 AM
 */
class Negotiator
{
    public $id = '';
    public $companyId = '';
    public $negoId = '';
    public $negoName = '';
    public $negoDesignation = '';
    public $negoPhone = '';
    public $negoEmail = '';
    public $negoCompany = '';
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
        if (array_key_exists('negoId', $data)) {
            $this->negoId = $data['negoId'];
        }
        if (array_key_exists('negoName', $data)) {
            $this->negoName = $data['negoName'];
        }
        if (array_key_exists('negoDesignation', $data)) {
            $this->negoDesignation = $data['negoDesignation'];
        }
        if (array_key_exists('negoPhone', $data)) {
            $this->negoPhone = $data['negoPhone'];
        }
        if (array_key_exists('negoEmail', $data)) {
            $this->negoEmail = $data['negoEmail'];
        }
        if (array_key_exists('negoCompany', $data)) {
            $this->negoCompany = $data['negoCompany'];
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
        if(isset($this->negoId) && !empty($this->negoId)){
            $query="INSERT INTO `tbl_negotiator` (`id`,`company_id`, `nego_id`,`nego_name`,`nego_designation`,`nego_company`,`nego_phone`,`nego_email`,`entry_date`,`entry_by`) VALUES ('','".$this->companyId."', '".$this->negoId."','". $this->negoName."','". $this->negoDesignation."','". $this->negoCompany."','". $this->negoPhone."','". $this->negoEmail."','". date('Y-m-d H:i:s')."','". $this->entryBy."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }else {
                $_SESSION['errorMessage']="Oops! Something wrong to add data";

            }
        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_negotiator` WHERE `tbl_negotiator`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_negotiator` where `tbl_negotiator`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_negotiator` SET `nego_id` = '".$this->negoId."',`nego_name`='".$this->negoName."',`nego_designation`='".$this->negoDesignation."',`nego_company`='".$this->negoCompany."',`nego_phone`='".$this->negoPhone."',`nego_email`='".$this->negoEmail."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_negotiator`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_negotiator` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_negotiator`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_negotiator` WHERE `tbl_negotiator`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function company(){
        $mydata=array();
        $query="SELECT * FROM `tbl_customer` WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
}