<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-21
 * Time: 2:22 PM
 */

namespace App\ChequeBook\ChequeBookEntry;
use App\dbConnection;

class ChequeBookEntry
{
    public $id = '';
    public $companyId = '';
    public $bankName = '';
    public $accountNo = '';
    public $from = '';
    public $to = '';
    public $entryBy = '';



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
        if (array_key_exists('bankName', $data)) {
            $this->bankName = $data['bankName'];
        }
        if (array_key_exists('accountNo', $data)) {
            $this->accountNo = $data['accountNo'];
        }
        if (array_key_exists('from', $data)) {
            $this->from = $data['from'];
        }
        if (array_key_exists('to', $data)) {
            $this->to = $data['to'];
        }
        if (array_key_exists('entryBy', $data)) {
            $this->entryBy = $data['entryBy'];
        }


//        print_r($this);
//
//        die();


    }


    public function store()
    {
        date_default_timezone_set("Asia/Dhaka");
        if (isset($this->bankName) && !empty($this->bankName)) {
            $query = "INSERT INTO `tbl_account_cheque` (`id`,`company_id`, `cheque_number`,`account_number`,`bank_name`,`status`,`entry_by`,`entry_date`) VALUES ";

            for ($i = $this->from; $i <= $this->to; $i++) {
                $query = $query . "('', '" . $this->companyId . "','" . $i . "','" . $this->accountNo . "','" . $this->bankName . "','Not Issued','" . $this->entryBy . "','" . date('Y-m-d H:i:s'). "'),";
            }
            $query2 = rtrim($query, ",");
//            echo $query2;
//            die();
            if (mysql_query($query2)) {
                $_SESSION['successMessage'] = "Successfully Added";
            } else {
                $_SESSION['errorMessage'] = "Oops! Something wrong!";
            }

        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_account_cheque` WHERE `tbl_account_cheque`.`company_id` = '".$this->companyId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function deleteAll(){
        $query="DELETE FROM `tbl_account_cheque` WHERE `tbl_account_cheque`.`company_id`='".$this->companyId."'";
//        echo $query;
//        die();
        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "All Data Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }
        header('location:index.php');
    }

    public function delete()
    {

        $query = "DELETE FROM `tbl_account_cheque` WHERE `tbl_account_cheque`.`id` =" . $this->id;

        if (mysql_query($query)) {
            $_SESSION['successMessage'] = "Deleted Successfully";
        } else {
            $_SESSION['errorMessage'] = "Oops! Something wrong to delete data!";
        }

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
        $query="SELECT `account_number` FROM `tbl_account` WHERE `tbl_account`.`company_id`='".$this->companyId."' AND `tbl_account`.`account_bank`='".$this->bankName."' AND deleted_at IS NULL ORDER BY id ASC";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }
}