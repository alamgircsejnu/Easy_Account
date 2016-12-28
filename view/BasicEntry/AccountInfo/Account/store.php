<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\AccountInfo\Account\Account;

$_POST['companyId'] = $_SESSION['companyId'];
$account = new Account();
$account->prepare($_POST);
$account->store();