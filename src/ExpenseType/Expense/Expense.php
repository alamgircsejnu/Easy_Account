<?php
namespace App\ExpenseType\Expense;
use App\dbConnection;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-10
 * Time: 9:27 AM
 */
class Expense
{
    public $id = '';
    public $companyId = '';
    public $expenseType = '';


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
        if (array_key_exists('expenseType', $data)) {
            $this->expenseType = $data['expenseType'];
        }
//        print_r($this);
//
//        die();

    }

    public function store(){
        if(isset($this->expenseType) && !empty($this->expenseType)){
            $query="INSERT INTO `tbl_expense_type` (`id`, `company_id`,`expense_type`,`created_at`) VALUES ('','".$this->companyId."', '".$this->expenseType."','". date('Y-m-d')."')";
//            echo $query;
//            die();
            if(mysql_query($query)){
                $_SESSION['successMessage']="Successfully Added";
            }  else {
                $_SESSION['errorMessage']="Failed to add";
            }
        }
        header('location:create.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_expense_type` where `tbl_expense_type`.`company_id` = '".$this->companyId."' AND deleted_at IS NULL";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:index.php');
    }

    public function delete(){

        $query="DELETE FROM `tbl_expense_type` WHERE `tbl_expense_type`.`id` =".$this->id;
        if(mysql_query($query)){
            $_SESSION['successMessage']="This expense type is permanently deleted";
        }  else {
            $_SESSION['errorMessage']="Something Wrong to delete data";
        }
        header('location:index.php');
    }

}