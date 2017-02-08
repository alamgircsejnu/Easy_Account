<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['attId'] = $_GET['attId'];

$attendense = new AttendenseEntry();

$prepareAttendense = $attendense->prepare($_POST);
$attendense->delete();