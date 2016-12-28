<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Income\Income;
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];
$delete = new Income();
$deleted = $delete->prepare($_POST);
$delete->delete();