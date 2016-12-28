<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['voucherNo'] = $_GET['voucherNo'];

$delete = new VoucherEntry();
$deleted = $delete->prepare($_POST);
$delete->trash();