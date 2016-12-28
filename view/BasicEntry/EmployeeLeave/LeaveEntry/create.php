<?php
session_start();
use App\Users\Role\Role;
use App\Employee\ManageEmployee\Employee;
//echo $_SESSION['id'];
//die();
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

        <div class="col-md-5">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Apply for Leave</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <div class="col-sm-12" style="margin-top: 21px;">
                        <div class="col-md-6">
                            <label for="from" style="margin-top: 4px">From</label>
                            <input type="text" id="from" name="from" value="<?php echo date('Y-m-d') ?>"
                                   class="form-control custom-input" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="to" style="margin-top: 4px">To</label>
                            <input type="text" id="to" name="to" value="<?php echo date('Y-m-d') ?>"
                                   class="form-control custom-input" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="leaveType" style="margin-top: 5px">Leave Type</label>
                            <select required name="leaveType" class="form-control col-sm-6 custom-input" id="leaveType">
                                <option selected>Casual Leave</option>
                                <option>Sick Leave</option>
                                <option>Maternity Leave</option>
                                <option>Earn Leave</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="referenceNo" style="margin-top: 4px">Reference No</label>
                            <input type="text" id="referenceNo" name="referenceNo" class="form-control custom-input"><br>
                        </div>
                        <div class="col-md-6 pull-right">
                        <input type="radio" name="h_f" value="Half Day" id="halfDay"> <label for="halfDay">&nbsp; Half Day&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="radio" name="h_f" value="Full Day" id="fullDay"><label for="fullDay">&nbsp; Full Day&nbsp;</label><br>
                        </div>
                        <div class="col-md-12">
                            <label for="eContact" style="margin-top: 4px">Emergency Contact</label>
                            <input type="text" id="eContact" name="eContact" class="form-control custom-input"><br>
                        </div>
                    </div>

                    <br><br><br>
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
    header('Location:../Login/login.php');

}
?>