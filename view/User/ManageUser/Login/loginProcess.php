<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
//print_r($_POST);
//die();
$_SESSION['companyId']  = $_POST['companyId'];
use App\Users\Company\Company;
$company = new Company();
$oneCompany = $company->show($_POST['companyId']);

$_SESSION['companyName']=$oneCompany['company_name'];

$username = $_POST['userName'];
$password = $_POST['password'];
//echo $_SESSION['username'].$_SESSION['password'];
$user = new User();
$user->prepare($_POST);
$oneData = $user->login();
$oneEmployee = $user->employeeInfo();


$hash = md5($_POST['password']);



if($username == $oneData['user_name'] && $hash == $oneData['password']){
    $_SESSION['id'] = $oneData['id'];
    $_SESSION['username'] = $oneData['user_name'];
    $_SESSION['admin'] = $oneData['is_admin'];
    $_SESSION['permitted_actions'] = $oneData['permitted_actions'];
    $_SESSION['password'] = $password;
    $_SESSION['employeeName'] = $oneEmployee['first_name'].' '.$oneEmployee['last_name'];
    $_SESSION['successMessage'] = 'Welcome, <b>'.$_SESSION['employeeName'].' </b>. You are successfully logged in.';

//    print_r($_SESSION);
//    header('Location:../ChangeCompany/changeCompany.php');
    header('location:../../../../index.php');
}
else {
    $_SESSION['errorMessage'] = 'Invalid username or password';
    header('Location:login.php');
}


?>

