<?php
session_start();

include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$_POST['companyId'] = $_SESSION['companyId'];
//$assignedTo = $_POST['assignedTo'];

$project = new TaskExecution();
$project->prepare($_POST);
$projectPriorities = $project->personalProjects();

echo json_encode($projectPriorities);