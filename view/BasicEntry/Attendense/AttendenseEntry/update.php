<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$_POST['employeeId'] = $_SESSION['username'];
$_POST['employeeName'] = $_SESSION['employeeName'];
$_POST['companyId'] = $_SESSION['companyId'];

$attendense = new AttendenseEntry();

$prepareAttendense = $attendense->prepare($_POST);

$employee = $attendense->cardId();
$_POST['cardId'] = $employee['card_id'];
$prepareAttendense = $attendense->prepare($_POST);
$attendense->update();
//print_r($prepareAttendense);