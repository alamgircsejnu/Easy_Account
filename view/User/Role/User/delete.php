<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\Role\Role;

$delete = new Role();
$deleted = $delete->prepare($_GET);
$delete->delete();