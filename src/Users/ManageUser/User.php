<?php
namespace App\Users\ManageUser;
use App\dbConnection;

//session_start();
/**
 * Created by PhpStorm.
 * Users: ASUS
 * Date: 2016-11-05
 * Time: 12:53 PM
 */
class User
{
    public $id='';
    public $companyId='';
    public $userName='';
    public $userType='';
    public $password='';
    public $permittedActions='';
    public $permittedCompanies='';
    public $employeeId='';
    public $newPassword='';

    public function __construct()
    {
        $conn = new dbConnection();
        $connection = $conn->connect();
    }

    public function prepare($data=''){
        if(array_key_exists('id', $data)){
            $this->id=$data['id'];
        }
        if(array_key_exists('companyId', $data)){
            $this->companyId=$data['companyId'];
        }
        if(array_key_exists('userName', $data)){
            $this->userName=$data['userName'];
        }
        if(array_key_exists('userType', $data)){
            $this->userType=$data['userType'];
        }
        if(array_key_exists('password', $data)){
            $this->password=$data['password'];
        }
        if(array_key_exists('permittedActions', $data)){
            $this->permittedActions=$data['permittedActions'];
        }
        if(array_key_exists('permittedCompanies', $data)){
            $this->permittedCompanies=$data['permittedCompanies'];
        }
        if(array_key_exists('newPassword', $data)){
            $this->newPassword=$data['newPassword'];
        }
        if(array_key_exists('employeeId', $data)){
            $this->employeeId=$data['employeeId'];
        }

//        print_r($this);
//
//        die();



    }
    public function store(){
        if(isset($this->userName) && !empty($this->userName) && isset($this->userType) && !empty($this->userType) && isset($this->password) && !empty($this->password)){
            $query="INSERT INTO `tbl_user` (`id`,`company_id`,`user_name`,`user_type`,`password`,`permitted_actions`,`permitted_companies`,`created_at`) VALUES ('','". $this->companyId."','". $this->userName."','". $this->userType."','". $this->password."','". $this->permittedActions."','". $this->permittedCompanies."','". date('Y-m-d')."')";
            mysql_query($query);
            $query1="UPDATE `tbl_employee` SET `tbl_employee`.`is_user`='1' WHERE `tbl_employee`.`company_id` ='".$this->companyId."' AND `tbl_employee`.`employee_id` ='".$this->userName."'";
            if(mysql_query($query1)){
                $_SESSION['successMessage']="Successfully Added";
            }  else {
                $_SESSION['errorMessage']="This user already exists.";
            }
        }  else {
            $_SESSION['errorMessage']="Fill All the Field";

        }
        header('location:index.php');
    }


    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_user` where `tbl_user`.`company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY user_name";
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
        $query="SELECT * FROM `tbl_user` where id=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    /**
     *
     */
    public function update(){
        $query="UPDATE `tbl_user` SET `user_name`='".$this->userName."',`user_type`='".$this->userType."',`permitted_actions`='".$this->permittedActions."',`permitted_companies`='".$this->permittedCompanies."' WHERE `tbl_user`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="<h2>"."Data Updated Successfully"."</h2>";
        header('location:index.php');
    }

    public function trash()
    {

        $query = "UPDATE `tbl_user` SET `deleted_at` = '" . date('Y-m-d') . "' WHERE `tbl_user`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

        header('location:index.php');
    }
        public function trashed(){
            $mydata=array();
            $query="SELECT * FROM `tbl_user` WHERE `tbl_user`.`company_id`='".$this->companyId."' AND deleted_at IS NOT NULL";
//        echo $query;
//        die();
            $result=  mysql_query($query);
            while ($row=  mysql_fetch_assoc($result)){
                $mydata[]=$row;
            }
            return $mydata;
            header('location:trashed.php');
        }

    public function restore()
    {

        $query = "UPDATE `tbl_user` SET `deleted_at` = NULL WHERE `tbl_user`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Restored Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something Wrong to Restore Data!";
        }

        header('location:trashed.php');
    }

    public function delete(){

        $query="DELETE FROM `tbl_user` WHERE `tbl_user`.`id` =".$this->id;
        if(mysql_query($query)){
            $_SESSION['successMessage']="This user has permanently deleted";
        }  else {
            $_SESSION['errorMessage']="Something Wrong to delete data";
        }
        header('location:trashed.php');
    }


    public function login() {
        $query = "SELECT * FROM `tbl_user` WHERE `user_name`='$this->userName'";
//        echo $query;
//        die();
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        return $row;
    }


    public function findUser($employeeId=''){
        $this->employeeId=$employeeId;
        $query="SELECT * FROM `tbl_user` where user_name=".$this->employeeId;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function resetPassword($employeeId=''){
        $this->employeeId=$employeeId;
        $query="UPDATE `tbl_user` SET `password`='".$this->newPassword."' WHERE `tbl_user`.`user_name` =". $this->employeeId;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Password Changed Successfully";
        header('location:../../../../index.php');

    }

    public function employeeInfo() {
        $query = "SELECT * FROM `tbl_employee` WHERE `employee_id`='$this->userName'";
//        echo $query;
//        die();
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        return $row;
    }

    public function allEmployee(){
        $mydata=array();
        $query="SELECT * FROM `tbl_employee` WHERE deleted_at IS NULL ORDER BY employee_id  ";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function employeeCompany(){
        $query="SELECT * FROM `tbl_user` where `tbl_user`.`user_name`='".$this->employeeId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }


}