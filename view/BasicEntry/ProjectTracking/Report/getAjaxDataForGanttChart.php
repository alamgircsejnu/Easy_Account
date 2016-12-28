<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$_POST['companyId'] = $_SESSION['companyId'];
$project = new TaskExecution();
$project->prepare($_POST);
$allprojects = $project->ganttChart();
echo json_encode($allprojects);