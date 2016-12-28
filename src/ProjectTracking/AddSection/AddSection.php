<?php
namespace App\ProjectTracking\AddSection;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-12
 * Time: 2:06 PM
 */
class AddSection
{

    public $id = '';
    public $companyId = '';
    public $projectId = '';
    public $sectionId = '';
    public $sectionDescription = '';
    public $assignedTo = '';
    public $assignedDate = '';
    public $primaryEstimatedDate = '';
    public $estimatedDate = '';
    public $estimatedDays = '';
    public $latestEstimatedDays = '';
    public $priorityOfNewSection = '';
    public $priorities = '';
    public $assignedBy = '';


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
        if (array_key_exists('priorityOfNewSection', $data)) {
            $this->priorityOfNewSection = $data['priorityOfNewSection'];
        }
        if (array_key_exists('priority', $data)) {
            $this->priorities = $data['priority'];
        }
        if (array_key_exists('assignedBy', $data)) {
            $this->assignedBy = $data['assignedBy'];
        }

    }


    public function store(){
        if(isset($this->projectId) && !empty($this->projectId)){
            $query="INSERT INTO `tbl_project_detail` (`id`,`company_id`, `project_id`,`section_id`,`section_description`,`assigned_to`,`assigned_date`,`primary_est_date`,`est_date`,`est_days`,`latest_est_days`,`priority`,`assigned_by`,`created_at`) VALUES ('', '".$this->companyId."','".$this->projectId."','". $this->sectionId."','". $this->sectionDescription."','". $this->assignedTo."','". $this->assignedDate."','". $this->primaryEstimatedDate."','". $this->primaryEstimatedDate."','". $this->estimatedDays."','". $this->estimatedDays."','". $this->priorityOfNewSection."','". $this->assignedBy."','". date('Y-m-d')."')";

        $str1 = 'UPDATE tbl_project_detail SET priority = CASE id ';
        $str3 = "ELSE priority END WHERE assigned_to = '".$this->assignedTo."'";
            $str2 = '';
            for($i=0;$i<count($this->id);$i++){
                $str2 .= 'WHEN '.$this->id[$i].' THEN '.$this->priorities[$i].' ';
            }
            $query2 = $str1.$str2.$str3;

            if(mysql_query($query) && mysql_query($query2)){
                $_SESSION['successMessage']="Successfully Added";
            }
        }  else {
            $_SESSION['errorMessage']="Fill All the Field";

        }
        header('location:index.php');
    }


    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where `tbl_project_detail`.`company_id`='".$this->companyId."' AND finished_at IS NULL";
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

        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function update()
    {
        $query = "UPDATE `tbl_project_detail` SET `project_id` = '" . $this->projectId . "',`section_id`='" . $this->sectionId . "',`assigned_to`='" . $this->assignedTo . "',`assigned_date`='" . $this->assignedDate . "',`section_description`='" . $this->sectionDescription . "',`primary_est_date`='" . $this->primaryEstimatedDate . "',`est_date`='" . $this->primaryEstimatedDate . "',`est_days`='" . $this->estimatedDays . "',`latest_est_days`='" . $this->estimatedDays . "' WHERE `tbl_project_detail`.`id` =" . $this->id;

        if (mysql_query($query)) {

            $_SESSION['successMessage'] = "Data Updated Successfully";
        }
        header('location:index.php');
    }

    public function trash()
    {

        $query = "DELETE FROM `tbl_project_detail` WHERE `tbl_project_detail`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

        header('location:index.php');
    }

    public function lastEntry($taskId=''){
        $query="SELECT * FROM `tbl_project_detail` WHERE `tbl_project_detail`.`company_id`='".$this->companyId."' AND `tbl_project_detail`.`project_id`='".$taskId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function finishedSections(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where`tbl_project_detail`.`company_id`='".$this->companyId."' AND finished_at IS NOT NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function finish()
    {

        $query = "UPDATE `tbl_project_detail` SET `finished_at` = '" . date('Y-m-d') . "' WHERE `tbl_project_detail`.`id` =" . $this->id;
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Finished Successfully";
        }
        header('location:index.php');
    }




}