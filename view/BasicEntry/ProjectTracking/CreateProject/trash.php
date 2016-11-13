<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;


$delete = new ProjectTracking();
$deleted = $delete->prepare($_GET);
$delete->trash();