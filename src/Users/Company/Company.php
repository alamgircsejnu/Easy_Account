<?php
namespace App\Users\Company;
use App\dbConnection;

/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-12-10
 * Time: 5:53 PM
 */
class Company
{
    public $id = '';
    public $companyId = '';
    public $companyName = '';


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
            $this->userRole = $data['companyId'];
        }
        if (array_key_exists('companyName', $data)) {
            $this->companyName = $data['companyName'];
        }
//        print_r($this);
//
//        die();

    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_company` where delete_time IS NULL";
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
        $this->companyId=$id;
        $query="SELECT * FROM `tbl_company` where `tbl_company`.`company_id`=".$this->companyId;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }


}