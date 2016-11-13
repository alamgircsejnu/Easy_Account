<?php
session_start();
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

    <div class="col-md-4"></div>

    <div class="col-md-4">


        <div class="panel panel-primary custom-panel" style="391px">

            <div class="panel-heading">Login here</div>
            <br>
            <form role="form" action="loginProcess.php" method="post">
                <input type="hidden" name="id" value="<?php  ?>">
                <div class="col-sm-12">
                    <label for="employeeId" style="margin-top: 10px">Employee ID</label>
                    <input type="text" id="employeeId" name="userName" class="form-control custom-input"
                           placeholder="Employee Id" required>

                </div>
                <div class="col-sm-12">
                    <label for="password" style="margin-top: 10px">Password</label>
                    <input type="password" id="password" name="password" class="form-control custom-input"
                           placeholder="Password" required>

                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 27%;margin-top: 11px;margin-right: 14px;">
                                <button type="submit" class="btn btn-info pull-right">Login</button>
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
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="../../../../asset/js/jquery.min.js"></script>
<script src="jquery.checkAll.js"></script>
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
</body>
</html>