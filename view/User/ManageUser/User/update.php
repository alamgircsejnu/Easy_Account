<?php
//session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;

    $permittedActions=$_POST['permittedActions'];
    $comma_separator=  implode(' , ', $permittedActions);
    $_POST['permittedActions']=$comma_separator;

$permittedCompanies=$_POST['permittedCompanies'];
$comma_separator_companies=  implode(' , ', $permittedCompanies);
$_POST['permittedCompanies']=$comma_separator_companies;

//    $password = $_POST['password'];
//
//    $hash = password_hash($password, PASSWORD_DEFAULT);
//
//    $_POST['password'] = $hash;

//echo $_POST['password'];

//if (password_verify($password, $hash)){
//    echo 'matched';
//die();

    $user = new User();
    $user->prepare($_POST);
    $user->update();

