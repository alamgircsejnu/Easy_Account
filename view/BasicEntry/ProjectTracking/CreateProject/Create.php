<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
$_POST['companyId'] = $_SESSION['companyId'];
$task = new ProjectTracking();
$task->prepare($_POST);
$lastTask = $task->lastEntry();
$customers = $task->customers();
if (isset($lastTask) && !empty($lastTask)){
$lastTaskId = $lastTask['project_id'];
$taskYear = substr($lastTaskId,2,4);
//    echo $taskYear;
//    die();
$currentYear =  date('Y');
if ($taskYear==$currentYear){

$taskNumber = substr($lastTaskId,6);
$newTaskNumber = $taskNumber +1;
$newTaskId = 'PR'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
} else{
    $newTaskNumber = '1001';
    $newTaskId = 'PR'.date('Y').$newTaskNumber;
}
} else{
    $newTaskNumber = '1001';
    $newTaskId = 'PR'.date('Y').$newTaskNumber;
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
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php

        if (isset($_SESSION['successMessage'])) {
            echo '<h5 style="color: green;background-color: ghostwhite;text-align: center">' . $_SESSION['successMessage'] . '</h5><br>';
            unset($_SESSION['successMessage']);
        } else if (isset($_SESSION['errorMessage'])) {
            echo '<h5 style="color: red;background-color: ghostwhite;text-align: center">' . $_SESSION['errorMessage'] . '</h5><br>';
            unset($_SESSION['errorMessage']);
        }

        ?>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Create New Project</div>
            <br>
            <form role="form" action="store.php" method="post">

                <div>
                    <div class="col-md-6">
                        <label for="projectId" style="margin-top: 5px">Project ID</label>
                        <input type="text" id="projectId" name="projectId" class="form-control custom-input"
                             value="<?php echo $newTaskId ?>"  placeholder="Project ID" required>
                    </div>
                    <div class="col-md-6">
                        <label for="customerId" style="margin-top: 5px">Customer Name</label>
                        <select name="customerId" class="form-control col-sm-6 custom-input" id="customerId">
                            <?php
                            for ($i=0;$i<count($customers);$i++){
                            ?>
                            <option value="<?php echo $customers[$i]['customer_id']?>"><?php echo $customers[$i]['customer_name']?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="projectName" style="margin-top: 5px">Project Name</label>
                        <input type="text" id="projectName" name="projectName" class="form-control custom-input"
                               placeholder="Project Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="POAmount" style="margin-top: 5px">PO Amount</label>
                        <input type="text" id="POAmount" name="POAmount" class="form-control custom-input"
                               placeholder="PO Amount" required>
                    </div>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <label for="PODate" style="margin-top: 5px">PO Date</label>
                    <input type="text" id="PODate" name="PODate" class="form-control custom-input"
                           placeholder="PO Date" required>
                </div>
                <div class="col-md-6">
                    <label for="deliveryDate" style="margin-top: 5px">Delivery Date</label>
                    <input type="text" id="deliveryDate" name="deliveryDate" class="form-control custom-input"
                           placeholder="Delivery Date" required>
                </div>
                <br><br><br>
                <div class="col-md-12">
                    <label for="description" style="margin-top: 5px">Description</label>
                    <input type="text" id="description" name="description" class="form-control custom-input"
                           placeholder="Description">
                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Create Project</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <div class="col-md-4"></div>
</div>
</div>
</div>
<!-- /#page-content-wrapper -->
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
        $("#PODate").datepicker({
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
        $("#deliveryDate").datepicker({
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
<br><br><br><br><br><br>
</body>
</html>

<?php } ?>