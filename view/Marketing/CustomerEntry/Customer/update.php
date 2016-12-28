<?php

include_once '../../../../vendor/autoload.php';
use App\Marketing\Customer\Customer;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$customer = new Customer();
$customer->prepare($_POST);
$customer->update();