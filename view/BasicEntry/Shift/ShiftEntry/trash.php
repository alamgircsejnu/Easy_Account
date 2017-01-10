<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Shift\ShiftEntry\ShiftEntry;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new ShiftEntry();
$deleted = $delete->prepare($_POST);
$delete->trash();