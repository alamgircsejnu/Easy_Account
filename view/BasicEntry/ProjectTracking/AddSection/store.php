<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;

//print_r($_POST);
//die();

$user = new AddSection();
$user->prepare($_POST);
$user->store();
