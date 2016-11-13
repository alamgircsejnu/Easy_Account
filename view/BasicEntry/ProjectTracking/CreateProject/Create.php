<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){

$task = new ProjectTracking();
$lastTask = $task->lastEntry();
if (isset($lastTask) && !empty($lastTask)){
$lastTaskId = $lastTask['project_id'];
$taskYear = substr($lastTaskId,1,4);
$currentYear =  date('Y');
if ($taskYear==$currentYear){

$taskNumber = substr($lastTaskId,5);
$newTaskNumber = (int)$taskNumber +1;
$newTaskId = 'T'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
} else{
    $newTaskNumber = 1000;
    $newTaskId = 'T'.date('Y').$newTaskNumber;
}
} else{
    $newTaskNumber = 1000;
    $newTaskId = 'T'.date('Y').$newTaskNumber;
}
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
    <div style="width: 200px">
        <?php

        if (isset($_SESSION['successMessage'])) {
            echo '<h2 style="color: green;>' . $_SESSION['successMessage'] . '</h2><br>';
            unset($_SESSION['successMessage']);
        } else if (isset($_SESSION['errorMessage'])) {
            echo '<h2 style="color: red;>' . $_SESSION['errorMessage'] . '</h2><br>';
            unset($_SESSION['errorMessage']);
        }

        ?>
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-6">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Create New Task</div>
            <br>
            <form role="form" action="store.php" method="post">

                <div>
                    <div class="col-md-6">
                        <label for="projectId" style="margin-top: 5px">Task ID</label>
                        <input type="text" id="projectId" name="projectId" class="form-control custom-input"
                             value="<?php echo $newTaskId ?>"  placeholder="Project ID" required>
                    </div>
                    <div class="col-md-6">
                        <label for="customerName" style="margin-top: 5px">Customer Name</label>
                        <input type="text" id="customerName" name="customerName" class="form-control custom-input"
                               placeholder="Customer Name" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="projectName" style="margin-top: 5px">Task Name</label>
                        <input type="text" id="projectName" name="projectName" class="form-control custom-input"
                               placeholder="Project Name" required>
                    </div>

                    <br><br>
                </div>

                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Create Task</button>
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


<script src="jquery.checkAll.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>
<script>
    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            if (this.checked)
                $(".checkBoxClass").prop('checked', "checked");
            else
                $(".checkBoxClass").removeProp('checked');
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#dateOfBirth").datepicker({
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
</body>
</html>

<?php } ?>