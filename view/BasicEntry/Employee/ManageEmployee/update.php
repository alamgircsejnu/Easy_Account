<?php

include_once '../../../../vendor/autoload.php';
use App\Employee\ManageEmployee\Employee;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$employee = new Employee();
$employee->prepare($_POST);
$employee->update();