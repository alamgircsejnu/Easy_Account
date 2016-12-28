<?php

include_once '../../../../vendor/autoload.php';
use App\Supplier\SupplierEntry\SupplierEntry;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$supplier = new SupplierEntry();
$supplier->prepare($_POST);
$supplier->update();