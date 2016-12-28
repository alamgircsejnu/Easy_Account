<?php
namespace App\ProjectTracking\TaskExecution;
use App\dbConnection;
//session_start();

class TaskExecution
{
    public $id = '';
    public $companyId = '';
    public $projectId = '';
    public $sectionId = '';
    public $previousEstDate = '';
    public $latestEstDate = '';
    public $latestEstDays = '';
    public $hourWorkedToday = '';
    public $doneBy = '';
    public $priorities = '';
    public $assignedTo = '';

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
        if (array_key_exists('previousEstDate', $data)) {
            $this->previousEstDate = $data['previousEstDate'];
        }
        if (array_key_exists('latestEstDate', $data)) {
            $this->latestEstDate = $data['latestEstDate'];
        }
        if (array_key_exists('latestEstDays', $data)) {
            $this->latestEstDays = $data['latestEstDays'];
        }
        if (array_key_exists('hourWorkedToday', $data)) {
        $this->hourWorkedToday = $data['hourWorkedToday'];
    }
        if (array_key_exists('doneBy', $data)) {
            $this->doneBy = $data['doneBy'];
        }
        if (array_key_exists('priority', $data)) {
            $this->priorities = $data['priority'];
        }
        if (array_key_exists('assignedTo', $data)) {
            $this->assignedTo = $data['assignedTo'];
        }

//        print_r($this);
//
//        die();


    }


    public function store(){
        if(isset($this->projectId) && !empty($this->projectId)){
            $query="INSERT INTO `tbl_project_track` (`id`,`company_id`, `project_id`,`section_id`,`done_by`,`work_hour`,`created_at`) VALUES ('','".$this->companyId."', '".$this->projectId."','". $this->sectionId."','". $this->doneBy."','". $this->hourWorkedToday."','". date('Y-m-d')."')";
            $sql = "UPDATE `tbl_project_detail` SET `est_date` = '" . $this->latestEstDate . "',`latest_est_days`='" . $this->latestEstDays . "' WHERE `tbl_project_detail`.`id` =" . $this->id;
//            echo $sql;
//            die();

            if(mysql_query($sql) && mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }  else {
                $_SESSION['errorMessage']="Failed to add";
            }
        }  else {
            $_SESSION['errorMessage']="Fill All the Field";

        }
        header('location:../../../../index.php');
    }

    public function pendingTask(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where deleted_at IS NULL AND `assigned_to`='".$_SESSION['employeeName']."' AND `company_id`='".$this->companyId."' AND finished_at IS NULL ORDER BY priority";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function taskReport(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where `tbl_project_detail`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function show($id=''){
//        $this->id=$id;
        $query='SELECT * FROM `tbl_project_detail` where `tbl_project_detail`.`id`='.$id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function projectReport(){
        $mydata=array();
//        $query="SELECT * FROM `tbl_project_detail` AS d,`tbl_project_track` AS t WHERE t.`project_id`='".$projectId."' AND d.`project_id`='".$projectId."' GROUP BY t.section_id";
        $query = "SELECT * FROM `tbl_project_track` where `company_id`='".$this->companyId."' AND `project_id`='".$this->projectId."' AND `section_id`='".$this->sectionId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function projectCompletionDate(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where deleted_at IS NULL AND `company_id`='".$this->companyId."' AND `project_id`='".$this->projectId."' AND `section_id`='".$this->sectionId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }


    public function ganttChart(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where `company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY assigned_to,priority";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function personalProjects(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_detail` where `tbl_project_detail`.`company_id`='".$this->companyId."' AND `assigned_to`='".$this->assignedTo."' AND finished_at IS NULL ORDER BY priority";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function findAssignedDate($employeeName=''){

        $query="SELECT * FROM `tbl_project_detail` where `company_id`='".$this->companyId."' AND `tbl_project_detail`.`assigned_to`='".$employeeName."' ORDER BY assigned_date ASC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function workingDateNumber($sectionId=''){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_track` where `company_id`='".$this->companyId."' AND `tbl_project_track`.`section_id`='".$sectionId."' AND `tbl_project_track`.`work_hour`!=0";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function employee(){
        $mydata=array();
        $query="SELECT DISTINCT assigned_to FROM `tbl_project_detail` WHERE `company_id`='".$this->companyId."'" ;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function updatePriority(){

            $str1 = 'UPDATE tbl_project_detail SET priority = CASE id ';
            $str3 = "ELSE priority END WHERE assigned_to = '".$this->assignedTo."'";
            $str2 = '';
            for($i=0;$i<count($this->id);$i++){
                $str2 .= 'WHEN '.$this->id[$i].' THEN '.$this->priorities[$i].' ';
            }
            $query2 = $str1.$str2.$str3;
            if(mysql_query($query2)){
                $_SESSION['successMessage']="Successfully updated";
            }
        header('location:employeeEngagementReport.php');
        }


    public function workingReportData($workingEmployee = ''){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_track` where `company_id`='".$this->companyId."' AND `tbl_project_track`.`done_by`='".$workingEmployee."' AND `tbl_project_track`.`work_hour`!=0";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function workingEmployee(){
        $mydata=array();
        $query="SELECT DISTINCT done_by FROM `tbl_project_track` WHERE `company_id`='".$this->companyId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function startDate($section_id){
        $query="SELECT * FROM `tbl_project_track` WHERE `company_id`='".$this->companyId."' AND `tbl_project_track`.`section_id`= '".$section_id."' ORDER BY created_at ASC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function daysWorked($section_id){
        $mydata=array();
        $query="SELECT * FROM `tbl_project_track` WHERE `company_id`='".$this->companyId."' AND `tbl_project_track`.`section_id`= '".$section_id."' AND `work_hour`!=0";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

}