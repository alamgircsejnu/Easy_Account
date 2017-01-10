<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
use App\ProjectTracking\CreateProject\ProjectTracking;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){

    $id = $_GET['id'];
    $task = new TaskExecution();
    $oneTask = $task->show($id);
//    print_r($oneTask);
//    die();


    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>
            2RA Technology Limited
        </title>

        <link rel="stylesheet" href="../../../../asset/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../../../../asset/css/main.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link href="../../../../asset/js/css/blitzer/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">

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
    </head>

    <body>

    <?php
    include_once '../../../../view/Navigation/Nav/Navbar/navigation.php';
    ?>

    <br><br>

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Execute Task</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <input type="hidden" name="id" value="<?php echo $id ?>">

                    <div>
                        <div class="col-md-6">
                            <label for="projectId" style="margin-top: 5px">Task ID</label>
                            <input type="text" id="projectId" name="projectId" class="form-control custom-input"
                                   value="<?php echo $oneTask['project_id'] ?>"  placeholder="Project ID" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="sectionId" style="margin-top: 5px">Section ID</label>
                            <input type="text" id="sectionId" name="sectionId" class="form-control custom-input"
                                   value="<?php echo $oneTask['section_id'] ?>" placeholder="Section ID" required readonly>
                        </div>
                        <br><br><br>
                        <input type="hidden" id="assignedDate" name="assignedDate" class="form-control custom-input"
                               value="<?php echo $oneTask['assigned_date'] ?>">
                        <div class="col-md-6">
                            <label for="previousEstDate" style="margin-top: 5px">Previous Estimated Date</label>
                            <input type="text" id="previousEstDate" name="previousEstDate" class="form-control custom-input"
                                   value="<?php echo $oneTask['primary_est_date'] ?>"  placeholder="Previous Estimated Date" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="latestEstDate" style="margin-top: 5px">Latest Estimated Date</label>
                            <input type="text" id="latestEstDate" name="latestEstDate" class="form-control custom-input"
                                   value="<?php echo $oneTask['est_date'] ?>"   placeholder="Latest Estimated Date" required>
                        </div>

                        <div class="col-md-6">
                            <label for="latestEstDays" style="margin-top: 5px">Latest Estimated Days</label>
                            <input type="text" id="latestEstDays" name="latestEstDays" class="form-control custom-input"
                                   value="<?php echo $oneTask['latest_est_days'] ?>"   placeholder="Latest Estimated Date" required>
                        </div>

                        <br><br><br>
                        <div class="col-md-6">
                            <label for="hourWorkedToday" style="margin-top: 5px">Hour Worked Today</label>
                            <input type="text" id="hourWorkedToday" name="hourWorkedToday" class="form-control custom-input"
                                   placeholder="Hour Worked Today">
                        </div>

                        <br><br>
                    </div>

                    <br><br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="col-md-4"></div>
    </div>


    <br><br><br><br>
    <script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


<!--    <script src="jquery.checkAll.js"></script>-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>
<!--    <script>-->
<!--        $(document).ready(function () {-->
<!--            $("#ckbCheckAll").click(function () {-->
<!--                if (this.checked)-->
<!--                    $(".checkBoxClass").prop('checked', "checked");-->
<!--                else-->
<!--                    $(".checkBoxClass").removeProp('checked');-->
<!--            });-->
<!--        });-->
<!--    </script>-->

    <script type="text/javascript">
        $(function () {
            $("#latestEstDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+10"
            });
        });
    </script>
    <style>
        .ui-datepicker{
            font-size: 15px;
        }
    </style>

    <script type="text/javascript">
        $(function () {
            $("#joiningDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-80:+15"
            });
        });
    </script>
    <style>
        .ui-datepicker{
            font-size: 15px;

        }
        .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
            color: #2b669a;
            font-family: ...;
            font-size: 16px;
            font-weight: bold;
        }

    </style>
    <script type="text/javascript">
        $('#latestEstDate').on('change', function(){
            latestEstDate = $('#latestEstDate').val();
            assignedDate = $('#assignedDate').val();// the dropdown item selected value
            $.ajax({
                type :'POST',
                dataType:'json',
                data : { latestEstDate : latestEstDate,assignedDate : assignedDate},
                url : 'getAjaxDateDiff.php',
                success : function(result){
                    console.log(result);
//                $('#sectionId).val(result('section_id'));
                    $("#latestEstDays").val(result)
                }
            })

        });

    </script>
    </body>
    </html>

<?php } ?>