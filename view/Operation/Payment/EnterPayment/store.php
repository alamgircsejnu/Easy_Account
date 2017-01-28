<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Payment\Payment;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['entryBy'] = $_SESSION['employeeName'];
//print_r($_POST);
//die();
$payment = new Payment();
$payment->prepare($_POST);
$payment->store();