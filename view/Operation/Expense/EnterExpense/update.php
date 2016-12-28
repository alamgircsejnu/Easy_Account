<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$expense = new Expense();
$expense->prepare($_POST);
$expense->update();