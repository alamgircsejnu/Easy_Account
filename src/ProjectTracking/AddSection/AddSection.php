<?php
namespace App\ProjectTracking\AddSection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-12
 * Time: 2:06 PM
 */
class AddSection
{

    public $id = '';
    public $projectId = '';
    public $sectionId = '';
    public $sectionDescription = '';
    public $assignedTo = '';
    public $assignedDate = '';
    public $primaryEstimatedDate = '';
    public $estimatedDate = '';
    public $estimatedDays = '';
    public $latestEstimatedDays = '';


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
        if (array_key_exists('sectionId', $data)) {
            $this->sectionId = $data['sectionId'];
        }
        if (array_key_exists('sectionDescription', $data)) {
            $this->sectionDescription = $data['sectionDescription'];
        }
        if (array_key_exists('assignedTo', $data)) {
            $this->assignedTo = $data['assignedTo'];
        }
        if (array_key_exists('assignedDate', $data)) {
            $this->assignedDate = $data['assignedDate'];
        }
        if (array_key_exists('primaryEstimatedDate', $data)) {
            $this->primaryEstimatedDate = $data['primaryEstimatedDate'];
        }
        if (array_key_exists('estimatedDate', $data)) {
            $this->estimatedDate = $data['estimatedDate'];
        }
        if (array_key_exists('estimatedDays', $data)) {
        $this->estimatedDays = $data['estimatedDays'];
    }
        if (array_key_exists('latestEstimatedDays', $data)) {
            $this->latestEstimatedDays = $data['latestEstimatedDays'];
        }


//        print_r($this);
//
//        die();


    }


    public function store(){
        if(isset($this->projectId) && !empty($this->projectId)){
            $query="INSERT INTO `tbl_project_detail` (`id`, `project_id`,`section_id`,`section_description`,`assigned_to`,`assigned_date`,`primary_est_date`,`est_date`,`est_days`,`latest_est_days`,`created_at`) VALUES ('', '".$this->projectId."','". $this->sectionId."','". $this->sectionDescription."','". $this->assignedTo."','". $this->assignedDate."','". $this->primaryEstimatedDate."','". $this->primaryEstimatedDate."','". $this->estimatedDays."','". $this->estimatedDays."','". date('Y-m-d')."')";
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
        $query="SELECT * FROM `tbl_project_detail` where deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_project_detail` where id=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update()
    {
        $query = "UPDATE `tbl_project_detail` SET `project_id` = '" . $this->projectId . "',`section_id`='" . $this->sectionId . "',`assigned_to`='" . $this->assignedTo . "',`assigned_date`='" . $this->assignedDate . "',`section_description`='" . $this->sectionDescription . "',`primary_est_date`='" . $this->primaryEstimatedDate . "',`est_date`='" . $this->primaryEstimatedDate . "',`est_days`='" . $this->estimatedDays . "',`latest_est_days`='" . $this->estimatedDays . "' WHERE `tbl_project_detail`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {

            $_SESSION['successMessage'] = "<h2>" . "Data Updated Successfully" . "</h2>";
        }
        header('location:index.php');
    }

    public function trash()
    {

        $query = "UPDATE `tbl_project_detail` SET `deleted_at` = '" . date('Y-m-d') . "' WHERE `tbl_project_detail`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "<h2>" . "Deleted Successfully" . "</h2>";
        } else {
            $_SESSION['errorMessage'] = "<h2>Oops! Something wrong to delete data!</h2>";
        }

        header('location:index.php');
    }

    public function lastEntry($taskId=''){
        $query="SELECT * FROM `tbl_project_detail` WHERE `project_id`=$taskId ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }


}