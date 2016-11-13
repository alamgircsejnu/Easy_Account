<?php
namespace App\ProjectTracking\CreateProject;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-12
 * Time: 10:12 AM
 */
class ProjectTracking
{


    public $id = '';
    public $projectId = '';
    public $projectName = '';
    public $customerName = '';


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
        if (array_key_exists('projectId', $data)) {
            $this->projectId = $data['projectId'];
        }
        if (array_key_exists('projectName', $data)) {
            $this->projectName = $data['projectName'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('lastName', $data)) {
            $this->lastName = $data['lastName'];
        }
        if (array_key_exists('createdBy', $data)) {
            $this->createdBy = $data['createdBy'];
        }

//        print_r($this);
//
//        die();


    }


    public function store(){
        if(isset($this->projectId) && !empty($this->projectId)){
            $query="INSERT INTO `tbl_project` (`id`, `project_id`,`project_name`,`customer_name`,`created_by`,`created_at`) VALUES ('', '".$this->projectId."','". $this->projectName."','". $this->customerName."','". $this->createdBy."','". date('Y-m-d')."')";
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
        $query="SELECT * FROM `tbl_project` where deleted_at IS NULL";
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
        $query = "UPDATE `tbl_project` SET `project_id` = '" . $this->projectId . "',`project_name`='" . $this->projectName . "',`customer_name`='" . $this->customerName . "' WHERE `tbl_project`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {

        $_SESSION['successMessage'] = "<h2>" . "Data Updated Successfully" . "</h2>";
        }
        header('location:index.php');
    }

    public function trash()
    {

        $query = "UPDATE `tbl_project` SET `deleted_at` = '" . date('Y-m-d') . "' WHERE `tbl_project`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "<h2>" . "Deleted Successfully" . "</h2>";
        } else {
            $_SESSION['errorMessage'] = "<h2>Oops! Something wrong to delete data!</h2>";
        }

        header('location:index.php');
    }


    public function lastEntry(){
        $query="SELECT * FROM `tbl_project` ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }




}