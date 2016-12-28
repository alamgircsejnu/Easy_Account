<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Holiday\WeekenedHoliday\WeekenedHoliday;
$_POST['companyId'] = $_SESSION['companyId'];

$holiday = new WeekenedHoliday();
$holiday->prepare($_POST);
$dates = $holiday->deleteAll();
