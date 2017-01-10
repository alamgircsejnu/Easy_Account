<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$_POST['companyId'] = $_SESSION['companyId'];
$project = new TaskExecution();
$project->prepare($_POST);
$allprojects = $project->ganttChart();
$employee = $project->employee();
$workingEmployee = $project->workingEmployee();

$temp = '';
$estDates = array();
$assignedDates = array();
$no = 0;
$d = new DateTime('', new DateTimeZone('Asia/Dhaka'));
for($i=0;$i<count($allprojects);$i++){
    $employeeName = $allprojects[$i]['assigned_to'];
    $sectionId = $allprojects[$i]['section_id'];
    $workingDates = $project->workingDateNumber($sectionId);

    $count = count($workingDates);
    $finalDays = $allprojects[$i]['latest_est_days']-$count;
    if ($temp==$employeeName){
        $newdate = strtotime ( '+'.$finalDays.' days' , strtotime ( $date ) ) ;
        $estDates[] = date ( 'Y-m-d' , $newdate );
        $updatedDays = $finalDays+1;
        $newDate2 = strtotime ( '+'.$updatedDays.' day' , strtotime ( $date ) ) ;
        $assignedDates[$i+1] = date ( 'Y-m-d' , $newDate2 );
        $date = $assignedDates[$i+1];
//        print_r($newAssignedDates);
//        die();
    }else{
        $assignedDates[$i] = $d->format('Y-m-d');
        $date = $assignedDates[$i];
        $newdate = strtotime ( '+'.$finalDays.' days' , strtotime ( $date ) ) ;
        $estDates[] = date ( 'Y-m-d' , $newdate );
        $updatedDays = $finalDays+1;
        $newDate2 = strtotime ( '+'.$updatedDays.' day' , strtotime ( $date ) ) ;
        $assignedDates[$i+1] = date ( 'Y-m-d' , $newDate2 );
        $date = $assignedDates[$i+1];

        $temp = $employeeName;
    }
}
$color = array('ganttGreen','ganttRed','ganttBlue','ganttOrange',);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>2RA Technology Limited</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=IE8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../../../../asset/css/main.css" type="text/css">

        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../../../asset/jQuery.Gantt/css/style.css" type="text/css" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css" rel="stylesheet" type="text/css">
        <style>
            body {
                background-image: url("../../../../asset/images/bg13.jpg");
            }

        </style>

        <style type="text/css">
            body {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 13px;
                padding: 0 0 50px 0;
            }
            .container{
                width: 100%;
                margin: 20px;
            }
            .gantt{
                width: 77%;
                margin-top: 25px;
                margin-left: 0;
                float: left;
            }
            #setPriority{
                margin: 25px;
            }
            #priorityBox{
                border: 1px solid gray;
                margin-left: 16px;
                width: 246px;
                min-height: 287px;
            }
            #setPriority td
            {
                padding:5px 15px 5px 15px;
            }
            #updatePriorityButton{
                position: absolute;
                right:    10px;
                bottom:   10px;
            }

            h1 {
                /*margin: 40px 0 20px 0;*/
            }
            #example {
                font-size: 1.5em;
                padding-bottom: 3px;
                border-bottom: 1px solid #DDD;
                /*margin-top: 50px;*/
                /*margin-bottom: 25px;*/
            }
            table th:first-child {
                width: 150px;
            }
            /* Bootstrap 3.x re-reset */
            .fn-gantt *,
            .fn-gantt *:after,
            .fn-gantt *:before {
              -webkit-box-sizing: content-box;
                 -moz-box-sizing: content-box;
                      box-sizing: content-box;
            }

        </style>
    </head>
    <body>
    <?php
    include_once '../../../../view/Navigation/Nav/Navbar/navigation.php';
    ?>
        <div class="container row" style="margin-left: 200px">
            <h2 id="example" style="font: italic bold 25px/30px Georgia, serif;;color: #010047;">
                Employee Engagement Report
            </h2>

            <div class="gantt" style="width: 850px"></div>
            <div id="setPriority">
                <div>
                    <div class="col-md-2" id="priorityBox">
                        <form action="updatePriority.php" method="post">
                        <label for="assignedTo" style="margin-bottom: 5px">Select Employee to Edit Priority </label>
                        <select required name="assignedTo" class="form-control col-sm-6 custom-input" id="assignedTo" style="height: 30px;font-size: 12px;margin-top: 5px;">
                            <option></option>
                            <?php
                            for ($i=0;$i<count($employee);$i++){
                                ?>
                                <option value="<?php echo $employee[$i]['assigned_to']?>"><?php echo $employee[$i]['assigned_to']?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div id="priorityOrder"></div>
                            <div id="updatePriorityButton"><input type="submit" value="Update Priority" ></div>
                        </form>
                    </div>

                </div>
            </div>
            <br><br><br><br>

        </div>
    <script src="../../../../asset/jQuery.Gantt/js/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="../../../../asset/jQuery.Gantt/js/jquery.fn.gantt.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
    <script>

        $(function() {
                $.ajax({
                    type :'POST',
                    dataType:'json',
                    async : true,
                    url : 'getAjaxDataForGanttChart.php',
                    success : function(result){
                        useData(result);
                    }
                })
            function useData(data) {

            "use strict";

                $(".gantt").gantt({
                source: [
                    <?php
                    $temp = '';
                    $colorNumber = 0;
                for($i=0;$i<count($allprojects);$i++){
                        $employeeName = $allprojects[$i]['assigned_to'];
                    if ($temp==$employeeName){
                   echo '{';
                echo  'desc: "'.$allprojects[$i]['section_id'].'",';
                echo  'values: [{';
                echo  'from: "/Date('.$assignedDates[$i].')/",';
                echo  'to: "/Date('.$estDates[$i].')/",';
                echo  'label: "'.$allprojects[$i]['section_id'].'",';
                echo  'customClass: "'.$color[$colorNumber].'",';
                echo  '}]';
                echo '},';
                    }else{
                        $colorNumber++;
                        if (isset($color[$colorNumber]) && !empty($color[$colorNumber])){

                        } else{
                            $colorNumber = 0;
                        }
                        echo '{';
                        echo  'name: "'.$allprojects[$i]['assigned_to'].'",';
                        echo  'desc: "'.$allprojects[$i]['section_id'].'",';
                        echo  'values: [{';
                        echo  'from: "/Date('.$assignedDates[$i].')/",';
                        echo  'to: "/Date('.$estDates[$i].')/",';
                        echo  'label: "'.$allprojects[$i]['section_id'].'",';
                        echo  'customClass: "'.$color[$colorNumber].'",';
                        echo  '}]';
                        echo '},';
                        $temp = $employeeName;
                    }
                }
                ?>
                ],
                    navigate: "scroll",
                    scale: "days",
                    maxScale: "months",
                    minScale: "days",
                    itemsPerPage: 10,
                    useCookie: false,
//                    onItemClick: function(data) {
//                        alert("Item clicked - show some details");
//                    },
//                    onAddClick: function(dt, rowId) {
//                        alert("Empty space clicked - add an item!");
//                    },
                    onRender: function() {
                        if (window.console && typeof console.log === "function") {
                            console.log("chart rendered");
                        }
                    }

        });
                prettyPrint();
        }
        });
    </script>
    <script type="text/javascript">
        $('#assignedTo').on('change', function(){
            assignedTo = $('#assignedTo option:selected').val();
//        console.log(assignedTo);// the dropdown item selected value
            $.ajax({
                type :'POST',
                dataType:'json',
                data : { assignedTo : assignedTo },
                url : 'getAjaxProjectPriorityData.php',
                success : function(result){
                    console.log(result);
                    var trHTML = '<tr><td>Section ID</td><td align="center">Priority</td></tr>';
                    $.each(result, function (i, item) {
//                        console.log(item.priority);
                        var pro=item.priority;
                        if (pro==1){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1" selected>1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==2){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2" selected>2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==3){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3" selected>3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==4){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4" selected>4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==5){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5" selected>5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==6){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6" selected>6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==7){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7" selected>7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==8){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8" selected>8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==9){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9" selected>9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }
                        else if (pro==10){
                            trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10" selected>10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                        }

                        var div = document.getElementById('priorityOrder');
                        while(div.firstChild){
                            div.removeChild(div.firstChild);
                        }
                        $('#priorityOrder').append(trHTML);

                    });
                }
            })

        });
    </script>
    <br><br><br><br><br><br><br><br><br><br>

    </body>
</html>
