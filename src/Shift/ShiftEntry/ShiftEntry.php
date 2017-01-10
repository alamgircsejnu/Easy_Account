<?php
namespace App\Shift\ShiftEntry;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2017-01-02
 * Time: 12:43 PM
 */
class ShiftEntry
{
    public $id = '';
    public $companyId = '';
    public $shiftName = '';
    public $shiftStart = '';
    public $shiftEnd = '';
    public $entryAllowence = '';
    public $breakStart = '';
    public $breakEnd = '';
    public $breakAllowence = '';


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
        if (array_key_exists('shiftName', $data)) {
            $this->shiftName = $data['shiftName'];
        }
        if (array_key_exists('shiftStart', $data)) {
            $this->shiftStart = $data['shiftStart'];
        }
        if (array_key_exists('shiftEnd', $data)) {
            $this->shiftEnd = $data['shiftEnd'];
        }
        if (array_key_exists('entryAllowence', $data)) {
            $this->entryAllowence = $data['entryAllowence'];
        }
        if (array_key_exists('breakStart', $data)) {
            $this->breakStart = $data['breakStart'];
        }
        if (array_key_exists('breakEnd', $data)) {
            $this->breakEnd = $data['breakEnd'];
        }
        if (array_key_exists('breakAllowence', $data)) {
            $this->breakAllowence = $data['breakAllowence'];
        }

//        print_r($this);
//
//        die();

    }
    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->shiftName) && !empty($this->shiftName)){
            $query="INSERT INTO `tbl_shift` (`id`,`company_id`, `shift_name`,`start_time`,`end_time`,`break_start`,`break_end`,`in_allow_time`,`break_allow_time`,`entry_time`) VALUES ('','".$this->companyId."', '".$this->shiftName."','" . date('Y-m-d')." ".$this->shiftStart. "','" . date('Y-m-d')." ".$this->shiftEnd. "','" . date('Y-m-d')." ".$this->breakStart. "','" . date('Y-m-d')." ".$this->breakEnd. "','" . date('Y-m-d')." ".$this->entryAllowence. "','" . date('Y-m-d')." ".$this->breakAllowence. "','". date('Y-m-d H:i:s')."')";
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
        $query="SELECT * FROM `tbl_shift` WHERE `tbl_shift`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";

        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $time =strtotime( $row['start_time']);
            $row['start_time'] = date('H:i:s',$time);
            $time =strtotime( $row['end_time']);
            $row['end_time'] = date('H:i:s',$time);
            $time =strtotime( $row['break_start']);
            $row['break_start'] = date('H:i:s',$time);
            $time =strtotime( $row['break_end']);
            $row['break_end'] = date('H:i:s',$time);
            $time =strtotime( $row['in_allow_time']);
            $row['in_allow_time'] = date('H:i:s',$time);
            $time =strtotime( $row['break_allow_time']);
            $row['break_allow_time'] = date('H:i:s',$time);
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function show($id=''){
        $this->id=$id;
        $query="SELECT * FROM `tbl_shift` where `tbl_shift`.`id`=".$this->id;

        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        $time =strtotime( $row['start_time']);
        $row['start_time'] = date('H:i:s',$time);
        $time =strtotime( $row['end_time']);
        $row['end_time'] = date('H:i:s',$time);
        $time =strtotime( $row['break_start']);
        $row['break_start'] = date('H:i:s',$time);
        $time =strtotime( $row['break_end']);
        $row['break_end'] = date('H:i:s',$time);
        $time =strtotime( $row['in_allow_time']);
        $row['in_allow_time'] = date('H:i:s',$time);
        $time =strtotime( $row['break_allow_time']);
        $row['break_allow_time'] = date('H:i:s',$time);
        return $row;
    }

    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_shift` SET `shift_name` = '".$this->shiftName."',`start_time`='" . date('Y-m-d')." ".$this->shiftStart."',`end_time`='" . date('Y-m-d')." ".$this->shiftEnd."',`break_start`='" . date('Y-m-d')." ".$this->breakStart."',`break_end`='" . date('Y-m-d')." ".$this->breakEnd."',`in_allow_time`='" . date('Y-m-d')." ".$this->entryAllowence."',`break_allow_time`='" . date('Y-m-d')." ".$this->breakAllowence."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_shift`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }
    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_shift` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_shift`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

        header('location:index.php');
    }
}