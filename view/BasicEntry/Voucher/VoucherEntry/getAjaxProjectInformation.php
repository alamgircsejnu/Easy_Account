<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$voucher = new VoucherEntry();
$voucher->prepare($_POST);
$projectInfo = $voucher->ProjectInfo();

echo json_encode($projectInfo);