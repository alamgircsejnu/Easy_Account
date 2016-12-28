<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;
$_POST['companyId'] = $_SESSION['companyId'];
$expense = new Expense();
$expense->prepare($_POST);
$projectDetails = $expense->projectDetails();

echo json_encode($projectDetails);