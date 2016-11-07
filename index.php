<?php
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {


    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>
            2RA Technology Limited
        </title>

        <link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="asset/css/main.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <script type="text/javascript">
            $(document).ready(function () {
                $('dropdown-toggle').dropdown()
            });
        </script>

        <style>
            body {
                background-image: url("asset/images/bg13.jpg");
                /*background-repeat: repeat-x;*/
            }
        </style>
    </head>

    <body>

    <div class="page-header">
        <h2>Easy Accounts
            <small>2RA Technology Limited</small>
        </h2>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">2RA</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">User <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Manage User</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/User/ManageUser/User/create.php">Add New User</a>
                                    </li>
                                    <li><a href="view/User/ManageUser/User/index.php">User List</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">User Role</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/User/Role/User/create.php">Create User Role</a></li>
                                    <li><a tabindex="-1" href="view/User/Role/User/index.php">User Role List</a></li>
                                </ul>
                            </li>
                            <li><a href="view/User/ManageUser/ResetPassword/ResetPasswordForm.php">Reset Password</a>
                            </li>
                            <li><a href="view/User/ManageUser/Logout/logout.php">Log Out</a></li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Basic Entry <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Project Tracking</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Project/CreateProject.php">Create
                                            Project</a></li>
                                    <li><a href="view/BasicEntry/Project/ExecuteProject.php">Execute Project</a></li>
                                    <li><a href="view/BasicEntry/Project/ProjectReport.php">Project Report</a></li>

                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Empleyee</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Project/CreateEmployee.php">Create
                                            Employee</a></li>
                                    <li><a href="view/BasicEntry/Project/EditEmployee.php">Edit Employee</a></li>
                                </ul>
                            </li>

                            <li><a href="#">Create/Edit Employee</a></li>
                            <li><a href="#">Create/Edit Supplier</a></li>
                            <li><a href="#">Expense Type</a></li>
                            <li><a href="#">Create Negotiator</a></li>
                            <li><a href="#">Account Information</a></li>
                            <li><a href="#">Add Cheque Book</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Operation <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Adjust Salary</a></li>
                            <li><a href="#">Create Budget</a></li>
                            <li><a href="#">Enter Expense</a></li>
                            <li><a href="#">Enter Income</a></li>
                            <li><a href="#">Enter Payment</a></li>
                            <li><a href="#">Account Transfer</a></li>
                            <li><a href="#">Enter LC</a></li>
                            <li><a href="#">Enter BG/PG</a></li>
                            <li><a href="#">Loan Collection</a></li>
                            <li><a href="#">Loan Payment</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Call Management <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Enter Calls</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Admin Op <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create Salary Detail</a></li>
                            <li><a href="#">Disburse Salary</a></li>
                            <li><a href="#">Approve Expenses</a></li>
                            <li><a href="#">Approve Budget</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Inventory<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create Item</a></li>
                            <li><a href="#">Material Receive</a></li>
                            <li><a href="#">Material Issue</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Marketing<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create/Edit Customer</a></li>
                            <li><a href="#">Enter Promotion</a></li>
                            <li><a href="#">Enter Offers</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Service <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Enter Records</a></li>
                            <li><a href="#">Service Approval</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Operation Reports <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Inventory Report</a></li>
                            <li><a href="#">Offer Report</a></li>
                            <li><a href="#">Promotion Report</a></li>
                            <li><a href="#">Service Report</a></li>
                            <li><a href="#">Call Report</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Reports <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Customer Report</a></li>
                            <li><a href="#">Employee Report</a></li>
                            <li><a href="#">Supplier Report</a></li>
                            <li><a href="#">Project Report</a></li>
                            <li><a href="#">Income Report</a></li>
                            <li><a href="#">Expense Report</a></li>
                            <li><a href="#">Budget Report</a></li>
                            <li><a href="#">VAT Report</a></li>
                            <li><a href="#">AIT Report</a></li>
                            <li><a href="#">Account Report</a></li>
                            <li><a href="#">Receivable Report</a></li>
                            <li><a href="#">Payable Report</a></li>
                            <li><a href="#">Operation Summary</a></li>
                            <li><a href="#">Profit Loss</a></li>
                            <li><a href="#">Cheque Book Status</a></li>
                            <li><a href="#">Salary Report</a></li>
                        </ul>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div style="width: 200px">
        <?php
        //    session_start();
        if (isset($_SESSION['successMessage'])) {
            echo '<h2 style="color: green;>' . $_SESSION['successMessage'] . '</h2><br>';
            unset($_SESSION['successMessage']);
        } else if (isset($_SESSION['errorMessage'])) {
            echo '<h2 style="color: red;>' . $_SESSION['errorMessage'] . '</h2><br>';
            unset($_SESSION['errorMessage']);
        }


        ?>
    </div>
    <script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
    </html>

    <?php
} else{
    header('Location:view/User/ManageUser/Login/login.php');

}
?>
