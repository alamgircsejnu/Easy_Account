<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;
$_POST['companyId'] = $_SESSION['companyId'];
$account = new Expense();
$account->prepare($_POST);
$bankNames = $account->bankNames();
//print_r($companies);

echo json_encode($bankNames);