<?php
namespace App\Voucher\VoucherEntry;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-14
 * Time: 12:45 PM
 */
class VoucherEntry
{
    public $id = '';
    public $companyId = '';
    public $voucherNo = '';
    public $date = '';
    public $expenseType = '';
    public $employeeId = '';
    public $employeeName = '';
    public $designation = '';
    public $entryBy = '';
    public $approvedBy = '';
    public $approvedDate = '';
    public $customerName = '';
    public $projectId = '';
    public $from = '';
    public $to = '';


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
        if (array_key_exists('voucherNo', $data)) {
            $this->voucherNo = $data['voucherNo'];
        }
        if (array_key_exists('date', $data)) {
            $this->date = $data['date'];
        }
        if (array_key_exists('expenseType', $data)) {
            $this->expenseType = $data['expenseType'];
        }
        if (array_key_exists('employeeId', $data)) {
            $this->employeeId = $data['employeeId'];
        }
        if (array_key_exists('employeeName', $data)) {
            $this->employeeName = $data['employeeName'];
        }
        if (array_key_exists('designation', $data)) {
            $this->designation = $data['designation'];
        }
        if (array_key_exists('vendorDue', $data)) {
            $this->supplierDue = $data['vendorDue'];
        }
        if (array_key_exists('entryBy', $data)) {
            $this->entryBy = $data['entryBy'];
        }
        if (array_key_exists('approvedBy', $data)) {
            $this->approvedBy = $data['approvedBy'];
        }
        if (array_key_exists('approvedDate', $data)) {
            $this->approvedDate = $data['approvedDate'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('projectId', $data)) {
            $this->projectId = $data['projectId'];
        }
        if (array_key_exists('from', $data)) {
            $this->from = $data['from'];
        }
        if (array_key_exists('to', $data)) {
            $this->to = $data['to'];
        }

//        print_r($this);
//
//        die();

    }

    public function storeExpenses($data=''){
        date_default_timezone_set("Asia/Dhaka");
//        print_r($data);
//        die();
    if (isset($data['ID1_description']) && !empty($data['ID1_description'])){
        $sl =0;
        $numberOfEntry = (count($data)-12)/6;
//        echo $numberOfEntry;
//        die();
        for ($i=0;$i<$numberOfEntry;$i++){
        $sl++;
        if(isset($data) && !empty($data)){
            $query="INSERT INTO `tbl_voucher` (`id`, `company_id`,`voucher_no`,`date`,`expense_type`,`employee_id`,`employee_name`,`employee_designation`,`customer_name`,`project_id`,`project_name`,`project_description`,`description`,`amount`,`remarks`,`is_approved`,`is_expensed`,`entry_date`,`entry_by`) VALUES ('', '".$data['companyId']."','".$data['voucherNo']."','".$data['date']."','".$data['expenseType']."','".$data['employeeId']."','".$data['employeeName']."','".$data['designation']."','".$data['customerName']."','".$data['projectId']."','".$data['projectName']."','".$data['projectDescription']."','".$data["ID".$sl."_description"]."','". $data["ID".$sl."_amount"]."','". $data["ID".$sl."_remark"]."','0','0','". date('Y-m-d H:i:s')."','". $data["entryBy"]."')";
//            echo $query;
//            die();
            if (mysql_query($query)) {
                $_SESSION['successMessage'] = "Voucher Added Successfully";
            } else {
                $_SESSION['errorMessage'] = "Oops! Something wrong!";
            }

        }
    }
//    die();
} else{
        $sl =0;
        $numberOfEntry = (count($data)-12)/6;
//echo $numberOfEntry;
//    die();
        for ($i=0;$i<$numberOfEntry;$i++){
            $sl++;
            if(isset($data) && !empty($data)){
                $query="INSERT INTO `tbl_voucher` (`id`, `company_id`,`voucher_no`,`date`,`expense_type`,`employee_id`,`employee_name`,`employee_designation`,`customer_name`,`project_id`,`project_name`,`project_description`,`from_place`,`to_place`,`vehicle`,`amount`,`remarks`,`is_approved`,`is_expensed`,`entry_date`,`entry_by`) VALUES ('', '".$data['companyId']."','".$data['voucherNo']."','".$data['date']."','".$data['expenseType']."','".$data['employeeId']."','".$data['employeeName']."','".$data['designation']."','".$data['customerName']."','".$data['projectId']."','".$data['projectName']."','".$data['projectDescription']."','". $data["ID".$sl."_from"]."','". $data["ID".$sl."_to"]."','". $data["ID".$sl."_vehicle"]."','". $data["ID".$sl."_amount"]."','". $data["ID".$sl."_remark"]."','0','0','". date('Y-m-d H:i:s')."','". $data["entryBy"]."')";
//            echo $query;
//            die();
                if (mysql_query($query)) {
                    $_SESSION['successMessage'] = "Voucher Added Successfully";
                } else {
                    $_SESSION['errorMessage'] = "Oops! Something wrong!";
                }

            }
        }
}
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`employee_id`='".$this->employeeId."' AND `tbl_voucher`.`is_approved`='0' AND deleted_at IS NULL GROUP BY voucher_no";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }
    public function show(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` where `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no`='".$this->voucherNo."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function updateExpenses($data=''){
        date_default_timezone_set("Asia/Dhaka");
//        print_r($data);
//        die();
        $deleteQuery="DELETE FROM `tbl_voucher` where `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no`='".$this->voucherNo."'";
        mysql_query($deleteQuery);
//        die();
        if (isset($_POST['ID1_description']) && !empty($_POST['ID1_description'])){
            $sl =0;
            $numberOfEntry = (count($data)-12)/3;
//    echo $numberOfEntry;
//    die();
            for ($i=0;$i<$numberOfEntry;$i++){
                $sl++;
                if(isset($data) && !empty($data)){
                    $query="INSERT INTO `tbl_voucher` (`id`, `company_id`,`voucher_no`,`date`,`expense_type`,`employee_id`,`employee_name`,`employee_designation`,`customer_name`,`project_id`,`project_name`,`project_description`,`description`,`amount`,`remarks`,`is_approved`,`is_expensed`,`entry_date`,`entry_by`) VALUES ('', '".$data['companyId']."','".$data['voucherNo']."','".$data['date']."','".$data['expenseType']."','".$data['employeeId']."','".$data['employeeName']."','".$data['designation']."','".$data['customerName']."','".$data['projectId']."','".$data['projectName']."','".$data['projectDescription']."','".$data["ID".$sl."_description"]."','". $data["ID".$sl."_amount"]."','". $data["ID".$sl."_remark"]."','0','0','". date('Y-m-d H:i:s')."','". $data["entryBy"]."')";
//            echo $query;
//            die();
                    if (mysql_query($query)) {
                        $_SESSION['successMessage'] = "Updated Successfully";
                    } else {
                        $_SESSION['errorMessage'] = "Oops! Something wrong!";
                    }

                }
            }
        } else{
            $sl =0;
            $numberOfEntry = (count($data)-12)/5;
//echo $numberOfEntry;
//    die();
            for ($i=0;$i<$numberOfEntry;$i++){
                $sl++;
                if(isset($data) && !empty($data)){
                    $query="INSERT INTO `tbl_voucher` (`id`, `company_id`,`voucher_no`,`date`,`expense_type`,`employee_id`,`employee_name`,`employee_designation`,`customer_name`,`project_id`,`project_name`,`project_description`,`from_place`,`to_place`,`vehicle`,`amount`,`remarks`,`is_approved`,`is_expensed`,`entry_date`,`entry_by`) VALUES ('', '".$data['companyId']."','".$data['voucherNo']."','".$data['date']."','".$data['expenseType']."','".$data['employeeId']."','".$data['employeeName']."','".$data['designation']."','".$data['customerName']."','".$data['projectId']."','".$data['projectName']."','".$data['projectDescription']."','". $data["ID".$sl."_from"]."','". $data["ID".$sl."_to"]."','". $data["ID".$sl."_vehicle"]."','". $data["ID".$sl."_amount"]."','". $data["ID".$sl."_remark"]."','0','0','". date('Y-m-d H:i:s')."','". $data["entryBy"]."')";
//            echo $query;
//            die();
                    if (mysql_query($query)) {
                        $_SESSION['successMessage'] = "Updated Successfully";
                    } else {
                        $_SESSION['errorMessage'] = "Oops! Something wrong!";
                    }

                }
            }
        }
        header('location:index.php');
    }
    public function pendingVouchers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`is_printed`='0' AND deleted_at IS NULL GROUP BY voucher_no ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function previousVouchers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`is_printed`='1' AND `tbl_voucher`.`is_approved`='1' AND deleted_at IS NULL GROUP BY voucher_no ORDER BY date DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function approvedVouchers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`is_approved`='1' AND deleted_at IS NULL GROUP BY voucher_no ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function trash()
    {
        date_default_timezone_set("Asia/Dhaka");
        $query = "UPDATE `tbl_voucher` SET `deleted_at` = '" . date('Y-m-d H:i:s') . "' WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no` ='". $this->voucherNo."'";
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

        header('location:index.php');
    }
    public function expenseTypes(){
        $mydata=array();
        $query="SELECT * FROM `tbl_expense_type` WHERE `tbl_expense_type`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function approve()
    {

        $query = "UPDATE `tbl_voucher` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . $this->approvedDate . "' WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no` ='".$this->voucherNo."'";

        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:pendingVoucher.php');
    }

    public function approveFromShow()
    {

        $query = "UPDATE `tbl_voucher` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . $this->approvedDate . "' WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no` ='".$this->voucherNo."'";

        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:show.php?voucherNo='.$this->voucherNo);
    }

    public function printed()
    {

        $query = "UPDATE `tbl_voucher` SET `is_printed` = '1' WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no` ='".$this->voucherNo."'";

        mysql_query($query);
    }

    public function lastEntry(){
        $data = array();
        $query="SELECT max(voucher_no) as voucher_no FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id` = '".$this->companyId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        $query1="SELECT max(expense_id) as expense_id FROM `tbl_expense` WHERE `tbl_expense`.`company_id` = '".$this->companyId."'";
//        echo $query;
//        die();
        $result1=  mysql_query($query1);
        $row1=  mysql_fetch_assoc($result1);
        if ($row['voucher_no']>=$row1['expense_id']){
            $data['voucher_no']= $row['voucher_no'];
        } else{
            $data['voucher_no']= $row1['expense_id'];
        }
        return $data;
    }

    public function employees(){
        $mydata=array();
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY employee_id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function employeeName($employeeId=''){
        $query="SELECT * FROM `tbl_employee` where `tbl_employee`.`employee_id`=".$employeeId;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function employeeDesignation(){
        $query="SELECT * FROM `tbl_employee` where `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id`=".$this->employeeId;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function runningProjects(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_status`='Running' AND deleted_at IS NULL ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function Customers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_customer` WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY customer_name ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function ProjectNames(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`customer_name`='".$this->customerName."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function ProjectInfo(){
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id`='".$this->projectId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function selectVouchers(){
        $mydata=array();
//        $fromNumber = substr($this->from,6);
//        $toNumber = substr($this->to,6);
//        echo $fromNumber.'<br>';
//        echo $toNumber.'<br>';
//        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND deleted_at IS NULL AND `tbl_voucher`.`voucher_no` >='".$this->from."' AND `tbl_voucher`.`voucher_no` <='".$this->to."'   GROUP BY voucher_no ORDER BY id ASC";
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no` BETWEEN '".$this->from."' AND '".$this->to."' AND deleted_at IS NULL GROUP BY voucher_no ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function convertingIntoWords($num=''){
        $number = $num;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            "." . $words[$point / 10] . " " .
            $words[$point = $point % 10] : '';
        return $result;
    }
}