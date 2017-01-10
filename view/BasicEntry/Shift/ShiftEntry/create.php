<?php
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
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

<!--    .............................. Time Picker ..............................-->
    <link href="../../../../asset/bootstrap-timepicker/css/timepicker.less" rel="stylesheet" type="text/css">
    <link href="../../../../asset/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
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

    <div class="col-md-4"></div>

    <div class="col-md-5" style="font-family: 'Times New Roman'">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Shift Entry Form</div>
            <br>
            <form role="form" action="store.php" method="post">

                <div>
                    <div class="col-md-6">
                        <label for="shiftName" style="margin-top: 5px">Shift Title</label>
                        <input type="text" id="shiftName" name="shiftName" class="form-control custom-input" >
                    </div>

                    <br><br><br><br>
                    <div class="col-md-4">
                        <label for="shiftStart" style="margin-top: 5px">Shift Start</label>
                        <input type="text" id="shiftStart" name="shiftStart" class="form-control custom-input" >
                    </div>
                    <div class="col-md-4">
                        <label for="shiftEnd" style="margin-top: 5px">Shift End</label>
                        <input type="text" id="shiftEnd" name="shiftEnd" class="form-control custom-input" >
                    </div>
                    <div class="col-md-4">
                        <label for="entryAllowence" style="margin-top: 5px">Entry Tolerance</label>
                        <input type="text" id="entryAllowence" name="entryAllowence" class="form-control custom-input" >
                    </div>
                    <br><br><br>
                    <div class="col-md-4">
                        <label for="breakStart" style="margin-top: 5px">Break Start</label>
                        <input type="text" id="breakStart" name="breakStart" class="form-control custom-input" >
                    </div>
                    <div class="col-md-4">
                        <label for="breakEnd" style="margin-top: 5px">Break End</label>
                        <input type="text" id="breakEnd" name="breakEnd" class="form-control custom-input" >
                    </div>
                    <div class="col-md-4">
                        <label for="breakAllowence" style="margin-top: 5px">Break Tolerance</label>
                        <input type="text" id="breakAllowence" name="breakAllowence" class="form-control custom-input" >
                    </div>
                    <br><br><br>


                </div>

                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Add Shift</button>
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
<!--.................................. Time Picker ...............................-->
<script type="text/javascript" src="../../../../asset/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
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
        $("#date").datepicker({
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
    $('#shiftStart').timepicker({
        showMeridian: false,
        showSeconds: true
    });
</script>
<script type="text/javascript">
    $('#shiftEnd').timepicker({
        showMeridian: false,
        showSeconds: true
    });
</script>
<script type="text/javascript">
    $('#entryAllowence').timepicker({
        showMeridian: false,
        showSeconds: true
    });
</script>
<script type="text/javascript">
    $('#breakStart').timepicker({
        showMeridian: false,
        showSeconds: true
    });
</script>
<script type="text/javascript">
    $('#breakEnd').timepicker({
        showMeridian: false,
        showSeconds: true
    });
</script>
<script type="text/javascript">
    $('#breakAllowence').timepicker({
        showMeridian: false,
        showSeconds: true
    });
</script>
</body>
</html>

    <?php
} else{
    header('Location:../../../User/ManageUser/Login/login.php');
}
?>