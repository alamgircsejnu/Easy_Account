<?php

include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;

//print_r($_POST);
//die();
$ProjectTracking = new ProjectTracking();
$ProjectTracking->prepare($_POST);
$ProjectTracking->update();