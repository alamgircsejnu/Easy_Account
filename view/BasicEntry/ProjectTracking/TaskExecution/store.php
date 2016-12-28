<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;

$_POST['doneBy'] = $_SESSION['employeeName'];

$_POST['companyId'] = $_SESSION['companyId'];

$_POST['createdBy'] = $_SESSION['employeeName'];
$user = new TaskExecution();
$user->prepare($_POST);
$user->store();
