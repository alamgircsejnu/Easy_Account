<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Supplier\SupplierEntry\SupplierEntry;
use App\Employee\ManageEmployee\Employee;
use App\Negotiator\NegotiatorEntry\Negotiator;
$_POST['companyId'] = $_SESSION['companyId'];
if (isset($_POST['vendor']) && !empty($_POST['vendor'])){
$vendor = new SupplierEntry();
$vendor->prepare($_POST);
$allData = $vendor->index();
}elseif (isset($_POST['negotiator']) && !empty($_POST['negotiator'])){
    $negotiator = new Negotiator();
    $negotiator->prepare($_POST);
    $allData = $negotiator->index();
}else{
    $employee = new Employee();
    $employee->prepare($_POST);
    $allData = $employee->index();
}
echo json_encode($allData);