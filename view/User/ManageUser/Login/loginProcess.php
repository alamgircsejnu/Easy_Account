<?php
//include './navigation.php';
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
session_start();
//print_r($_POST);
//die();
$username = stripcslashes($_POST['employeeId']);
$password = stripcslashes($_POST['password']);
$_POST['userName'] = $username;
$_POST['password'] = $password;
//echo $_SESSION['username'].$_SESSION['password'];
$user = new User();
$user->prepare($_POST);
$oneData = $user->login();
//$oneUser = $user->showIndex($oneData['id']);
//print_r($oneData);
if($username == $oneData['user_name'] && password_verify($password, $oneData['password'])){
    $_SESSION['id'] = $oneData['id'];
    $_SESSION['username'] = $oneData['user_name'];
    $_SESSION['password'] = $password;
    $_SESSION['successMessage'] = '<h4>Welcome, <b>'.$oneUser['first_name'].' '.$oneUser['last_name'].'</b>. You are successfully logged in.</h4>';
    header('Location:../../../../index.php');
} else {
    $_SESSION['Message'] = '<h2>Invalid username or password</h2>';
    header('Location:../../../../index.php');
}
?>

