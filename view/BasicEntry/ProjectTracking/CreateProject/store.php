<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;

//print_r($_POST);
//die();

//echo $_SESSION['employeeName'];
//die();

$_POST['createdBy'] = $_SESSION['employeeName'];
$user = new ProjectTracking();
$user->prepare($_POST);
$user->store();
