<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$_POST['companyId'] = $_SESSION['companyId'];

$from = $_POST['from'];
$to = $_POST['to'];

$attendense = new AttendenseEntry();
$dates = $attendense->createDateRangeArray($from,$to);
$_POST['dates'] = $dates;

$prepareAttendense = $attendense->prepare($_POST);
$attendense->processData();
//print_r($prepareAttendense);