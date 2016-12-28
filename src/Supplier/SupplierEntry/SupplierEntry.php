<?php
namespace App\Supplier\SupplierEntry;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-12
 * Time: 5:42 PM
 */
class SupplierEntry
{
    public $id = '';
    public $companyId = '';
    public $supplierId = '';
    public $supplierName = '';
    public $supplierAddress = '';
    public $supplierPhone = '';
    public $supplierEmail = '';
    public $supplierDue = '';
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
        if (array_key_exists('vendorId', $data)) {
            $this->supplierId = $data['vendorId'];
        }
        if (array_key_exists('vendorName', $data)) {
            $this->supplierName = $data['vendorName'];
        }
        if (array_key_exists('vendorAddress', $data)) {
            $this->supplierAddress = $data['vendorAddress'];
        }
        if (array_key_exists('vendorPhone', $data)) {
            $this->supplierPhone = $data['vendorPhone'];
        }
        if (array_key_exists('vendorEmail', $data)) {
            $this->supplierEmail = $data['vendorEmail'];
        }
        if (array_key_exists('vendorDue', $data)) {
            $this->supplierDue = $data['vendorDue'];
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
        if(isset($this->supplierId) && !empty($this->supplierId)){
            $query="INSERT INTO `tbl_supplier` (`id`,`company_id`, `supplier_id`,`supplier_name`,`supplier_address`,`supplier_phone`,`supplier_email`,`entry_date`,`entry_by`) VALUES ('','".$this->companyId."', '".$this->supplierId."','". $this->supplierName."','". $this->supplierAddress."','". $this->supplierPhone."','". $this->supplierEmail."','". date('Y-m-d H:i:s')."','". $this->employeeName."')";
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
        $query="SELECT * FROM `tbl_supplier` WHERE `tbl_supplier`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_supplier` where `tbl_supplier`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_supplier` SET `supplier_id` = '".$this->supplierId."',`supplier_name`='".$this->supplierName."',`supplier_address`='".$this->supplierAddress."',`supplier_phone`='".$this->supplierPhone."',`supplier_email`='".$this->supplierEmail."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_supplier`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_supplier` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_supplier`.`id` =" . $this->id;
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
        $query="SELECT * FROM `tbl_supplier` WHERE `tbl_supplier`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
}