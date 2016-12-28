<?php
session_start();
$_SESSION['companyId']=$_POST['companyId'];


include_once '../../../../vendor/autoload.php';

use App\Users\Company\Company;
    $company = new Company();
    $oneCompany = $company->show($_POST['companyId']);

$_SESSION['companyName']=$oneCompany['company_name'];

$_SESSION['successMessage']="You are now working in ".$_SESSION['companyName'];

header('location:../../../../index.php');

