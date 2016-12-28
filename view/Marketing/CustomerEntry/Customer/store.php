<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Customer\Customer;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['employeeName'] = $_SESSION['employeeName'];
//print_r($_POST);
//die();
$customer = new Customer();
$customer->prepare($_POST);
$customer->store();
