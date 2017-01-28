<?php

namespace App\Attendense\AttendenseEntry;

use App\dbConnection;
//include_once '../../../dbConnection.php';
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-07
 * Time: 11:48 AM
 */
class AttendenseEntry
{
    public $id = '';
    public $companyId = '';
    public $attId = '';
    public $cardId = '';
    public $employeeId = '';
    public $employeeName = '';
    public $date = '';
    public $dutyLocation = '';
    public $inTime = '';
    public $outTime = '';
    public $inTimeCheck = '';
    public $outTimeCheck = '';
    public $remarks = '';
    public $approvedBy = '';
    public $approvedDate = '';
    public $from = '';
    public $to = '';
    public $dates = '';

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
        if (array_key_exists('attId', $data)) {
            $this->attId = $data['attId'];
        }
        if (array_key_exists('cardId', $data)) {
            $this->cardId = $data['cardId'];
        }
        if (array_key_exists('employeeId', $data)) {
            $this->employeeId = $data['employeeId'];
        }
        if (array_key_exists('employeeName', $data)) {
            $this->employeeName = $data['employeeName'];
        }
        if (array_key_exists('date', $data)) {
            $this->date = $data['date'];
        }
        if (array_key_exists('dutyLocation', $data)) {
            $this->dutyLocation = $data['dutyLocation'];
        }
        if (array_key_exists('inTime', $data)) {
            $this->inTime = $data['inTime'];
        }
        if (array_key_exists('outTime', $data)) {
            $this->outTime = $data['outTime'];
        }
        if (array_key_exists('inTimeCheck', $data)) {
            $this->inTimeCheck = $data['inTimeCheck'];
        }
        if (array_key_exists('outTimeCheck', $data)) {
            $this->outTimeCheck = $data['outTimeCheck'];
        }
        if (array_key_exists('remarks', $data)) {
            $this->remarks = $data['remarks'];
        }
        if (array_key_exists('approvedBy', $data)) {
            $this->approvedBy = $data['approvedBy'];
        }
        if (array_key_exists('approvedDate', $data)) {
            $this->approvedDate = $data['approvedDate'];
        }
        if (array_key_exists('from', $data)) {
            $this->from = $data['from'];
        }
        if (array_key_exists('to', $data)) {
            $this->to = $data['to'];
        }
        if (array_key_exists('dates', $data)) {
            $this->dates = $data['dates'];
        }



//        print_r($this);
//
//        die();


    }

    public function store()
    {
        date_default_timezone_set("Asia/Dhaka");
        if (isset($this->inTimeCheck) && !empty($this->inTimeCheck) && isset($this->outTimeCheck) && !empty($this->outTimeCheck)) {

            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`,`att_id`, `cid`,`employee_id`,`employee_name`,`ctime`,`purpose`,`location`,`device_id`,`remarks`,`entry_time`,`is_approved`) VALUES ('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->inTime. "','Entry','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0'),('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->outTime. "','Exit','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendance added for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }

        } elseif (isset($this->inTimeCheck) && !empty($this->inTimeCheck)){
            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`,`att_id`,`cid`, `employee_id`,`employee_name`,`ctime`,`purpose`,`location`,`device_id`,`remarks`,`entry_time`,`is_approved`) VALUES ('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->inTime. "','Entry','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendance added for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }
        } elseif (isset($this->outTimeCheck) && !empty($this->outTimeCheck)){
            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`,`att_id`,`cid`, `employee_id`,`employee_name`,`ctime`,`purpose`,`location`,`device_id`,`remarks`,`entry_time`,`is_approved`) VALUES ('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->outTime. "','Exit','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendance added for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }
        }
        header('location:index.php');
    }

    public function attendanceId(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`employee_id`='".$this->employeeId."' AND `tbl_attendense`.`is_approved`='0' GROUP BY att_id ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`employee_id`='".$this->employeeId."' AND `tbl_attendense`.`att_id`='".$this->attId."' AND `tbl_attendense`.`is_approved`='0' ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function edit(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`employee_id`='".$this->employeeId."' AND `tbl_attendense`.`att_id`='".$this->attId."' AND `tbl_attendense`.`is_approved`='0' ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $time =strtotime( $row['ctime']);
            $row['ctime'] = date('H:i:s',$time);
            $row['date'] = date('Y-m-d',$time);
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function update()
    {
        date_default_timezone_set("Asia/Dhaka");
        $deleteQuery="DELETE FROM `tbl_attendense` where `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`att_id`='".$this->attId."'";
        mysql_query($deleteQuery);
        if (isset($this->inTimeCheck) && !empty($this->inTimeCheck) && isset($this->outTimeCheck) && !empty($this->outTimeCheck)) {

            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`,`att_id`, `cid`,`employee_id`,`employee_name`,`ctime`,`purpose`,`location`,`device_id`,`remarks`,`entry_time`,`is_approved`) VALUES ('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->inTime. "','Entry','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0'),('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->outTime. "','Exit','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendance updated. Please wait for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }

        } elseif (isset($this->inTimeCheck) && !empty($this->inTimeCheck)){
            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`,`att_id`,`cid`, `employee_id`,`employee_name`,`ctime`,`purpose`,`location`,`device_id`,`remarks`,`entry_time`,`is_approved`) VALUES ('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->inTime. "','Entry','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendance updated. Please wait for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }
        } elseif (isset($this->outTimeCheck) && !empty($this->outTimeCheck)){
            $query="INSERT INTO `tbl_attendense` (`id`,`company_id`,`att_id`,`cid`, `employee_id`,`employee_name`,`ctime`,`purpose`,`location`,`device_id`,`remarks`,`entry_time`,`is_approved`) VALUES ('', '" . $this->companyId . "','" . $this->attId . "','" . $this->cardId . "','" . $this->employeeId . "','" . $this->employeeName . "','" . $this->date." ".$this->outTime. "','Exit','" . $this->dutyLocation . "','0','" . $this->remarks . "','" . date('Y-m-d H:i:s') . "','0')";

            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Attendance updated. Please wait for approval";
            } else {
                $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
            }
        }
        header('location:index.php');
    }

    public function pendingId(){
        $mydata=array();
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`is_approved`='0' GROUP BY att_id ORDER BY id DESC";
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
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`att_id`='".$this->attId."' AND `tbl_attendense`.`is_approved`='0' ORDER BY id ASC";
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
        $query="SELECT * FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`is_approved`='1' ORDER BY id DESC";
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
        date_default_timezone_set("Asia/Dhaka");
        $query="SELECT * FROM `tbl_attendense` where `tbl_attendense`.`id`=".$this->id;
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);

        $query1="INSERT INTO `tbl_card` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`ctime`,`device_id`,`purpose`,`remarks`,`entry_time`) VALUES ('','".$row['company_id']."','".$row['cid']."', '".$row['employee_id']."','". $row['employee_name']."','". $row['ctime']."','". $row['device_id']."','". $row['purpose']."','". $row['remarks']."','". $row['entry_time']."')";

        mysql_query($query1);

        $query2 = "UPDATE `tbl_attendense` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . date('Y-m-d H:i:s') . "' WHERE  `tbl_attendense`.`company_id`='".$this->companyId."' AND `tbl_attendense`.`id` =" . $this->id;

        if (mysql_query($query2)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:pendingAttendense.php');
    }

    public function cardId(){
        $query="SELECT * FROM `tbl_employee` where `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id`='".$this->employeeId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function lastEntry(){
        $query="SELECT max(att_id) as att_id FROM `tbl_attendense` WHERE `tbl_attendense`.`company_id` = '".$this->companyId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
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


    public function processData()
    {
        date_default_timezone_set("Asia/Dhaka");
        $allEmployee = array();
        $query="DELETE FROM `tbl_attendense_log` WHERE `tbl_attendense_log`.`date` BETWEEN '".$this->from."' AND '".$this->to."'";
        mysql_query($query);
        $query2="SELECT * FROM `tbl_employee` where `tbl_employee`.`company_id` = '".$this->companyId."' AND deleted_at IS NULL";
        $result2=  mysql_query($query2);
        while ($row1=  mysql_fetch_assoc($result2)){
            $allEmployee[]=$row1;
        }
        foreach ($allEmployee as $oneEmployee){
            foreach ($this->dates as $oneDate) {
                $query3 = "SELECT MIN(ctime) AS min FROM `tbl_card` where `tbl_card`.`company_id` = '" . $this->companyId . "' AND `tbl_card`.`employee_id` = '" . $oneEmployee['employee_id'] . "' AND `tbl_card`.`ctime` BETWEEN '" . $oneDate . " 00:00:00' AND '" . $oneDate . " 23:59:59'";
                $result3 = mysql_query($query3);
                $row2 = mysql_fetch_assoc($result3);
                $inTime = $row2['min'];
                $time = new \DateTime($inTime);
                $inTimeCheck = $time->format('H:i:s');

                $query4 = "SELECT MAX(ctime) AS max FROM `tbl_card` where `tbl_card`.`company_id` = '" . $this->companyId . "' AND `tbl_card`.`employee_id` = '" . $oneEmployee['employee_id'] . "' AND `tbl_card`.`ctime` BETWEEN '" . $oneDate . " 00:00:00' AND '" . $oneDate . " 23:59:59'";
                $result4 = mysql_query($query4);
                $row3 = mysql_fetch_assoc($result4);
                $outTime = $row3['max'];

                $cardData = array();
                $query5 = "SELECT * FROM `tbl_card` where `tbl_card`.`company_id` = '" . $this->companyId . "' AND `tbl_card`.`employee_id` = '" . $oneEmployee['employee_id'] . "' AND `tbl_card`.`ctime` BETWEEN '" . $oneDate . " 00:00:00' AND '" . $oneDate . " 23:59:59' ORDER BY ctime";
                $result5 = mysql_query($query5);
                while ($row4=  mysql_fetch_assoc($result5)){
                    $cardData[]=$row4;
                }
                $duration = 0;
                for ($i=0;$i<count($cardData);$i++){
                    if (isset($cardData[$i+1]['ctime']) && !empty($cardData[$i+1]['ctime'])){
                        if ($i%2==0){
                            $entry = $cardData[$i]['ctime'];
                            $exit = $cardData[$i+1]['ctime'];
                            $to_time = strtotime($exit);
                            $from_time = strtotime($entry);
                            $duration += round(abs($to_time - $from_time));

                        }
                    }
                }
                $query6 = "SELECT in_allow_time,break_allow_time FROM `tbl_shift` where `tbl_shift`.`company_id` = '" . $this->companyId . "' AND `tbl_shift`.`shift_name` = '" . $oneEmployee['shift'] . "'";
                $result6 = mysql_query($query6);
                $row5 = mysql_fetch_assoc($result6);
                $inLate =  $row5['in_allow_time'];

                $time2 = new \DateTime($inLate);
                $inLateCheck = $time2->format('H:i:s');
                if ( !empty($inTimeCheck) && $inTimeCheck<$inLateCheck){
                    $status = 'P';
                } else {
                    $status = 'L';
                }
                unset($remarks);

                $query6 = "SELECT DISTINCT remarks,device_id FROM `tbl_card` where `tbl_card`.`company_id` = '" . $this->companyId . "' AND `tbl_card`.`employee_id` = '" . $oneEmployee['employee_id'] . "' AND `tbl_card`.`ctime` BETWEEN '" . $oneDate . " 00:00:00' AND '" . $oneDate . " 23:59:59' AND remarks IS NOT NULL";
                $result6 = mysql_query($query6);
                $row12 = mysql_fetch_assoc($result6);
                if (!isset($remarks)){
                    if ($row12['device_id']==0){
                        $remarks = $row12['remarks'].'  M';
                    }
                }
                $query8 = "SELECT * FROM `tbl_leave` where `tbl_leave`.`company_id` = '" . $this->companyId . "' AND `tbl_leave`.`employee_id` = '" . $oneEmployee['employee_id'] . "' AND `tbl_leave`.`date`= '" . $oneDate . "'";
                    $result8 = mysql_query($query8);
                    $row7 = mysql_fetch_assoc($result8);
                    if ($row7['h_f']=='First Half' || $row7['h_f']=='Second Half' || $row7['h_f']=='Full Day'){
                        $status = $row7['purpose'];
                            $remarks = $row7['remarks'];

                        if ($row7['h_f']=='First Half'){
                            $inLate2 =  $row5['break_allow_time'];
                            $time3 = new \DateTime($inLate2);
                            $inLateCheck2 = $time3->format('H:i:s');
                            if ($inTimeCheck<$inLateCheck2){
                                $status = 'H1,P';
                            } else{
                                $status = 'H1,L';
                            }
                            if ($row12['device_id']==0){
                                $remarks = $row7['remarks'].'  M';
                            }
                        } else if ($row7['h_f']=='Second Half'){
                            $inLate =  $row5['in_allow_time'];
                            $time2 = new \DateTime($inLate);
                            $inLateCheck = $time2->format('H:i:s');
                            if ($inTimeCheck<$inLateCheck){
                                $status = 'H2,P';
                            } else{
                                $status = 'H2,L';
                            }
                            if ($row12['device_id']==0){
                                $remarks = $row7['remarks'].'  M';
                            }
                        } else if(isset($duration) && !empty($duration)){
                            $inLate =  $row5['in_allow_time'];
                            $time2 = new \DateTime($inLate);
                            $inLateCheck = $time2->format('H:i:s');
                            if ($inTimeCheck<$inLateCheck){
                                $status = $row7['purpose'].',P';
                            } else{
                                $status = $row7['purpose'].',L';
                            }
                            if ($row12['device_id']==0){
                                $remarks = $row7['remarks'].'  M';
                            }
                            $query9="INSERT INTO `tbl_attendense_log` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`department`,`date`,`in_time`,`out_time`,`duration`,`in_late`,`status`,`event_date`,`remarks`) VALUES ('', '" . $oneEmployee['company_id']. "','" . $oneEmployee['card_id'] . "','" . $oneEmployee['employee_id'] . "','" . $oneEmployee['first_name'] . " ".$oneEmployee['last_name']."','" . $oneEmployee['department'] . "','" . $oneDate."','" . $inTime."','" . $outTime."','" . $duration."','" . $inLate."','" . $status . "','" . date('Y-m-d H:i:s') . "','" . $remarks . "')";
                            $result9 = mysql_query($query9);
                            continue;
                        } else {
                            $query13="INSERT INTO `tbl_attendense_log` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`department`,`date`,`event_date`,`status`,`remarks`) VALUES ('', '" . $oneEmployee['company_id']. "','" . $oneEmployee['card_id'] . "','" . $oneEmployee['employee_id'] . "','" . $oneEmployee['first_name'] . " ".$oneEmployee['last_name']."','" . $oneEmployee['department'] . "','" . $oneDate."','" . date('Y-m-d H:i:s') . "','" . $status . "','" . $remarks . "')";
                            $result12 = mysql_query($query13);
                            continue;
                        }

                    } else {
                        $query10 = "SELECT * FROM `tbl_holiday` where `tbl_holiday`.`date`= '" . $oneDate . "' LIMIT 1";
                        $result10 = mysql_query($query10);
                        $row9 = mysql_fetch_assoc($result10);
                        if (!empty($row9) && empty($inTime)){
                            $holidayName = $row9['description'];
                            $query11="INSERT INTO `tbl_attendense_log` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`department`,`date`,`event_date`,`holiday_name`) VALUES ('', '" . $oneEmployee['company_id']. "','" . $oneEmployee['card_id'] . "','" . $oneEmployee['employee_id'] . "','" . $oneEmployee['first_name'] . " ".$oneEmployee['last_name']."','" . $oneEmployee['department'] . "','" . $oneDate."','" . date('Y-m-d H:i:s') . "','" . $holidayName . "')";
                            $result11 = mysql_query($query11);
                            continue;
                        }elseif (!empty($row9) && !empty($inTime)){
                            $holidayName = $row9['description'];
                            $query15="INSERT INTO `tbl_attendense_log` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`department`,`date`,`in_time`,`out_time`,`duration`,`in_late`,`status`,`event_date`,`holiday_name`,`remarks`) VALUES ('', '" . $oneEmployee['company_id']. "','" . $oneEmployee['card_id'] . "','" . $oneEmployee['employee_id'] . "','" . $oneEmployee['first_name'] . " ".$oneEmployee['last_name']."','" . $oneEmployee['department'] . "','" . $oneDate."','" . $inTime."','" . $outTime."','" . $duration."','" . $inLate."','" . $status."','" . date('Y-m-d H:i:s') . "','" . $holidayName . "','" . $remarks . "')";
                            $result15 = mysql_query($query15);
                            continue;
                        } else if (empty($inTime)) {
                            $query12="INSERT INTO `tbl_attendense_log` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`department`,`date`,`event_date`,`status`) VALUES ('', '" . $oneEmployee['company_id']. "','" . $oneEmployee['card_id'] . "','" . $oneEmployee['employee_id'] . "','" . $oneEmployee['first_name'] . " ".$oneEmployee['last_name']."','" . $oneEmployee['department'] . "','" . $oneDate."','" . date('Y-m-d H:i:s') . "','A')";
                            $result12 = mysql_query($query12);
                            continue;
                        }

                    }
//                echo gmdate('H:i:s', $duration).'<br><br>';

                $query7="INSERT INTO `tbl_attendense_log` (`id`,`company_id`,`cid`, `employee_id`,`employee_name`,`department`,`date`,`in_time`,`out_time`,`duration`,`in_late`,`event_date`,`status`,`remarks`) VALUES ('', '" . $oneEmployee['company_id']. "','" . $oneEmployee['card_id'] . "','" . $oneEmployee['employee_id'] . "','" . $oneEmployee['first_name'] . " ".$oneEmployee['last_name']."','" . $oneEmployee['department']. "','" . $oneDate."','" . $inTime."', '".$outTime. "','".$duration. "','" . $inLate . "','" . date('Y-m-d H:i:s') . "','" . $status . "','" . $remarks . "')";

                if (mysql_query($query7)) {
                    $_SESSION['successMessage'] = "All Data Processed.";
                } else {
                    $_SESSION['errorMessage'] = "Oops!!! Something wrong!";
                }
            }
        }
        header('location:processAttendenseForm.php');
    }



}