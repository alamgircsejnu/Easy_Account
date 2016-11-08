<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Employee\ManageEmployee\Employee;

//print_r($_POST);
//die();
$user = new Employee();
$user->prepare($_POST);
$user->store();
