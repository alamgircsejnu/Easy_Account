<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ExpenseType\Expense\Expense;

$_POST['companyId'] = $_SESSION['companyId'];

$expense = new Expense();
$expense->prepare($_POST);
$expense->store();
