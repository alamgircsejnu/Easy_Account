<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Payment\Payment;
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];
$_POST['approvedBy'] = $_SESSION['employeeName'];
$_POST['approvedDate'] = date('Y-m-d');
//print_r($_POST);
//die();
$payment = new Payment();
$approve = $payment->prepare($_POST);
$approved = $payment->approve();