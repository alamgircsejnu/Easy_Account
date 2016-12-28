<?php
include_once '../../../../vendor/autoload.php';
use App\Holiday\WeekenedHoliday\WeekenedHoliday;


$from = $_POST['from'];
$to = $_POST['to'];

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