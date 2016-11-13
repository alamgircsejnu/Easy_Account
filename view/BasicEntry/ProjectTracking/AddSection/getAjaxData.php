<?php
session_start();

include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;

$taskId = $_POST['selectLoco'];
//$query = "SELECT * FROM misc_location WHERE id = '$selectLoco' ";
//
//$result = mysql_query($query);
//$row = mysql_fetch_assoc($result);

//console.log($taskId);


$section = new AddSection();
$oneSection = $section->lastEntry(20161000);
print_r($oneSection);
//
//$sectionId = $oneSection['section_id'];
//return $sectionId;

//return json_encode($_POST['project_id']);

//echo json_encode($oneSection['section_id']);