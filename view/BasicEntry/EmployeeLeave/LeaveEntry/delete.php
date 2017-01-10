<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\EmployeeLeave\ManageLeave\ManageLeave;
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['employeeId'] = $_SESSION['username'];

$delete = new ManageLeave();
$deleted = $delete->prepare($_GET);
$dates = $delete->delete();