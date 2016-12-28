<?php
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
session_start();

if(isset($_SESSION['id'])){
    $_POST['userName'] = $_SESSION['username'];
}
 session_destroy ();
session_unset($_SESSION['id']);

session_start();
$user = new User();
$user->prepare($_POST);
$oneUser = $user->employeeInfo();
$_SESSION['successMessage'] = 'Goodbye, <b>'.$oneUser['first_name'].' '.$oneUser['last_name'].'</b>';

header('Location:../Login/login.php');


