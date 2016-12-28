<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
$_POST['companyId'] = $_SESSION['companyId'];
$employeeId = $_POST['employeeId'];
$user = new User();
$user->prepare($_POST);
$oneUser = $user->findUser($employeeId);

if(md5($_POST['currentPassword'])==$oneUser['password'] && $_POST['newPassword']==$_POST['retypeNewPassword']){
    $password = $_POST['newPassword'];
    $hash = md5($password);

    $_POST['newPassword'] = $hash;
    $user->prepare($_POST);
    $oneUser = $user->resetPassword($employeeId);
    $_SESSION['auccessMessage'] = 'Password has been reset successfully';
} else {
    $_SESSION['errorMessage'] = 'Your given password is wrong';
    header('location:ResetPasswordForm.php');
}