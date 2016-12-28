<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Offer\Offer;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new Offer();
$deleted = $delete->prepare($_POST);
$delete->trash();