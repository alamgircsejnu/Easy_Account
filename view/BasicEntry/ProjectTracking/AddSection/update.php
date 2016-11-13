<?php

include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;

//print_r($_POST);
//die();
$ProjectTracking = new AddSection();
$ProjectTracking->prepare($_POST);
$ProjectTracking->update();