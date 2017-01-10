<?php
namespace App\Holiday\WeekenedHoliday;
use App\dbConnection;

class WeekenedHoliday
{

    public $id = '';
    public $companyId = '';
    public $from = '';
    public $to = '';
    public $dates = '';
    public $dayNames = '';
    public $description = '';


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
        if (array_key_exists('from', $data)) {
            $this->from = $data['from'];
        }
        if (array_key_exists('to', $data)) {
            $this->to = $data['to'];
        }
        if (array_key_exists('dates', $data)) {
            $this->dates = $data['dates'];
        }
        if (array_key_exists('dayNames', $data)) {
            $this->dayNames = $data['dayNames'];
        }
        if (array_key_exists('description', $data)) {
            $this->description = $data['description'];
        }


//        print_r($this);
//
//        die();


    }


    public function store()
    {
        date_default_timezone_set("Asia/Dhaka");
        if (isset($this->dates) && !empty($this->dates)) {
            $query = "INSERT INTO `tbl_holiday` (`id`,`company_id`, `date`,`description`,`day_name`,`created_at`) VALUES ";

            for ($i = 0; $i < count($this->dates); $i++) {
                $query = $query . "('', '" . $this->companyId . "','" . $this->dates[$i] . "','Weekened Holiday','" . $this->dayNames[$i] . "','" . date('Y-m-d') . "'),";
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

    public function storeGH()
    {
        date_default_timezone_set("Asia/Dhaka");
        if (isset($this->dates) && !empty($this->dates)) {
            $query = "INSERT INTO `tbl_holiday` (`id`,`company_id`, `date`,`description`,`day_name`,`created_at`) VALUES ";

            for ($i = 0; $i < count($this->dates); $i++) {
                $query = $query . "('','" . $this->companyId . "', '" . $this->dates[$i] . "','" . $this->description . "','" . $this->dayNames[$i] . "','" . date('Y-m-d') . "'),";
            }
            $query2 = rtrim($query, ",");

            if (mysql_query($query2)) {
                $_SESSION['successMessage'] = "Successfully Added";
            } else {
                $_SESSION['errorMessage'] = "Something wrong!";
            }

        }
        header('location:index.php');
    }

    public function index(){
        $mydata=array();
        $query="SELECT DISTINCT * FROM `tbl_holiday` WHERE `tbl_holiday`.`company_id` = '".$this->companyId."' GROUP BY date";
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
        $query="DELETE FROM `tbl_holiday` WHERE `tbl_holiday`.`company_id`='".$this->companyId."'";
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

        $query = "DELETE FROM `tbl_holiday` WHERE `tbl_holiday`.`id` =" . $this->id;

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