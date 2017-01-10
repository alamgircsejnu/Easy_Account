<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Shift\ShiftEntry\ShiftEntry;

$_POST['companyId'] = $_SESSION['companyId'];

//print_r($_POST);
//die();

$shift = new ShiftEntry();

$prepareShift = $shift->prepare($_POST);
$shift->store();
//print_r($prepareAttendense);