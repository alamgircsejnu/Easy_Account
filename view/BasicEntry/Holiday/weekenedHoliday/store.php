<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Holiday\WeekenedHoliday\WeekenedHoliday;
$_POST['companyId'] = $_SESSION['companyId'];

$from = $_POST['from'];
$to = $_POST['to'];
$weekenedHolidays = $_POST['weekenedHolidays'];

//print_r($_POST);
//die();

$holiday = new WeekenedHoliday();
$dates = $holiday->createDateRangeArray($from,$to);

$dayNames = array();
$holidays = array();
for ($i=0;$i<count($dates);$i++){
    $date = $dates[$i];
    $day = date('l', strtotime($date));
    for ($j=0;$j<count($weekenedHolidays);$j++){
        if ($day==$weekenedHolidays[$j]){
           $dayNames[] = $day;
            $holidays[] = $date;
        }
    }
}
//print_r($holidays);
//die();

$_POST['dates'] = $holidays;
$_POST['dayNames'] = $dayNames;

$dates = $holiday->prepare($_POST);

$holiday->store();


