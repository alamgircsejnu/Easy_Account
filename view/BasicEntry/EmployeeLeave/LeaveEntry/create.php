<?php
session_start();
use App\Users\Role\Role;
use App\Employee\ManageEmployee\Employee;
date_default_timezone_set("Asia/Dhaka");
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {

    include_once '../../../../vendor/autoload.php';



    $role = new Role();
    $allRoles = $role->index();

    $employee = new Employee();
    $allEmployees = $employee->index();

//print_r($allUsers);

//die();
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
                font-family: "Georgia"!important;
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

        <div class="col-md-5">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Apply for Leave</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <div  style="margin-top: 21px;">
                        <div>
                            <label for="from" style="margin-top: 4px;margin-right: 8px;float: left;margin-left: 15px">Select Date</label>
                        </div>
                        <div>
                            <input type="text" id="from" name="from" value="<?php echo date('Y-m-d') ?>"
                                   required style="height: 23px!important;width: 140px;margin-top: 8px;float: left;font-size: 13px;margin-right: 8px">
                        </div>
                        <div style="float: left">
                            <input type="checkbox" id="toDate" name="toDate" value="checked" class="form-control custom-input" style="margin-top: 14px;width: 20px;margin-left: 10px">
                        </div>
                        <div style="float: left">
                            <label for="toDate" style="margin-top: 4px;margin-left:10px;margin-right: 8px; ">To Date</label>
                        </div>

                        <div style="float: left">
                            <input type="hidden" id="to" name="to" value="<?php echo date('Y-m-d') ?>"
                                   class="form-control custom-input" style="height: 23px!important;width: 140px;margin-top: 8px;float: left;font-size: 13px">
                        </div>
                        <br><br>
                        <div class="col-md-6">
                            <label for="leaveType" style="margin-top: 5px">Leave Type</label>
                            <select required name="leaveType" class="form-control col-sm-6 custom-input" id="leaveType">
                                <option value="CL">Casual Leave</option>
                                <option value="SL">Sick Leave</option>
                                <option value="ML">Maternity Leave</option>
                                <option value="EL">Earn Leave</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="referenceNo" style="margin-top: 4px">Reference No</label>
                            <input type="text" id="referenceNo" name="referenceNo" class="form-control custom-input"><br>
                        </div>
                        <div class="col-md-8 pull-right">
                        <input type="radio" name="h_f" value="First Half" id="firstHalf"> <label for="firstHalf">&nbsp; First Half&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="radio" name="h_f" value="Second Half" id="secondHalf"> <label for="secondHalf">&nbsp; Second Half&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="radio" name="h_f" value="Full Day" id="fullDay"><label for="fullDay">&nbsp; Full Day&nbsp;</label><br>
                        </div>
                        <div class="col-md-6">
                            <label for="eContact" style="margin-top: 4px">Emergency Contact</label>
                            <input type="text" id="eContact" name="eContact" class="form-control custom-input"><br>
                        </div>
                        <div class="col-md-6">
                            <label for="remarks" style="margin-top: 4px">Remarks</label>
                            <input type="text" id="remarks" name="remarks" class="form-control custom-input"><br>
                        </div>
                    </div>

                    <br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px">
                                    <button type="submit" class="btn btn-info pull-right" style="width: 82px;margin-right: 15px;">Apply</button>
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