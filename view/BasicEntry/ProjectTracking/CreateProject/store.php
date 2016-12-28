<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;

$_POST['companyId'] = $_SESSION['companyId'];

$_POST['createdBy'] = $_SESSION['employeeName'];
$project = new ProjectTracking();
$project->prepare($_POST);
$customer = $project->singleEntry($_POST['customerId']);
$_POST['customerName'] = $customer['customer_name'];

$project->prepare($_POST);
$project->store();
