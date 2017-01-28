<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$voucher = new VoucherEntry();
$voucher->prepare($_POST);
$projectNames = $voucher->ProjectNames();

echo json_encode($projectNames);