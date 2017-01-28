<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['entryBy'] = $_SESSION['employeeName'];
//print_r($_POST);
//die();
$voucher = new VoucherEntry();
$emp = $voucher->employeeName($_POST['employeeId']);
$employeeDesignation = $emp['designation'];
$_POST['designation'] = $employeeDesignation;
//print_r($_POST);
//die();
$voucher->prepare($_POST);

$lastTask = $voucher->lastEntry();
if (isset($lastTask) && !empty($lastTask)){
    $lastTaskId = $lastTask['voucher_no'];
    $taskYear = substr($lastTaskId,2,4);
//    echo $taskYear;
//    die();
    $currentYear =  date('Y');
    if ($taskYear==$currentYear){

        $taskNumber = substr($lastTaskId,6);
        $newTaskNumber = (int)$taskNumber +1;
        $newTaskId = 'VN'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
    } else{
        $newTaskNumber = '1001';
        $newTaskId = 'VN'.date('Y').$newTaskNumber;
    }
} else{
    $newTaskNumber = '1001';
    $newTaskId = 'VN'.date('Y').$newTaskNumber;
}
$_POST['voucherNo'] = $newTaskId;
$voucher->prepare($_POST);
$voucher->storeExpenses($_POST);