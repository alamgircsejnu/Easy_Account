<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Income\Income;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['entryBy'] = $_SESSION['employeeName'];
//print_r($_POST);
//die();
$income = new Income();
$income->prepare($_POST);
$income->store();