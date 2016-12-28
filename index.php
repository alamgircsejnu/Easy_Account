<?php
session_start();

//session_start();
include_once 'vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;

use App\Users\ManageUser\User;

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $_POST['companyId'] = $_SESSION['companyId'];
    $id = $_SESSION['id'];

    $user = new User();
    $oneUser = $user->show($id);

    $task = new TaskExecution();
    $task->prepare($_POST);
    $pendingTasks = $task->pendingTask();

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
            html, body {
                max-width: 100%;
                overflow-x: hidden;
            }
            body {
                background-image: url("asset/images/bg13.jpg");
                background-color: #1b6d85!important;
                font-family:Lucida Sans Unicode;
                min-height: 650px;

            }
            td{
                text-align: center;
            }
            th{
                text-align: center;
            }
        </style>
    </head>

    <body>

    <div class="page-header" style="margin-left: 18px">
        <h2 style="font: italic bold 25px/30px Georgia, serif;;color: #010047;"><b>Easy Accounts</b>
            <small style="font-family:Courier New;color: #010047;">2RA Technology Limited</small>
        </h2>
    </div>

    <nav class="navbar navbar-inverse" style="background-color: #010047;">
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
                    <?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu multi-level" role="menu"
                                aria-labelledby="dropdownMenu">

                                <?php
                                if (strstr($oneUser['permitted_actions'],'Manage User') || $oneUser['is_admin']==1) {
                                ?>
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">Manage User</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="view/User/ManageUser/User/create.php">Add New
                                                User</a>
                                        </li>
                                        <li><a href="view/User/ManageUser/User/index.php">User List</a></li>
                                    </ul>
                                </li>
                                <?php }  ?>
                                <?php
                                if (strstr($oneUser['permitted_actions'],'User Role') || $oneUser['is_admin']==1) {
                                ?>
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">User Role</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="view/User/Role/User/create.php">Create User Role</a>
                                        </li>
                                        <li><a tabindex="-1" href="view/User/Role/User/index.php">User Role List</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php }  ?>
                                <li><a href="view/User/ManageUser/ResetPassword/ResetPasswordForm.php">Reset
                                        Password</a>
                                </li>
                                <li><a href="view/User/ManageUser/Logout/logout.php">Log Out</a></li>


                            </ul>
                        </li>
                    <?php } ?>
                    <?php

                    if (strstr($oneUser['permitted_actions'],'Basic Entry') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Basic Entry <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            <?php

                            if (strstr($oneUser['permitted_actions'],'Job Assign') || strstr($oneUser['permitted_actions'],'Job Execute') || $oneUser['is_admin']==1) {
                            ?>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Project Tracking</a>
                                <ul class="dropdown-menu">
                                    <?php

                                    if (strstr($oneUser['permitted_actions'],'Job Assign') || $oneUser['is_admin']==1) {
                                        ?>
                                    <li class="dropdown-submenu"><a tabindex="-1" href="#">Project</a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="view/BasicEntry/ProjectTracking/CreateProject/Create.php">Create New Project</a></li>
                                            <li><a tabindex="-1" href="view/BasicEntry/ProjectTracking/CreateProject/index.php">Project List</a></li>

                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a tabindex="-1" href="#">Task</a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="view/BasicEntry/ProjectTracking/AddSection/Create.php">Create
                                                    Task</a></li>
                                            <li><a tabindex="-1" href="view/BasicEntry/ProjectTracking/AddSection/index.php">Task List</a></li>

                                        </ul>
                                    </li>

                                    <li><a href="view/BasicEntry/ProjectTracking/Report/report.php">Project Report</a></li>
                                    <li><a href="view/BasicEntry/ProjectTracking/Report/employeeEngagementReport.php">Employee Engagement Report</a></li>
                                    <?php }  ?>
                                    <li><a href="view/BasicEntry/ProjectTracking/Report/performanceReport.php">performance Report</a></li>

                                </ul>
                            </li>
                            <?php }  ?>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Employee</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Employee/ManageEmployee/create.php">Create
                                            Employee</a></li>
                                    <li><a href="view/BasicEntry/Employee/ManageEmployee/index.php">Employee List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Holiday</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Holiday/weekenedHoliday/create.php">Add Weekened Holiday</a></li>
                                    <li><a tabindex="-1" href="view/BasicEntry/Holiday/weekenedHoliday/createGH.php">Add Govt Holiday</a></li>
                                    <li><a href="view/BasicEntry/Holiday/weekenedHoliday/index.php">List of Holidays</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Employee Leave</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/EmployeeLeave/LeaveEntry/create.php">Apply for Leave</a></li>
                                    <li><a href="view/BasicEntry/EmployeeLeave/LeaveEntry/index.php">Your Leave Requests</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Manual Attendense</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Attendense/AttendenseEntry/create.php">Attendense Entry</a></li>
                                    <li><a href="view/BasicEntry/Attendense/AttendenseEntry/index.php">Your Attendense</a></li>

                                </ul>
                            </li>

                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Supplier</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Supplier/SupplierEntry/create.php">Create Supplier</a></li>
                                    <li><a href="view/BasicEntry/Supplier/SupplierEntry/index.php">Supplier List</a></li>

                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Expense Type</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/ExpenseType/Expense/create.php">Create Expense Type</a></li>
                                    <li><a href="view/BasicEntry/ExpenseType/Expense/index.php">Expense Types</a></li>

                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Voucher</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/Voucher/VoucherEntry/create.php">Bill Entry</a></li>
                                    <li><a href="view/BasicEntry/Voucher/VoucherEntry/index.php">Your Bills</a></li>

                                </ul>
                            </li>
                            <li><a href="#">Create Negotiator</a></li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Account Information</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/AccountInfo/Account/create.php">Add Account</a></li>
                                    <li><a href="view/BasicEntry/AccountInfo/Account/index.php">Account Info</a></li>

                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Cheque Book</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/BasicEntry/ChequeBook/ChequeBookEntry/create.php">Add Cheque Book</a></li>
                                    <li><a href="view/BasicEntry/ChequeBook/ChequeBookEntry/index.php">Cheque Book List</a></li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php }  ?>
                    <?php

                    if (strstr($oneUser['permitted_actions'],'Operation') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Operation <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Adjust Salary</a></li>
                            <li><a href="#">Create Budget</a></li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Expense</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/Operation/Expense/EnterExpense/create.php">Enter Expense</a></li>
                                    <li><a href="view/Operation/Expense/EnterExpense/index.php">List of Expenses</a></li>

                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Income</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/Operation/Income/IncomeEntry/create.php">Enter Income</a></li>
                                    <li><a href="view/Operation/Income/IncomeEntry/index.php">List of Incomes</a></li>

                                </ul>
                            </li>
                            <li><a href="#">Enter Payment</a></li>
                            <li><a href="#">Account Transfer</a></li>
                            <li><a href="#">Enter LC</a></li>
                            <li><a href="#">Enter BG/PG</a></li>
                            <li><a href="#">Loan Collection</a></li>
                            <li><a href="#">Loan Payment</a></li>
                        </ul>
                    </li>
                    <?php }  ?>
                    <?php

                    if (strstr($oneUser['permitted_actions'],'Call Management') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Call Management <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Enter Calls</a></li>
                        </ul>
                    </li>
                    <?php
                    if (strstr($oneUser['permitted_actions'],'Admin Op') || $oneUser['is_admin']==1) {
                        ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Admin Op <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create Salary Detail</a></li>
                            <li><a href="#">Disburse Salary</a></li>
                            <li><a href="view/BasicEntry/Attendense/AttendenseEntry/pendingAttendense.php">Approve Outstation</a></li>
                            <li><a href="view/BasicEntry/EmployeeLeave/LeaveEntry/pendingLeave.php">Approve Leave</a></li>
                            <li><a href="view/BasicEntry/Voucher/VoucherEntry/pendingVoucher.php">Approve Voucher</a></li>
                            <li><a href="view/Operation/Expense/EnterExpense/pendingExpense.php">Approve Expenses</a></li>
                            <li><a href="#">Approve Budget</a></li>
                        </ul>
                    </li>
                    <?php } }  ?>
                    <?php

                    if (strstr($oneUser['permitted_actions'],'Inventory') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Inventory<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Create Item</a></li>
                            <li><a href="#">Material Receive</a></li>
                            <li><a href="#">Material Issue</a></li>
                        </ul>
                    </li>
                    <?php }  ?>
                    <?php

                    if (strstr($oneUser['permitted_actions'],'Marketing') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Marketing<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Customer</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/Marketing/CustomerEntry/Customer/create.php">Create
                                            Customer</a></li>
                                    <li><a href="view/Marketing/CustomerEntry/Customer/index.php">Customer List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Promotion</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/Marketing/PromotionEntry/Promotion/create.php">Enter Promotion</a></li>
                                    <li><a href="view/Marketing/PromotionEntry/Promotion/index.php">Promotion List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Offers</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="view/Marketing/OffersEntry/Offers/create.php">Enter Offer</a></li>
                                    <li><a href="view/Marketing/OffersEntry/Offers/index.php">Offer List</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php }  ?>
                    <?php
                    if (strstr($oneUser['permitted_actions'],'Service Report') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Service <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Enter Records</a></li>
                            <li><a href="#">Service Approval</a></li>
                        </ul>
                    </li>
                    <?php }  ?>
                    <?php

                    if (strstr($oneUser['permitted_actions'],'Operation') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Operation Reports <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php

                            if (strstr($oneUser['permitted_actions'],'Inventory Report') || $oneUser['is_admin']==1) {
                            ?>
                            <li><a href="#">Inventory Report</a></li>
                            <?php }  ?>
                            <li><a href="#">Offer Report</a></li>
                            <li><a href="#">Promotion Report</a></li>
                            <?php

                            if (strstr($oneUser['permitted_actions'],'Service Report')) {
                            ?>
                            <li><a href="#">Service Report</a></li>
                            <?php }  ?>

                            <?php

                            if (strstr($oneUser['permitted_actions'],'Call Report')) {
                            ?>
                            <li><a href="#">Call Report</a></li>
                            <?php }  ?>
                        </ul>
                    </li>
                    <?php }  ?>
                    <?php
                    if (strstr($oneUser['permitted_actions'],'Reports') || $oneUser['is_admin']==1) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Reports <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Customer Report</a></li>
                            <li><a href="#">Employee Report</a></li>
                            <li><a href="#">Supplier Report</a></li>
                            <li><a href="view/BasicEntry/ProjectTracking/Report/report.php">Task Report</a></li>
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
                    <?php }  ?>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

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


        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <h4 style="color: yellow;background-color: black;text-align: center">Your Pending Tasks Here...</h4><br>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="col-md-1"></div>
        <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px">


            <div class="table-responsive" id="custom-table">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th align="center">SL#</th>
                        <th align="center">Project ID</th>
                        <th align="center">Section ID</th>
                        <th align="center">Assigned Date</th>
                        <th align="center">Primary Estimated Days</th>
                        <th align="center">Latest Estimated Days</th>
                        <th align="center">Priority</th>
                        <th align="center">Assigned By</th>
                    </tr>
                    </thead>
                    <?php
                    if (isset($pendingTasks) && !empty($pendingTasks)) {
                    $serial = 0;
                    foreach ($pendingTasks as $pendingTask) {
                    $serial++
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $serial ?></td>
                        <td><?php echo $pendingTask['project_id'] ?></td>
                        <td><?php echo $pendingTask['section_id']; ?></td>
                        <td><?php echo $pendingTask['assigned_date']; ?></td>
                        <td><?php echo $pendingTask['est_days']; ?></td>
                        <td><?php echo $pendingTask['latest_est_days']; ?></td>
                        <td><?php echo $pendingTask['priority']; ?></td>
                        <td><?php echo $pendingTask['assigned_by']; ?></td>

                        <td>

                            <a href="view/BasicEntry/ProjectTracking/TaskExecution/create.php?id=<?php echo $pendingTask['id'] ?>"> <img style="margin: 3%" border="0"
                                  title="Update Task Info" alt="Edit"
                                  src="asset/images/edit.png"
                                  width="25" height="20"></a>

                        </td>
                    </tr>
                    <?php
                    }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8" align="center">
                                <?php echo "<h5><b>No Data Available</b></h5>" ?>

                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

    <script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
    <br><br><br><br><br>
    </html>

    <?php
} else {
    header('Location:view/User/ManageUser/Login/login.php');

}
?>
