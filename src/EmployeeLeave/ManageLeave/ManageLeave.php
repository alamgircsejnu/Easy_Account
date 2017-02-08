<?php
namespace App\EmployeeLeave\ManageLeave;
use App\dbConnection;


class ManageLeave
{
    public $id = '';
    public $companyId = '';
    public $from = '';
    public $to = '';
    public $totalDays = '';
    public $dates = '';
    public $leaveType = '';
    public $h_f = '';
    public $eContact = '';
    public $remarks = '';
    public $referenceNo = '';
    public $employeeId = '';
    public $employeeName = '';
    public $approvedBy = '';
    public $approvedDate = '';


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
        if (array_key_exists('employeeId', $data)) {
            $this->employeeId = $data['employeeId'];
        }
        if (array_key_exists('employeeName', $data)) {
            $this->employeeName = $data['employeeName'];
        }
        if (array_key_exists('from', $data)) {
            $this->from = $data['from'];
        }
        if (array_key_exists('to', $data)) {
            $this->to = $data['to'];
        }
        if (array_key_exists('totalDays', $data)) {
            $this->totalDays = $data['totalDays'];
        }
        if (array_key_exists('dates', $data)) {
            $this->dates = $data['dates'];
        }
        if (array_key_exists('leaveType', $data)) {
            $this->leaveType = $data['leaveType'];
        }
        if (array_key_exists('h_f', $data)) {
            $this->h_f = $data['h_f'];
        }
        if (array_key_exists('eContact', $data)) {
            $this->eContact = $data['eContact'];
        }
        if (array_key_exists('remarks', $data)) {
            $this->remarks = $data['remarks'];
        }
        if (array_key_exists('referenceNo', $data)) {
            $this->referenceNo = $data['referenceNo'];
        }
        if (array_key_exists('approvedBy', $data)) {
            $this->approvedBy = $data['approvedBy'];
        }
        if (array_key_exists('approvedDate', $data)) {
            $this->approvedDate = $data['approvedDate'];
        }


//        print_r($this);
//
//        die();


    }

    public function store()
    {
        if (isset($this->dates) && !empty($this->dates)) {
            $query = "INSERT INTO `tbl_leave` (`id`,`company_id`,`employee_id`,`employee_name`, `date`,`h_f`,`purpose`,`ref`,`econtact`,`remarks`,`is_approved`,`created_at`) VALUES ";

            for ($i = 0; $i < count($this->dates); $i++) {
                $query = $query . "('','" . $this->companyId . "','" . $this->employeeId . "','" . $this->employeeName . "', '" . $this->dates[$i] . "','" . $this->h_f . "','" . $this->leaveType . "','" . $this->referenceNo . "','" . $this->eContact . "','" . $this->remarks . "','0','" . date('Y-m-d') . "'),";
            }
            $query2 = rtrim($query, ",");

            if (mysql_query($query2)) {
                $_SESSION['successMessage'] = "Successfully Added";
            } else {
                $_SESSION['errorMessage'] = "There is no holiday in this date range!";
            }

        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_leave` WHERE `tbl_leave`.`company_id`='".$this->companyId."' AND `tbl_leave`.`employee_id`='".$this->employeeId."' AND `tbl_leave`.`is_approved`='0' ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function pendingRequests(){
        $mydata=array();
        $query="SELECT * FROM `tbl_leave` WHERE `tbl_leave`.`company_id`='".$this->companyId."' AND `tbl_leave`.`is_approved`='0' ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function approvedRequests(){
        $mydata=array();
        $query="SELECT * FROM `tbl_leave` WHERE `tbl_leave`.`company_id`='".$this->companyId."' AND `tbl_leave`.`employee_id`='".$this->employeeId."' AND `tbl_leave`.`is_approved`='1' ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function approve()
    {

        $query = "UPDATE `tbl_leave` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . $this->approvedDate . "' WHERE `tbl_leave`.`id` =" . $this->id;

        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:pendingLeave.php');
    }

    public function delete()
    {

        $query = "DELETE FROM `tbl_leave` WHERE `tbl_leave`.`id` =" . $this->id;

        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

        header('location:index.php');
    }

    function createDateRangeArray($strDateFrom,$strDateTo)
    {
        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }

}