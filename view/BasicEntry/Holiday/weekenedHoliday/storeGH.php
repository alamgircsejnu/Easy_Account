<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Holiday\WeekenedHoliday\WeekenedHoliday;

$_POST['companyId'] = $_SESSION['companyId'];
$from = $_POST['from'];
if (array_key_exists('toDate', $_POST)){
    $to = $_POST['to'];
} else {
    $to = $_POST['from'];
    $_POST['to'] = $_POST['from'];
}

$holiday = new WeekenedHoliday();
$dates = $holiday->createDateRangeArray($from,$to);

$dayNames = array();
for ($i=0;$i<count($dates);$i++){
    $date = $dates[$i];
    $day = date('l', strtotime($date));
    $dayNames[] = $day;
}
//print_r($holidays);
//die();

$_POST['dates'] = $dates;
$_POST['dayNames'] = $dayNames;

//print_r($_POST);
//die();

$dates = $holiday->prepare($_POST);

$holiday->storeGH();