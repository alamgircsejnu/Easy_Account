<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$_POST['employeeId'] = $_SESSION['username'];
$_POST['employeeName'] = $_SESSION['employeeName'];
$_POST['companyId'] = $_SESSION['companyId'];

$attendense = new AttendenseEntry();

$prepareAttendense = $attendense->prepare($_POST);
$attendense->store();
//print_r($prepareAttendense);