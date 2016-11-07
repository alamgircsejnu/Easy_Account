<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;

$delete = new User();
$deleted = $delete->prepare($_GET);
$delete->trash();