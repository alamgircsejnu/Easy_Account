<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Employee\ManageEmployee\Employee;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new Employee();
$deleted = $delete->prepare($_POST);
$delete->trash();