<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-22
 * Time: 11:46 AM
 */

namespace App\Operation\Income;
use App\dbConnection;

class Income
{
    public $id = '';
    public $companyId = '';
    public $incomeId = '';
    public $incomeAmount = '';
    public $incomeDate = '';
    public $vat = '';
    public $ait = '';
    public $payType = '';
    public $chequeNo = '';
    public $bankName = '';
    public $depositAC = '';
    public $projectId = '';
    public $projectName = '';
    public $description = '';
    public $entryBy = '';
    public $customerName = '';


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
        if (array_key_exists('incomeId', $data)) {
            $this->incomeId = $data['incomeId'];
        }
        if (array_key_exists('incomeAmount', $data)) {
            $this->incomeAmount = $data['incomeAmount'];
        }
        if (array_key_exists('incomeDate', $data)) {
            $this->incomeDate = $data['incomeDate'];
        }
        if (array_key_exists('vat', $data)) {
            $this->vat = $data['vat'];
        }
        if (array_key_exists('ait', $data)) {
            $this->ait = $data['ait'];
        }
        if (array_key_exists('payType', $data)) {
            $this->payType = $data['payType'];
        }
        if (array_key_exists('chequeNo', $data)) {
            $this->chequeNo = $data['chequeNo'];
        }
        if (array_key_exists('bankName', $data)) {
            $this->bankName = $data['bankName'];
        }
        if (array_key_exists('depositAC', $data)) {
            $this->depositAC = $data['depositAC'];
        }
        if (array_key_exists('projectId', $data)) {
            $this->projectId = $data['projectId'];
        }
        if (array_key_exists('projectName', $data)) {
            $this->projectName = $data['projectName'];
        }
        if (array_key_exists('description', $data)) {
            $this->description = $data['description'];
        }
        if (array_key_exists('entryBy', $data)) {
            $this->entryBy = $data['entryBy'];
        }
        if (array_key_exists('customerName', $data)) {
            $this->customerName = $data['customerName'];
        }
//        print_r($this);
//
//        die();

    }

    public function store(){
        date_default_timezone_set("Asia/Dhaka");
        if(isset($this->incomeId) && !empty($this->incomeId)){
            $query="INSERT INTO `tbl_income` (`id`,`company_id`, `income_id`,`project_id`,`project_name`,`description`,`pay_type`,`cheque_no`,`cheque_bank`,`deposit_bank`,`income_amount`,`income_date`,`entry_date`,`entry_by`,`vat`,`ait`,`customer_name`) VALUES ('','".$this->companyId."', '".$this->incomeId."','". $this->projectId."','". $this->projectName."','". $this->description."','". $this->payType."','". $this->chequeNo."','". $this->bankName."','". $this->depositAC."','". $this->incomeAmount."','". $this->incomeDate."','". date('Y-m-d H:i:s')."','". $this->entryBy."','". $this->vat."','". $this->ait."','". $this->customerName."')";
            mysql_query($query);

            $query2="SELECT account_balance FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number`='".$this->depositAC."' AND deleted_at IS NULL";
            $result=  mysql_query($query2);
            $row=  mysql_fetch_assoc($result);
            $totalBalance = $this->incomeAmount+$row['account_balance'];
            $query3 = "update tbl_account set account_balance=".$totalBalance." where account_number='".$this->depositAC."'";
            mysql_query($query3);

            $query4="SELECT project_payment FROM `tbl_project` WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id`='".$this->projectId."' AND deleted_at IS NULL";
            $result=  mysql_query($query4);
            $row=  mysql_fetch_assoc($result);
            $totalPayment = $this->incomeAmount+$this->vat+$this->ait+$row['project_payment'];
            $query5 = "update tbl_project set `project_payment`=".$totalPayment." WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id`='".$this->projectId."'";
            mysql_query($query5);
            if ($this->payType=='Cheque'){
                $query6="INSERT INTO `tbl_bank_tx` (`id`,`company_id`, `description`,`cheque_number`,`account_number`,`debit_amount`,`tx_date`,`entry_date`,`entry_by`,`tx_code`) VALUES ('','".$this->companyId."', '".$this->description."','". $this->chequeNo."','". $this->depositAC."','". $this->incomeAmount."','". $this->incomeDate."','". date('Y-m-d H:i:s')."','". $this->entryBy."','". $this->incomeId."')";
                $result=  mysql_query($query6);
            }
            $query7="SELECT credit FROM `tbl_customer` WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_name`='".$this->customerName."' AND deleted_at IS NULL";
            $result=  mysql_query($query7);
            $row=  mysql_fetch_assoc($result);
            $totalCredit = $this->incomeAmount+$this->vat+$this->ait+$row['credit'];
            $query8 = "update tbl_customer set `credit`=".$totalCredit." WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_name`='".$this->customerName."'";
            if(mysql_query($query8)){
                $_SESSION['successMessage']="Successfully Added";
            }else {
                $_SESSION['errorMessage']="Oops! Something wrong to add data";

            }


        }
        header('location:index.php');
    }
    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_income` WHERE `tbl_income`.`company_id`='".$this->companyId."' AND deleted_at IS NULL";
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
        $query="SELECT * FROM `tbl_income` where `tbl_income`.`company_id`='".$this->companyId."' AND `tbl_income`.`id`=".$this->id;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }
    public function update(){
        date_default_timezone_set("Asia/Dhaka");
        $query="SELECT * FROM `tbl_income` where `tbl_income`.`company_id`='".$this->companyId."' AND `tbl_income`.`id`=".$this->id;
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);

        $old = $row['income_amount'] + $row['vat'] + $row['ait'];
        $diff = ($this->incomeAmount + $this->vat + $this->ait)-$old;
        $DiffForAccount = $this->incomeAmount-$row['income_amount'];

        $query2="UPDATE `tbl_income` SET `income_id` = '".$this->incomeId."',`project_id`='".$this->projectId."',`project_name`='".$this->projectName."',`description`='".$this->description."',`pay_type`='".$this->payType."',`cheque_no`='".$this->chequeNo."',`cheque_bank`='".$this->bankName."',`deposit_bank`='".$this->depositAC."',`income_amount`='".$this->incomeAmount."',`income_date`='".$this->incomeDate."',`vat`='".$this->vat."',`ait`='".$this->ait."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `tbl_income`.`id` =". $this->id;
        $result2=  mysql_query($query2);

        $query3="SELECT `account_balance` FROM `tbl_account` where `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number`='".$this->depositAC."'";
       $result3=  mysql_query($query3);
        $row3=  mysql_fetch_assoc($result3);
        $updatedBalance = $DiffForAccount + $row3['account_balance'];
        $query4="UPDATE `tbl_account` SET `account_balance` = '".$updatedBalance."' WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number` ='".$this->depositAC."'";
        $result4=  mysql_query($query4);

        $query5="SELECT project_payment FROM `tbl_project` where `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id`='".$this->projectId."'";
        $result5=  mysql_query($query5);
        $row5=  mysql_fetch_assoc($result5);
        $updatedBalanceP = $diff + $row5['project_payment'];
        $query6="UPDATE `tbl_project` SET `project_payment` = '".$updatedBalanceP."' WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id` ='". $this->projectId."'";
        $result6=  mysql_query($query6);

        if ($this->payType=='Cheque'){
            $query7="UPDATE `tbl_bank_tx` SET `debit_amount` = '".$this->incomeAmount."' WHERE `tbl_bank_tx`.`company_id`='".$this->companyId."' AND `tbl_bank_tx`.`tx_code` ='". $this->incomeId."'";
            $result7=  mysql_query($query7);
        }

        $query8="SELECT credit FROM `tbl_customer` where `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_name`='".$this->customerName."'";
        $result8=  mysql_query($query8);
        $row8=  mysql_fetch_assoc($result8);
        $updatedBalanceC = $diff + $row8['credit'];
        $query9="UPDATE `tbl_customer` SET `credit` = '".$updatedBalanceC."' WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_name` ='". $this->customerName."'";
        if(mysql_query($query9)){
            $_SESSION['successMessage']="Data Updated Successfully";
        }  else {
            $_SESSION['errorMessage']="Oops!!! Someting wrong to update data!";
        }
        header('location:index.php');
    }
    public function delete(){
//        session_start();
        $query="SELECT * FROM `tbl_income` where `tbl_income`.`company_id`='".$this->companyId."' AND `tbl_income`.`id`=".$this->id;
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        $old = $row['income_amount'] + $row['vat'] + $row['ait'];
        $this->incomeAmount = $row['income_amount'];
        $this->projectId = $row['project_id'];
        $this->payType = $row['pay_type'];
        $this->depositAC = $row['deposit_bank'];
        $this->customerName = $row['customer_name'];
        $this->incomeId = $row['income_id'];

        $query2="DELETE FROM `tbl_income` WHERE `tbl_income`.`id` =".$this->id;
        mysql_query($query2);
        $query3="SELECT `account_balance` FROM `tbl_account` where `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number`='".$this->depositAC."'";
        $result3=  mysql_query($query3);
        $row3=  mysql_fetch_assoc($result3);
        $updatedBalance =  $row3['account_balance'] - $this->incomeAmount;
        $query4="UPDATE `tbl_account` SET `account_balance` = '".$updatedBalance."' WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_number` ='".$this->depositAC."'";
        $result4=  mysql_query($query4);

        $query5="SELECT project_payment FROM `tbl_project` where `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id`='".$this->projectId."'";
        $result5=  mysql_query($query5);
        $row5=  mysql_fetch_assoc($result5);
        $updatedBalanceP = $row5['project_payment'] - $old;
        $query6="UPDATE `tbl_project` SET `project_payment` = '".$updatedBalanceP."' WHERE `tbl_project`.`company_id`='".$this->companyId."' AND `tbl_project`.`project_id` ='". $this->projectId."'";
        $result6=  mysql_query($query6);

        if ($this->payType=='Cheque'){
            $query7="DELETE FROM `tbl_bank_tx` WHERE `tbl_bank_tx`.`company_id`='".$this->companyId."' AND `tbl_bank_tx`.`tx_code` ='". $this->incomeId."'";
            $result7=  mysql_query($query7);
        }

        $query8="SELECT credit FROM `tbl_customer` where `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_name`='".$this->customerName."'";
        $result8=  mysql_query($query8);
        $row8=  mysql_fetch_assoc($result8);
        $updatedBalanceC = $row8['credit'] - $old;;
        $query9="UPDATE `tbl_customer` SET `credit` = '".$updatedBalanceC."' WHERE `tbl_customer`.`company_id`='".$this->companyId."' AND `tbl_customer`.`customer_name` ='". $this->customerName."'";

        if(mysql_query($query9)){
            $_SESSION['successMessage']="Data Deleted Successfully";
        }  else {
            $_SESSION['errorMessage']="Oops!!! Something wrong to delete data!";
        }
        header('location:index.php');
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
    public function lastEntry(){
        $query="SELECT * FROM `tbl_income` WHERE `tbl_income`.`company_id` = '".$this->companyId."' ORDER BY id DESC LIMIT 1";
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
        $query="SELECT * FROM `tbl_voucher` WHERE `tbl_voucher`.`company_id`='".$this->companyId."' AND `tbl_voucher`.`is_expensed`='0' AND deleted_at IS NULL GROUP BY voucher_no";
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
        $query="SELECT * FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND deleted_at IS NULL GROUP BY `account_bank` ORDER BY id ASC";
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
        $query="SELECT `account_number` FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND deleted_at IS NULL ORDER BY id ASC";
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
}