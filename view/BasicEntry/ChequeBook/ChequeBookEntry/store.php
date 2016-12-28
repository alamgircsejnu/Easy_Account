<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ChequeBook\ChequeBookEntry\ChequeBookEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['entryBy'] = $_SESSION['employeeName'];

$chequeBook = new ChequeBookEntry();
$chequeBook->prepare($_POST);
$chequeBook->store();