<?php
include_once '../../../../vendor/autoload.php';

use App\Users\ManageUser\User;

//session_start();
$id = $_POST['id'];

$user = new User();
$oneUser = $user->show($id);