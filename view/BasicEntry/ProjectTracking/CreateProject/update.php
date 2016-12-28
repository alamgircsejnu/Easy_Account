<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;
$_POST['companyId'] = $_SESSION['companyId'];

$ProjectTracking = new ProjectTracking();
$ProjectTracking->prepare($_POST);
$customer = $ProjectTracking->singleEntry($_POST['customerId']);
$_POST['customerName'] = $customer['customer_name'];
$ProjectTracking->prepare($_POST);

$ProjectTracking->update();