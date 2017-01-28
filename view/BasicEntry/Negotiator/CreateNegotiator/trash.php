<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Negotiator\NegotiatorEntry\Negotiator;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['id'] = $_GET['id'];

$delete = new Negotiator();
$deleted = $delete->prepare($_POST);
$delete->trash();