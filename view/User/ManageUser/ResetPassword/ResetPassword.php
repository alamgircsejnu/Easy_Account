<?php
include_once '../../../../vendor/autoload.php';
session_start();
use App\Users\ManageUser\User;
$employeeId = $_POST['employeeId'];
$user = new User();
$oneUser = $user->findUser($employeeId);

if(password_verify($_POST['currentPassword'],$oneUser['password']) && $_POST['newPassword']==$_POST['retypeNewPassword']){
    $password = $_POST['newPassword'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $_POST['newPassword'] = $hash;
    $user->prepare($_POST);
    $oneUser = $user->resetPassword($employeeId);
    $_SESSION['auccessMessage'] = 'Password has been reset successfully';
} else {
    $_SESSION['errorMessage'] = 'Your given password is wrong';
    header('location:ResetPasswordForm.php');
}