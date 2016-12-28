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

        <div class="col-md-5">


            <div class="panel panel-primary custom-panel" style="height: 376px;">

                <div class="panel-heading">Insert Weekened Holiday</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <div class="col-sm-6" style="margin-top: 38px;">
                        <label for="from" style="margin-top: 4px">From</label>
                        <input type="text" id="from" name="from" value="<?php echo date('Y-m-d') ?>"
                               class="form-control custom-input" required><br>

                        <label for="to" style="margin-top: 4px">To</label>
                        <input type="text" id="to" name="to" value="<?php echo date('Y-m-d') ?>"
                               class="form-control custom-input" required><br>

                    </div>
                    <div class="form-group">
                        <label for="permittedActions" class="col-md-6" style="margin-top: 4px">Select Holidays</label><br><br>

                        <div class="form-group pre-scrollable scrollable-checkbox col-md-5" style="float: right;width: 47%">


                            <div class="col-md-12" style="height: 232px;margin-left: 15px;">
                                <div>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                    value="Sunday" id="Sunday">
                                <label for="Sunday">&nbsp Sunday</label><br>
                                </div>
                                <div>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                       value="Monday" id="Monday">
                                <label for="Monday">&nbsp Monday</label><br>
                                </div>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                       value="Tuesday" id="Tuesday">
                                <label for="Tuesday">&nbsp Tuesday</label><br>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                       value="Wednesday" id="Wednesday">
                                <label for="Wednesday">&nbsp Wednesday</label><br>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                       value="Thursday" id="Thursday">
                                <label for="Thursday">&nbsp Thursday</label><br>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                       value="Friday" id="Friday">
                                <label for="Friday">&nbsp Friday</label><br>
                                <input type="checkbox" class="checkBoxClass" name="weekenedHolidays[]"
                                       value="Saturday" id="Saturday">
                                <label for="Saturday">&nbsp Saturday</label><br>
                            </div>
                        </div>

                    </div>
                    <br><br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 22px;">
                                    <button type="submit" class="btn btn-info pull-right" style="width: 82px;margin-right: 15px;">Insert</button>
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