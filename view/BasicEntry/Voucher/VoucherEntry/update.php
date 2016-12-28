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
$employeeName = $emp['first_name'].' '.$emp['last_name'];
$_POST['employeeName'] = $employeeName;
//print_r($_POST);
//die();
$voucher->prepare($_POST);


$voucher->updateExpenses($_POST);