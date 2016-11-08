<?php
//include_once '../../../../vendor/autoload.php';
//
//use App\Users\Role\Role;
//
//$role = new Role();
//$allRoles = $role->index();
//
////print_r($allUsers);
//
////die();
//?>

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

            <div class="panel-heading">Add Employee Information</div>
            <br>
            <form role="form" action="store.php" method="post">

                <div>
                    <div class="col-md-6">
                    <label for="employeeId" style="margin-top: 5px">Employee ID</label>
                    <input type="text" id="employeeId" name="employeeId" class="form-control custom-input"
                           placeholder="Employee ID" required>
                    </div>
                    <div class="col-md-6">
                    <label for="department" style="margin-top: 5px">Department</label>
                    <input type="text" id="department" name="department" class="form-control custom-input"
                           placeholder="Department" required>
                    </div>
                        <br><br><br>
                        <div class="col-md-6">
                    <label for="employeeName" style="margin-top: 5px">Employee Name</label>
                    <input type="text" id="employeeName" name="employeeName" class="form-control custom-input"
                           placeholder="Employee Name" required>
                        </div>
                    <div class="col-md-6">
                        <label for="designation" style="margin-top: 5px">Designation</label>
                        <input type="text" id="designation" name="designation" class="form-control custom-input"
                               placeholder="Designation" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="cardId" style="margin-top: 5px">Card ID</label>
                        <input type="text" id="cardId" name="cardId" class="form-control custom-input"
                               placeholder="Card ID" required>
                    </div>
                            <div class="col-md-6">
                    <label for="shift" style="margin-top: 5px">Shift</label>
                    <select name="shift" class="form-control col-sm-6 custom-input" id="shift">
                        <option selected>Day</option>
                        <option>Night</option>
                    </select>
                            </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="dateOfBirth" style="margin-top: 5px">Date of Birth</label>
                        <input type="text" id="dateOfBirth" name="dateOfBirth" class="form-control custom-input"
                               placeholder="Date of Birth">
                    </div>
                    <div class="col-md-6">
                        <label for="joiningDate" style="margin-top: 5px">Joining Date</label>
                        <input type="text" id="joiningDate" name="joiningDate" class="form-control custom-input"
                               placeholder="Joining Date">
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="contactNo" style="margin-top: 5px">Contact No</label>
                        <input type="text" id="contactNo" name="contactNo" class="form-control custom-input"
                               placeholder="Contact No">
                    </div>
                    <div class="col-md-6">
                        <label for="bloodGroup" style="margin-top: 5px">Blood Group</label>
                        <input type="text" id="bloodGroup" name="bloodGroup" class="form-control custom-input"
                               placeholder="Blood Group">
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="presentAddress" style="margin-top: 5px">Present Address</label>
                        <input type="text" id="presentAddress" name="presentAddress" class="form-control custom-input"
                               placeholder="Present Address">
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="permanentAddress" style="margin-top: 5px">Permanent Address</label>
                        <input type="text" id="permanentAddress" name="permanentAddress" class="form-control custom-input"
                               placeholder="Permanent Address">
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="status" style="margin-top: 5px">Status</label>
                        <select required name="status" class="form-control col-sm-6 custom-input" id="status">
                            <option selected>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="remarks" style="margin-top: 5px">Remarks</label>
                        <input type="text" id="remarks" name="remarks" class="form-control custom-input"
                               placeholder="Remarks">
                    </div>
                    <br><br><br>

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