<?php
namespace App\Users\ManageUser;

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
    public $userName='';
    public $userType='';
    public $password='';
    public $permittedActions='';
    public $employeeId='';
    public $newPassword='';

    public function __construct() {
        $conn=  mysql_connect('localhost','root','acs_bl2016')or die("Server Not Found");
        mysql_select_db('easy_accounts') or die("Database Not Found");
    }

    public function prepare($data=''){
        if(array_key_exists('id', $data)){
            $this->id=$data['id'];
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
        if(array_key_exists('newPassword', $data)){
            $this->newPassword=$data['newPassword'];
        }

//        print_r($this);
//
//        die();



    }
    public function store(){
        if(isset($this->userName) && !empty($this->userName) && isset($this->userType) && !empty($this->userType) && isset($this->password) && !empty($this->password)){
            $query="INSERT INTO `tbl_user` (`id`,`user_name`,`user_type`,`password`,`permitted_actions`,`created_at`) VALUES ('','". $this->userName."','". $this->userType."','". $this->password."','". $this->permittedActions."','". date('Y-m-d')."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }  else {
                $_SESSION['errorMessage']="Failed to add the user";
            }
        }  else {
            $_SESSION['errorMessage']="Fill All the Field";

        }
        header('location:index.php');
    }


    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_user` where deleted_at IS NULL";
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
        $query="UPDATE `tbl_user` SET `user_name`='".$this->userName."',`user_type`='".$this->userType."',`permitted_actions`='".$this->permittedActions."' WHERE `tbl_user`.`id` =". $this->id;
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
            $_SESSION['successMessage'] = "<h2>" . "Deleted Successfully" . "</h2>";
        } else {
            $_SESSION['errorMessage'] = "<h2>Oops! Something wrong to delete data!</h2>";
        }

        header('location:index.php');
    }
        public function trashed(){
            $mydata=array();
            $query="SELECT * FROM `tbl_user` WHERE deleted_at IS NOT NULL";
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
            $_SESSION['successMessage'] = "<h2>" . "Restored Successfully" . "</h2>";
        } else {
            $_SESSION['errorMessage'] = "<h2>Oops! Something Wrong to Restore Data!</h2>";
        }

        header('location:trashed.php');
    }

    public function delete(){

        $query="DELETE FROM `tbl_user` WHERE `tbl_user`.`id` =".$this->id;
        if(mysql_query($query)){
            $_SESSION['successMessage']="<h2>"."This user has permanently deleted"."</h2>";
        }  else {
            $_SESSION['errorMessage']="<h2>"."Something Wrong to delete data"."</h2>";
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
        $_SESSION['successMessage']="Password Reset Successfull";
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


}