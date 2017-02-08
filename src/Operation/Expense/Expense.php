<?php
namespace App\Operation\Expense;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-10
 * Time: 10:23 AM
 */
class Expense
{
    public $id = '';
    public $companyId = '';
    public $expenseId = '';
    public $expenseType = '';
    public $amount = '';
    public $payType = '';
    public $expDate = '';
    public $bankName = '';
    public $creditAC = '';
    public $chequeNo = '';
    public $projectId = '';
    public $projectName = '';
    public $supplierId = '';
    public $expensedBy = '';
    public $description = '';
    public $entryBy = '';
    public $approvedBy = '';
    public $approvedDate = '';
    public $voucherNo = '';


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
        if (array_key_exists('expenseId', $data)) {
            $this->expenseId = $data['expenseId'];
        }
        if (array_key_exists('expenseType', $data)) {
            $this->expenseType = $data['expenseType'];
        }
        if (array_key_exists('amount', $data)) {
            $this->amount = $data['amount'];
        }
        if (array_key_exists('payType', $data)) {
            $this->payType = $data['payType'];
        }
        if (array_key_exists('expDate', $data)) {
            $this->expDate = $data['expDate'];
        }
        if (array_key_exists('bankName', $data)) {
            $this->bankName = $data['bankName'];
        }
        if (array_key_exists('creditAC', $data)) {
            $this->creditAC = $data['creditAC'];
        }
        if (array_key_exists('chequeNo', $data)) {
            $this->chequeNo = $data['chequeNo'];
        }
        if (array_key_exists('projectId', $data)) {
            $this->projectId = $data['projectId'];
        }
        if (array_key_exists('projectName', $data)) {
            $this->projectName = $data['projectName'];
        }
        if (array_key_exists('supplierId', $data)) {
            $this->supplierId = $data['supplierId'];
        }
        if (array_key_exists('expensedBy', $data)) {
            $this->expensedBy = $data['expensedBy'];
        }
        if (array_key_exists('description', $data)) {
            $this->description = $data['description'];
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
        if (array_key_exists('voucherNo', $data)) {
            $this->voucherNo = $data['voucherNo'];
        }

//        print_r($this);
//
//        die();

    }

    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->expenseId) && !empty($this->expenseId)){
            if(isset($this->voucherNo) && !empty($this->voucherNo)) {
                $query = "UPDATE `tbl_voucher` SET `is_expensed` = '1' WHERE `tbl_voucher`.`company_id`='" . $this->companyId . "' AND `tbl_voucher`.`voucher_no` ='" . $this->voucherNo . "'";
//        echo $query;
//        die();
                mysql_query($query);
            }
            if(isset($this->chequeNo) && !empty($this->chequeNo)) {
                $query2 = "UPDATE `tbl_account_cheque` SET `status` = 'Issued' WHERE `tbl_account_cheque`.`company_id`='" . $this->companyId . "' AND `tbl_account_cheque`.`account_number` ='" . $this->creditAC . "' AND `tbl_account_cheque`.`cheque_number` ='" . $this->chequeNo . "'";
//        echo $query;
//        die();
                mysql_query($query2);
            }
            $query3="INSERT INTO `tbl_expense` (`id`,`company_id`, `expense_id`,`expense_type`,`project_id`,`project_name`,`description`,`pay_type`,`cheque_no`,`cheque_bank`,`expense_amount`,`expense_date`,`expense_by`,`supplier_id`,`is_approved`,`entry_date`,`entry_by`) VALUES ('','".$this->companyId."', '".$this->expenseId."','". $this->expenseType."','". $this->projectId."','". $this->projectName."','". $this->description."','". $this->payType."','". $this->chequeNo."','". $this->creditAC."','". $this->amount."','". $this->expDate."','". $this->expensedBy."','". $this->supplierId."','0','". date('Y-m-d H:i:s')."','". $this->entryBy."')";
//            echo $query;
//            die();
            if(mysql_query($query3)){
                $_SESSION['successMessage']="Successfully Added";
            }else {
                $_SESSION['errorMessage']="Oops! Something wrong to add data";

            }
        }
        header('location:index.php');
    }
    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_expense` WHERE `tbl_expense`.`company_id`='".$this->companyId."' AND `tbl_expense`.`is_approved`='0' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_expense` where `tbl_expense`.`company_id`='".$this->companyId."' AND `tbl_expense`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="UPDATE `tbl_expense` SET `expense_id` = '".$this->expenseId."',`expense_type`='".$this->expenseType."',`project_id`='".$this->projectId."',`project_name`='".$this->projectName."',`supplier_id`='".$this->supplierId."',`expensed_by`='".$this->expensedBy."',`description`='".$this->description."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_expense`.`id` =". $this->id;
//        echo $query;
//        die();
        mysql_query($query);
        $_SESSION['successMessage']="Data Updated Successfully";
        header('location:index.php');
    }

    public function approve()
    {

        $query="SELECT * FROM `tbl_expense` where `tbl_expense`.`company_id`='".$this->companyId."' AND `tbl_expense`.`id`=".$this->id;
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        $this->payType = $row['pay_type'];
        $this->amount = $row['expense_amount'];
        $this->creditAC = $row['cheque_bank'];
        $this->description = $row['description'];
        $this->chequeNo = $row['cheque_no'];
        $this->amount = $row['expense_amount'];
        $this->expDate = $row['expense_date'];
        $this->entryBy = $row['entry_by'];
        $this->expenseId = $row['expense_id'];
        $this->expensedBy = $row['expense_by'];
        $this->supplierId = $row['supplier_id'];

        if ($this->payType == 'Cash'){
        $query2="SELECT account_balance FROM `tbl_account` where `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number`='Cash Account'";
        $result2=  mysql_query($query2);
        $row2=  mysql_fetch_assoc($result2);
            $updatedBalance = $row2['account_balance'] - $this->amount;
            $query3="UPDATE `tbl_account` SET `account_balance` = '".$updatedBalance."' WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number` ='Cash Account'";
            $result3=  mysql_query($query3);
        } elseif ($this->payType == 'Cheque'){
            $query2="SELECT account_balance FROM `tbl_account` where `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number`='".$this->creditAC."'";
            $result2=  mysql_query($query2);
            $row2=  mysql_fetch_assoc($result2);
            $updatedBalance = $row2['account_balance'] - $this->amount;
            $query3="UPDATE `tbl_account` SET `account_balance` = '".$updatedBalance."' WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number` ='".$this->creditAC."'";
            $result3=  mysql_query($query3);

            $query4="INSERT INTO `tbl_bank_tx` (`id`,`company_id`, `description`,`cheque_number`,`account_number`,`credit_amount`,`tx_date`,`entry_date`,`entry_by`,`tx_code`) VALUES ('','".$this->companyId."', '".$this->description."','". $this->chequeNo."','". $this->creditAC."','". $this->amount."','". $this->expDate."','". date('Y-m-d H:i:s')."','". $this->entryBy."','". $this->expenseId."')";
            $result4=  mysql_query($query4);
        } elseif ($this->payType == 'CreditEmp'){
            $query2="SELECT employee_due FROM `tbl_employee` where `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id`='".$this->expensedBy."'";
            $result2=  mysql_query($query2);
            $row2=  mysql_fetch_assoc($result2);
            $updatedBalance = $row2['employee_due'] + $this->amount;
            $query3="UPDATE `tbl_employee` SET `employee_due` = '".$updatedBalance."' WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id` ='".$this->expensedBy."'";
            $result3=  mysql_query($query3);
        } elseif ($this->payType == 'CreditSupp'){
            $query2="SELECT supplier_due FROM `tbl_supplier` where `tbl_supplier`.`company_id`='".$this->companyId."' AND `tbl_supplier`.`supplier_name`='".$this->supplierId."'";
            $result2=  mysql_query($query2);
            $row2=  mysql_fetch_assoc($result2);
            $updatedBalance = $row2['supplier_due'] + $this->amount;
            $query3="UPDATE `tbl_supplier` SET `supplier_due` = '".$updatedBalance."' WHERE `tbl_supplier`.`company_id`='".$this->companyId."' AND `tbl_supplier`.`supplier_name` ='".$this->supplierId."'";
            $result3=  mysql_query($query3);
        }

        $query4 = "UPDATE `tbl_expense` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . $this->approvedDate . "' WHERE `tbl_expense`.`company_id`='".$this->companyId."' AND `tbl_expense`.`id` ='".$this->id."'";

        if (mysql_query($query4)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:pendingExpense.php');
    }

    public function pendingExpenses(){
        $mydata=array();
        $query="SELECT * FROM `tbl_expense` WHERE `tbl_expense`.`company_id`='".$this->companyId."' AND `tbl_expense`.`is_approved`='0' AND deleted_at IS NULL ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function approvedExpenses(){
        $mydata=array();
        $query="SELECT * FROM `tbl_expense` WHERE `tbl_expense`.`company_id`='".$this->companyId."' AND `tbl_expense`.`is_approved`='1' AND deleted_at IS NULL ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
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
            $data['expense_id']= $row['voucher_no'];
        } else{
            $data['expense_id']= $row1['expense_id'];
        }
        return $data;
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

    public function projectCodes(){
        $mydata=array();
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function projectDetails(){
        $query="SELECT * FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id`='".$this->projectId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function vouchers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`is_expensed`='0' AND `tbl_voucher`.`is_approved`='1' AND deleted_at IS NULL GROUP BY voucher_no";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function singleVoucher(){
        $mydata=array();
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`voucher_no`='".$this->voucherNo."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function allEmployee(){
        $mydata=array();
        $query="SELECT * FROM `tbl_employee` WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }
    public function allSuppliers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_supplier` WHERE `tbl_supplier`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function bankNames(){
        $mydata=array();
        $query="SELECT account_bank FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND deleted_at IS NULL GROUP BY `account_bank` ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function accountNumbers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_bank`='".$this->bankName."' AND deleted_at IS NULL ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function chequeNumbers(){
        $mydata=array();
        $query="SELECT * FROM `tbl_account_cheque` WHERE `tbl_account_cheque`.`company_id`='".$this->companyId."' AND `tbl_account_cheque`.`account_number`='".$this->creditAC."' AND `tbl_account_cheque`.`status`='Not Issued' AND deleted_at IS NULL ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }

    public function accountBalance(){
        $query="SELECT * FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number`='".$this->creditAC."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }



}