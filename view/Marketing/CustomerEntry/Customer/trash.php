<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Customer\Customer;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new Customer();
$deleted = $delete->prepare($_POST);
$delete->trash();