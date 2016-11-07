<?php
namespace App\Users\Role;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-07
 * Time: 12:18 PM
 */
class Role
{
    public $id = '';
    public $userRole = '';


    public function __construct()
    {
        $conn = mysql_connect('localhost', 'root', 'acs_bl2016') or die("Server Not Found");
        mysql_select_db('easy_accounts') or die("Database Not Found");
    }

    public function prepare($data = '')
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists('userRole', $data)) {
            $this->userRole = $data['userRole'];
        }
//        print_r($this);
//
//        die();

    }

    public function store(){
        if(isset($this->userRole) && !empty($this->userRole)){
            $query="INSERT INTO `tbl_user_role` (`id`, `user_role`,`created_at`) VALUES ('', '".$this->userRole."','". date('Y-m-d')."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }  else {
                $_SESSION['errorMessage']="Failed to add";
            }
        }  else {
            $_SESSION['errorMessage']="Fill the Field";

        }
        header('location:create.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_user_role` where deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function delete(){

        $query="DELETE FROM `tbl_user_role` WHERE `tbl_user_role`.`id` =".$this->id;
        if(mysql_query($query)){
            $_SESSION['successMessage']="<h2>"."This role has permanently deleted"."</h2>";
        }  else {
            $_SESSION['errorMessage']="<h2>"."Something Wrong to delete data"."</h2>";
        }
        header('location:index.php');
    }




}