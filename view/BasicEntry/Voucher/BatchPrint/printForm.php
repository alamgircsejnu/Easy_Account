<?php
session_start();
include_once '../../../../vendor/autoload.php';
date_default_timezone_set("Asia/Dhaka");
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
    <br><br>
    <div class="row">

        <div class="col-md-4"></div>

        <div class="col-md-4">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Batch Print</div>
                <br>
                <form role="form" action="batchPrint.php" method="post" target="_blank">

                    <div  style="margin-top: 21px;">
                        <div>
                            <label for="from" style="margin-top: 4px;margin-right: 8px;float: left;margin-left: 15px">From VN</label>
                        </div>
                        <div>
                            <input type="text" id="from" name="from" required style="height: 23px!important;width: 120px;margin-top: 8px;float: left;font-size: 13px;margin-right: 8px">
                        </div>
                        <div style="float: left">
                            <label for="toDate" style="margin-top: 4px;margin-left:10px;margin-right: 8px; ">To VN</label>
                        </div>

                        <div style="float: left">
                            <input type="text" id="to" name="to" class="form-control custom-input" style="height: 23px!important;width: 120px;margin-top: 8px;float: left;font-size: 13px">
                        </div>

                    </div>

                    <br><br><br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px">
                                    <button type="submit" class="btn btn-info pull-right" style="width: 112px;margin-right: 15px;">Print Vouchers</button>
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

    </body>
    </html>

    <?php
} else{
    header('Location:../../../User/ManageUser/Login/login.php');
}
?>