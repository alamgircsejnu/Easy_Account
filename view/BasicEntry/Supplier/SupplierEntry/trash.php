<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Supplier\SupplierEntry\SupplierEntry;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new SupplierEntry();
$deleted = $delete->prepare($_POST);
$delete->trash();