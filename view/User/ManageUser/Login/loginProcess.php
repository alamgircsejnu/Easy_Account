<?php
//include './navigation.php';
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
session_start();
//print_r($_POST);
//die();
$username = $_POST['userName'];
$password = $_POST['password'];
//echo $_SESSION['username'].$_SESSION['password'];
$user = new User();
$user->prepare($_POST);
$oneData = $user->login();

//print_r($_POST);
//die();
$oneEmployee = $user->employeeInfo();



if($username == $oneData['user_name'] && password_verify($_POST['password'], $oneData['password'])){
    $_SESSION['id'] = $oneData['id'];
    $_SESSION['username'] = $oneData['user_name'];
    $_SESSION['admin'] = $oneData['is_admin'];
    $_SESSION['permitted_actions'] = $oneData['permitted_actions'];
    $_SESSION['password'] = $password;
    $_SESSION['employeeName'] = $oneEmployee['first_name'].' '.$oneEmployee['last_name'];
    $_SESSION['successMessage'] = 'Welcome, <b>'.$_SESSION['employeeName'].' </b>. You are successfully logged in.';

//    print_r($_SESSION);
    header('Location:../../../../index.php');

}
else {
    $_SESSION['errorMessage'] = 'Invalid username or password';
    header('Location:login.php');
}


?>

