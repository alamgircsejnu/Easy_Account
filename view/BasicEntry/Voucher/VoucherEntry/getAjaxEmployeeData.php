<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$voucher = new VoucherEntry();
$voucher->prepare($_POST);
$designation = $voucher->employeeDesignation();

echo json_encode($designation['designation']);