<?php
$date1 = new DateTime($_POST['assignedDate']);
$date2 = new DateTime($_POST['estimatedDate']);
$interval = $date1->diff($date2);
//echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";

// shows the total amount of days (not divided into years, months and days like above)
$days = $interval->days;
//$formatDiff = $diff->format("%R%a");
echo json_encode($days);
