<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ChequeBook\ChequeBookEntry\ChequeBookEntry;
$_POST['companyId'] = $_SESSION['companyId'];

$chequeBook = new ChequeBookEntry();
$chequeBook->prepare($_POST);
$deleted = $chequeBook->deleteAll();
