<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-21
 * Time: 10:44 AM
 */

namespace App\AccountInfo\Account;
use App\dbConnection;

class Account
{
    public $id = '';
    public $companyId = '';
    public $accountId = '';
    public $accountNo = '';
    public $bankName = '';
    public $accountThresh = '';

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
        if (array_key_exists('accountId', $data)) {
            $this->accountId = $data['accountId'];
        }
        if (array_key_exists('accountNo', $data)) {
            $this->accountNo = $data['accountNo'];
        }
        if (array_key_exists('bankName', $data)) {
            $this->bankName = $data['bankName'];
        }
        if (array_key_exists('accountThresh', $data)) {
            $this->accountThresh = $data['accountThresh'];
        }

//        print_r($this);
//
//        die();

    }

    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->accountId) && !empty($this->accountId)){
            $query="INSERT INTO `tbl_account` (`id`,`company_id`, `account_id`,`account_number`,`account_bank`,`account_thresh`,`created_at`) VALUES ('','".$this->companyId."', '".$this->accountId."','". $this->accountNo."','". $this->bankName."','". $this->accountThresh."','". date('Y-m-d H:i:s')."')";
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
        $query="SELECT * FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }
    public function show(){
        $query="SELECT * FROM `tbl_account` where `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_account` SET `account_id` = '".$this->accountId."',`account_number`='".$this->accountNo."',`account_bank`='".$this->bankName."',`account_thresh`='".$this->accountThresh."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_account`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_account` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_account`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_account` WHERE `tbl_account`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
}