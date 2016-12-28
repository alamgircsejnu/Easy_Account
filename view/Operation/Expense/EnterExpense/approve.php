<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];
$_POST['approvedBy'] = $_SESSION['employeeName'];
$_POST['approvedDate'] = date('Y-m-d');
//print_r($_POST);
//die();
$expense = new Expense();
$approve = $expense->prepare($_POST);
$approved = $expense->approve();