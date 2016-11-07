<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\Role\Role;

//print_r($_POST);
//die();

$user = new Role();
$user->prepare($_POST);
$user->store();
