<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;


$finish = new ProjectTracking();
$finished = $finish->prepare($_GET);
$finish->finish();