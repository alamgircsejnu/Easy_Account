<?php
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
session_start();

if(isset($_SESSION['id'])){
    $employeeId = $_SESSION['id'];
}
 session_destroy ();
session_unset($_SESSION['id']);

session_start();
$user = new User();
$oneUser = $user->employeeInfo($employeeId);
$_SESSION['successMessage'] = '<h3>Goodbye, <b>'.$oneUser['first_name'].'</b></h3>';

header('Location:../Login/login.php');


