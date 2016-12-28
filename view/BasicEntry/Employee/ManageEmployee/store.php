<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Employee\ManageEmployee\Employee;

$_POST['companyId'] = $_SESSION['companyId'];
$user = new Employee();
$user->prepare($_POST);
$user->store();
