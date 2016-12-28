<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['voucherNo'] = $_GET['voucherNo'];
$_POST['approvedBy'] = $_SESSION['employeeName'];
$_POST['approvedDate'] = date('Y-m-d');
//print_r($_POST);
//die();
$voucher = new VoucherEntry();
$approve = $voucher->prepare($_POST);
$approved = $voucher->approve();