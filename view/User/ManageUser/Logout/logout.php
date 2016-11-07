<?php
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
session_destroy();

header('Location:../../../../index.php');

