<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\Role\Role;

$_POST['companyId'] = $_SESSION['companyId'];

$user = new Role();
$user->prepare($_POST);
$user->store();
