<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$attendense = new AttendenseEntry();

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['attId'] = $_GET['attId'];
$_POST['approvedBy'] = $_SESSION['employeeName'];
$approve = $attendense->prepare($_POST);
$approved = $attendense->approve();