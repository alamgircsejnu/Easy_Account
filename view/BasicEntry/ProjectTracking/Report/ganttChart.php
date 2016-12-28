<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$project = new TaskExecution();
$allprojects = $project->ganttChart();
echo $allprojects[0]['assigned_date'].'<br>';
echo $allprojects[0]['est_date'].'<br>';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Employee Engagement Report</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=IE8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../../../asset/jQuery.Gantt/css/style.css" type="text/css" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../../../../asset/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../../../../asset/css/main.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <script type="text/javascript">
            $(document).ready(function () {
                $('dropdown-toggle').dropdown()
            });
        </script>

        <style>
            body {
                background-image: url("../../../../asset/images/bg13.jpg");
                /*background-repeat: repeat-x;*/
            }

            .custom-input {
                height: 29px;
            }
        </style>
        <style type="text/css">
            body {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 13px;
                padding: 0 0 50px 0;
            }
            h1 {
                margin: 40px 0 20px 0;
            }
            #example {
                font-size: 1.5em;
                padding-bottom: 3px;
                border-bottom: 1px solid #DDD;
                margin-top: 50px;
                margin-bottom: 25px;
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
        <div class="container">

          

            <h2 id="example">
                Employee Engagement Report
            </h2>

            <div class="gantt"></div>

        </div>

    <script src="../../../../asset/jQuery.Gantt/js/jquery.min.js"></script>
<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>-->
    <script src="../../../../asset/jQuery.Gantt/js/jquery.fn.gantt.js"></script>
<!--    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js"></script>-->
<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>-->
    <script>
        $(function() {

            "use strict";

            $(".gantt").gantt({
                source: [{
                    name: "Sprint 0",
                    desc: "Analysis(Test)",
                    values: [{
                        from: "/Date(2016-11-20)/",
                        to: "/Date(2017-03-30)/",
                        label: "Requirement Gathering",
                        customClass: "ganttRed"
                    }]
                },{
                    desc: "For Testing",
                    values: [{
                        from: "/Date(1479769200)/",
                        to: "/Date(1478818800)/",
                        label: "Scoping",
                        customClass: "ganttRed"
                    }]
                },{
                    name: "Sprint 1",
                    desc: "Development",
                    values: [{
                        from: "/Date(1323802400000)/",
                        to: "/Date(1325685200000)/",
                        label: "Development",
                        customClass: "ganttGreen"
                    }]
                },{
                    name: " ",
                    desc: "Showcasing",
                    values: [{
                        from: "/Date(1325685200000)/",
                        to: "/Date(1325695200000)/",
                        label: "Showcasing",
                        customClass: "ganttBlue"
                    }]
                },{
                    name: "Sprint 2",
                    desc: "Development",
                    values: [{
                        from: "/Date(1326785200000)/",
                        to: "/Date(1325785200000)/",
                        label: "Development",
                        customClass: "ganttGreen"
                    }]
                },{
                    desc: "Showcasing",
                    values: [{
                        from: "/Date(1328785200000)/",
                        to: "/Date(1328905200000)/",
                        label: "Showcasing",
                        customClass: "ganttBlue"
                    }]
                },{
                    name: "Release Stage",
                    desc: "Training",
                    values: [{
                        from: "/Date(1330011200000)/",
                        to: "/Date(1336611200000)/",
                        label: "Training",
                        customClass: "ganttOrange"
                    }]
                },{
                    desc: "Deployment",
                    values: [{
                        from: "/Date(1336611200000)/",
                        to: "/Date(1338711200000)/",
                        label: "Deployment",
                        customClass: "ganttOrange"
                    }]
                },{
                    desc: "Warranty Period",
                    values: [{
                        from: "/Date(1336611200000)/",
                        to: "/Date(1349711200000)/",
                        label: "Warranty Period",
                        customClass: "ganttOrange"
                    }]
                }],
                navigate: "scroll",
                scale: "days",
                maxScale: "months",
                minScale: "days",
                itemsPerPage: 10,
                useCookie: false,
                onItemClick: function(data) {
                    alert("Item clicked - show some details");
                },
                onAddClick: function(dt, rowId) {
                    alert("Empty space clicked - add an item!");
                },
                onRender: function() {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });

            $(".gantt").popover({
                selector: ".bar",
                title: "I'm a popover",
                content: "And I'm the content of said popover.",
                trigger: "hover"
            });

            prettyPrint();

        });
    </script>
<br><br><br>
    </body>
</html>
