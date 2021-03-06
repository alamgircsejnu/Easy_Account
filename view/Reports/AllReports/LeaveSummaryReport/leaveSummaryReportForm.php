<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Reports\AllReports\AllReports;
date_default_timezone_set("Asia/Dhaka");
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $_POST['companyId'] = $_SESSION['companyId'];
    $report = new AllReports();
    $report->prepare($_POST);
    $allDepartment = $report->department();
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

        <div class="col-md-4"></div>

        <div class="col-md-4">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Leave Summary Report</div>
                <br>
                <form role="form" action="leaveSummaryReport.php" method="post" target="_blank">

                    <div  style="margin-top: 21px;">
                        <div>
                            <label style="margin-right: 10px">Department :</label>
                            <span id="allDeptDiv">
                            <input type="checkbox" name="allDept" id="allDept" value="all" required>
                            <label for="allDept" id="allDeptLabel"">All</label>
                            </span>
                            <label for="department" style="margin-right: 10px;margin-left: 20px">Select Dept.</label>
                            <select name="department" id="department" style="height: 23px!important;width: 155px;margin-top: 8px;font-size: 13px;" required>
                                <option></option>
                                <?php
                                if (isset($allDepartment) && !empty($allDepartment)) {
                                    foreach ($allDepartment as $oneDepartment) {
                                        ?>
                                        <option><?php echo $oneDepartment['department']?></option>

                                    <?php }}  ?>
                            </select>
                        </div>
                        <br><br>
                        <div>
                            <label for="from" style="margin-top: 4px;margin-right: 8px;float: left;margin-left: 15px">Select Date</label>
                        </div>
                        <div>
                            <input type="text" id="from" name="from" value="<?php echo date('Y-m-d') ?>"
                                   required style="height: 23px!important;width: 100px;margin-top: 8px;float: left;font-size: 13px;margin-right: 8px">
                        </div>
                        <div style="float: left">
                            <input type="checkbox" id="toDate" name="toDate" value="checked" class="form-control custom-input" style="margin-top: 14px;width: 20px;margin-left: 10px">
                        </div>
                        <div style="float: left">
                            <label for="toDate" style="margin-top: 4px;margin-left:10px;margin-right: 8px; ">To Date</label>
                        </div>

                        <div style="float: left">
                            <input type="hidden" id="to" name="to" value="<?php echo date('Y-m-d') ?>"
                                   class="form-control custom-input" style="height: 23px!important;width: 100px;margin-top: 8px;float: left;font-size: 13px">
                        </div>
                        <br><br>

                    </div>

                    <br><br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px">
                                    <button type="submit" class="btn btn-info pull-right" style="width: 82px;margin-right: 15px;">See Report</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="col-md-3"></div>
    </div>


    <br><br><br><br>
    <script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <script src="jquery.checkAll.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>

    <script type="text/javascript">

        $('#allDept').on('change', function(){
            var inputVal = document.getElementById("department");
            if (this.checked) {
                $('#department').prop('disabled', true);
                inputVal.style.backgroundColor = "#a8adb5";
            } else {
                $('#department').prop('disabled', false);
                inputVal.style.backgroundColor = "white";
            }

        });

    </script>
    <script type="text/javascript">
        $('#department').on('change', function(){
            var inputVal = document.getElementById("allDeptDiv");
            $("#allDept").prop('disabled', true);
            inputVal.style.backgroundColor = "#a8adb5";
        });

    </script>
    <script type="text/javascript">
        $('#toDate').on('change', function(){
            if (this.checked) {
                $("#to").prop("type", "text");
            } else {
                $("#to").prop("type", "hidden");
            }

        });

    </script>
    <script type="text/javascript">
        $(function () {
            $("#from").datepicker({
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
            $("#to").datepicker({
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
    </body>
    </html>

    <?php
} else{
    header('Location:../../../User/ManageUser/Login/login.php');

}
?>