<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ChequeBook\ChequeBookEntry\ChequeBookEntry;
$_POST['companyId'] = $_SESSION['companyId'];
    $account = new ChequeBookEntry();
    $account->prepare($_POST);
    $accountNumbers = $account->accountNumbers();
//print_r($companies);

echo json_encode($accountNumbers);