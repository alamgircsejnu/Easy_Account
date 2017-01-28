<?php
namespace App\Operation\Payment;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2017-01-17
 * Time: 12:44 PM
 */
class Payment
{
    public $id = '';
    public $companyId = '';
    public $paymentId = '';
    public $paymentDate = '';
    public $amount = '';
    public $payType = '';
    public $bankName = '';
    public $creditAC = '';
    public $chequeNo = '';
    public $projectId = '';
    public $projectDue = '';
    public $customerName = '';
    public $projectPO = '';
    public $projectName = '';
    public $paidTo = '';
    public $receivedBy = '';
    public $description = '';
    public $entryBy = '';
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
        if (array_key_exists('paymentId', $data)) {
            $this->paymentId = $data['paymentId'];
        }
        if (array_key_exists('paymentDate', $data)) {
            $this->paymentDate = $data['paymentDate'];
        }
        if (array_key_exists('amount', $data)) {
            $this->amount = $data['amount'];
        }
        if (array_key_exists('payType', $data)) {
            $this->payType = $data['payType'];
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
        if (array_key_exists('projectDue', $data)) {
            $this->projectDue = $data['projectDue'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
        if (array_key_exists('projectPO', $data)) {
            $this->projectPO = $data['projectPO'];
        }
        if (array_key_exists('projectName', $data)) {
            $this->projectName = $data['projectName'];
        }

        if (array_key_exists('vendor', $data)) {
            $this->paidTo = $data['vendor'];
        } elseif (array_key_exists('negotiator', $data)) {
            $this->paidTo = $data['negotiator'];
        } else{
            $this->paidTo = 'employee';
        }

        if (array_key_exists('receivedBy', $data)) {
            $this->receivedBy = $data['receivedBy'];
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
//        print_r($this);
//
//        die();

    }

    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->paymentId) && !empty($this->paymentId)){

            if(isset($this->chequeNo) && !empty($this->chequeNo)) {
                $query = "UPDATE `tbl_account_cheque` SET `status` = 'Issued' WHERE `tbl_account_cheque`.`company_id`='" . $this->companyId . "' AND `tbl_account_cheque`.`account_number` ='" . $this->creditAC . "' AND `tbl_account_cheque`.`cheque_number` ='" . $this->chequeNo . "'";
//        echo $query;
//        die();
                mysql_query($query);
            }
            $query2="INSERT INTO `tbl_payment` (`id`,`company_id`, `payment_id`,`project_id`,`project_name`,`description`,`pay_type`,`cheque_no`,`cheque_bank`,`received_by`,`pay_amount`,`pay_date`,`paid_to`,`is_approved`,`entry_date`,`entry_by`) VALUES ('','".$this->companyId."', '".$this->paymentId."','". $this->projectId."','". $this->projectName."','". $this->description."','". $this->payType."','". $this->chequeNo."','". $this->creditAC."','". $this->receivedBy."','". $this->amount."','". $this->paymentDate."','". $this->paidTo."','0','". date('Y-m-d H:i:s')."','". $this->entryBy."')";
//            echo $query;
//            die();
            if(mysql_query($query2)){
                $_SESSION['successMessage']="Successfully Added";
            }else {
                $_SESSION['errorMessage']="Oops! Something wrong to add data";

            }
        }
        header('location:index.php');
    }
    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_payment` WHERE `tbl_payment`.`company_id`='".$this->companyId."' AND `tbl_payment`.`is_approved`='0' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_payment` where `tbl_payment`.`company_id`='".$this->companyId."' AND `tbl_payment`.`id`=".$this->id;
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

        $query="SELECT * FROM `tbl_payment` where `tbl_payment`.`company_id`='".$this->companyId."' AND `tbl_payment`.`id`=".$this->id;
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        $this->payType = $row['pay_type'];
        $this->creditAC = $row['cheque_bank'];
        $this->description = $row['description'];
        $this->chequeNo = $row['cheque_no'];
        $this->amount = $row['pay_amount'];
        $this->paymentDate = $row['pay_date'];
        $this->entryBy = $row['entry_by'];
        $this->paymentId = $row['payment_id'];
        $this->receivedBy = $row['received_by'];
        $this->paidTo = $row['paid_to'];

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

            $query4="INSERT INTO `tbl_bank_tx` (`id`,`company_id`, `description`,`cheque_number`,`account_number`,`credit_amount`,`tx_date`,`entry_date`,`entry_by`,`tx_code`) VALUES ('','".$this->companyId."', '".$this->description."','". $this->chequeNo."','". $this->creditAC."','". $this->amount."','". $this->paymentDate."','". date('Y-m-d H:i:s')."','". $this->entryBy."','". $this->paymentId."')";
            $result4=  mysql_query($query4);
        }
        if ($this->paidTo == 'employee'){
            $query3="SELECT employee_due FROM `tbl_employee` where `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id`='".$this->receivedBy."'";
            $result3=  mysql_query($query3);
            $row3=  mysql_fetch_assoc($result3);
            $updatedBalance = $row3['employee_due'] - $this->amount;
            $query4="UPDATE `tbl_employee` SET `employee_due` = '".$updatedBalance."' WHERE `tbl_employee`.`company_id`='".$this->companyId."' AND `tbl_employee`.`employee_id` ='".$this->receivedBy."'";
            $result4=  mysql_query($query4);
        } elseif ($this->paidTo == 'vendor'){
            $query3="SELECT supplier_due FROM `tbl_supplier` where `tbl_supplier`.`company_id`='".$this->companyId."' AND `tbl_supplier`.`supplier_name`='".$this->receivedBy."'";
            $result3=  mysql_query($query3);
            $row3=  mysql_fetch_assoc($result3);
            $updatedBalance = $row3['supplier_due'] - $this->amount;
            $query3="UPDATE `tbl_supplier` SET `supplier_due` = '".$updatedBalance."' WHERE `tbl_supplier`.`company_id`='".$this->companyId."' AND `tbl_supplier`.`supplier_name` ='".$this->receivedBy."'";
            $result3=  mysql_query($query3);
        } elseif ($this->paidTo == 'negotiator'){
            $query3="SELECT nego_due FROM `tbl_negotiator` where `tbl_negotiator`.`company_id`='".$this->companyId."' AND `tbl_negotiator`.`nego_name`='".$this->receivedBy."'";
            $result3=  mysql_query($query3);
            $row3=  mysql_fetch_assoc($result3);
            $updatedBalance = $row3['nego_due'] - $this->amount;
            $query3="UPDATE `tbl_negotiator` SET `nego_due` = '".$updatedBalance."' WHERE `tbl_negotiator`.`company_id`='".$this->companyId."' AND `tbl_negotiator`.`nego_name` ='".$this->receivedBy."'";
            $result3=  mysql_query($query3);
        }
        $query4 = "UPDATE `tbl_payment` SET `is_approved` = '1',`approved_by`='" . $this->approvedBy . "',`approved_date`='" . $this->approvedDate . "' WHERE `tbl_payment`.`company_id`='".$this->companyId."' AND `tbl_payment`.`id` ='".$this->id."'";

        if (mysql_query($query4)) {
            $_SESSION['successMessage'] = "Approved Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong!";
        }

        header('location:pendingPayment.php');
    }

    public function pendingPayments(){
        $mydata=array();
        $query="SELECT * FROM `tbl_payment` WHERE `tbl_payment`.`company_id`='".$this->companyId."' AND `tbl_payment`.`is_approved`='0' AND deleted_at IS NULL ORDER BY id DESC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
    public function lastEntry(){
        $query="SELECT * FROM `tbl_payment` WHERE `tbl_payment`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
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