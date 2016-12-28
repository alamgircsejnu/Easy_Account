<?php

include_once '../../../../vendor/autoload.php';
use App\Marketing\Offer\Offer;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$offer = new Offer();
$offer->prepare($_POST);
$offer->update();