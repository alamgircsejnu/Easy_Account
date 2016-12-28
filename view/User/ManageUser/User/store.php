<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
//print_r($_POST);
//die();

if ($_POST['password'] == $_POST['retypePassword']){
$_POST['companyId'] = $_SESSION['companyId'];
$permittedActions=$_POST['permittedActions'];
$comma_separator=  implode(' , ', $permittedActions);
//echo $comma_separator;
$_POST['permittedActions']=$comma_separator;

$permittedCompanies=$_POST['permittedCompanies'];
$comma_separator_company=  implode(' , ', $permittedCompanies);
//echo $comma_separator;
$_POST['permittedCompanies']=$comma_separator_company;

$password = $_POST['password'];

$hash = md5($password);

$_POST['password'] = $hash;

$user = new User();
$user->prepare($_POST);
$user->store();
} else {
    $_SESSION['errorMessage'] = "Password doesn't match";
    header('location:create.php');

}