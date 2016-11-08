<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Employee\ManageEmployee\Employee;


$delete = new Employee();
$deleted = $delete->prepare($_GET);
$delete->trash();