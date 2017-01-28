<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$voucher = new VoucherEntry();
$voucher->prepare($_POST);
$designation = $voucher->employeeDesignation();

$employeeName = $designation['first_name'].' '.$designation['last_name'];

echo json_encode($employeeName);