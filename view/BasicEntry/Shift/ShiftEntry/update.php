<?php

include_once '../../../../vendor/autoload.php';
use App\Shift\ShiftEntry\ShiftEntry;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$shift = new ShiftEntry();
$shift->prepare($_POST);
$shift->update();