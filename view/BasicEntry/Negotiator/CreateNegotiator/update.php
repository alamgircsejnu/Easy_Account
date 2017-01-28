<?php

include_once '../../../../vendor/autoload.php';
use App\Negotiator\NegotiatorEntry\Negotiator;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$negotiator = new Negotiator();
$negotiator->prepare($_POST);
$negotiator->update();