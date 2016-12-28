<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;
$_POST['companyId'] = $_SESSION['companyId'];
$assignedBy = $_SESSION['employeeName'];
$_POST['assignedBy'] = $assignedBy;
$section = new AddSection();
$section->prepare($_POST);
$section->store();
