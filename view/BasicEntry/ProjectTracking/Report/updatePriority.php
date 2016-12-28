<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$_POST['companyId'] = $_SESSION['companyId'];
$assignedBy = $_SESSION['employeeName'];
$_POST['assignedBy'] = $assignedBy;
$section = new TaskExecution();
$section->prepare($_POST);
$section->updatePriority();
