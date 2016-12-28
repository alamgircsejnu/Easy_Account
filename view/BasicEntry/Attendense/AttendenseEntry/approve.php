<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$leave = new AttendenseEntry();

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];
$_POST['approvedBy'] = $_SESSION['employeeName'];
$_POST['approvedDate'] = date('Y-m-d');
$approve = $leave->prepare($_POST);
$approved = $leave->approve();