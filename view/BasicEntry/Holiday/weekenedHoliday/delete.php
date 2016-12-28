<?php

include_once '../../../../vendor/autoload.php';
use App\Holiday\WeekenedHoliday\WeekenedHoliday;

$holiday = new WeekenedHoliday();
$deleted = $holiday->prepare($_GET);
$dates = $holiday->delete();