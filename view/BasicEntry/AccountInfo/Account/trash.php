<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\AccountInfo\Account\Account;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new Account();
$deleted = $delete->prepare($_POST);
$delete->trash();