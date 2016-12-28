<?php
session_start();

include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;

$taskId = $_POST['taskId'];

$section = new AddSection();
$oneSection = $section->lastEntry($taskId);

if (isset($oneSection) && !empty($oneSection)){
    $section = $oneSection['section_id'];
    $exploded = explode('-',$section);
    $exploded[1] = (int)$exploded[1]+1;
    if ($exploded[1]<10){
    $exploded[1] = '0'.$exploded[1];
    }
    $sectionId = implode('-',$exploded);


} else {
    $projectId = $oneSection['project_id'];
    $sectionId = $taskId.'-01';
}

echo json_encode($sectionId);