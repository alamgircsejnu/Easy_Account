<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\EmployeeLeave\ManageLeave\ManageLeave;

$_POST['companyId'] = $_SESSION['companyId'];
$from = $_POST['from'];
$to = $_POST['to'];

$leave = new ManageLeave();
$dates = $leave->createDateRangeArray($from,$to);
//$_POST['dates'] = $dates;

$totalDays = count($dates);
$_POST['totalDays'] = $totalDays;
$_POST['employeeId'] = $_SESSION['username'];
$_POST['employeeName'] = $_SESSION['employeeName'];
//print_r($_POST);
//die();

$dates = $leave->prepare($_POST);

$leave->store();