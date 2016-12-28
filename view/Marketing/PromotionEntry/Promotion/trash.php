<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Promotion\Promotion;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new Promotion();
$deleted = $delete->prepare($_POST);
$delete->trash();