<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ExpenseType\Expense\Expense;

$delete = new Expense();
$deleted = $delete->prepare($_GET);
$delete->delete();