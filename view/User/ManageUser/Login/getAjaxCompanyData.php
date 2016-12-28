<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
//$_POST['employeeId'] = '2016136';
    $user = new User();
    $user->prepare($_POST);
    $oneUser = $user->employeeCompany();
    $companies = explode(',', $oneUser['permitted_companies']);
//print_r($companies);

echo json_encode($companies);