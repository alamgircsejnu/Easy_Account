<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;
$_POST['companyId'] = $_SESSION['companyId'];
$expense = new Expense();
$expense->prepare($_POST);
$singleVoucher = $expense->singleVoucher();
$voucherData = array();
$amount = 0;
foreach ($singleVoucher as $voucher){
    $amount+=$voucher['amount'];
}
$_POST['projectId'] = $singleVoucher[0]['project_id'];
$expense->prepare($_POST);
$projectDetails = $expense->projectDetails();
$voucherData['amount'] = $amount;
$voucherData['expenseType'] = $singleVoucher[0]['expense_type'];
$voucherData['expDate'] = $singleVoucher[0]['date'];
$voucherData['expensedBy'] = $singleVoucher[0]['employee_id'];
$voucherData['projectId'] = $singleVoucher[0]['project_id'];
$voucherData['expenseId'] = $singleVoucher[0]['voucher_no'];
$voucherData['projectName'] = $projectDetails['project_name'];
$voucherData['customerName'] = $projectDetails['customer_name'];

echo json_encode($voucherData);