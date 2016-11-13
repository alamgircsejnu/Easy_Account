<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;


$delete = new AddSection();
$deleted = $delete->prepare($_GET);
$delete->trash();