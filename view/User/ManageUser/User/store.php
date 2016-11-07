<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
//var_dump($_POST);

if ($_POST['password'] == $_POST['retypePassword']){
$permittedActions=$_POST['permittedActions'];
$comma_separator=  implode(' , ', $permittedActions);
//echo $comma_separator;
$_POST['permittedActions']=$comma_separator;
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$_POST['password'] = $hash;

//echo $_POST['password'];

//if (password_verify($password, $hash)){
//    echo 'matched';
//die();

$user = new User();
$user->prepare($_POST);
$user->store();
} else {
    $_SESSION['errorMessage'] = "Pasword Mis-matched";
    header('location:create.php');

}