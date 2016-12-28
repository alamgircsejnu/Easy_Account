<?php

include_once '../../../../vendor/autoload.php';
use App\Marketing\Promotion\Promotion;
$_POST['companyId'] = $_SESSION['companyId'];
//print_r($_POST);
//die();
$promotion = new Promotion();
$promotion->prepare($_POST);
$promotion->update();