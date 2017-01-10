
<?php
//session_start();
include_once '../../../../vendor/autoload.php';

use App\Users\ManageUser\User;
//session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
$currentId = $_SESSION['id'];

$userInfo = new User();
$oneUserInfo = $userInfo->show($currentId);
//    print_r($oneUserInfo);
}
?>
<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }
    body{
        font-family:Lucida Sans Unicode;
        min-height: 650px;
    }
    #custom-table td{
        font-family: "Times New Roman";
        text-align: center;
        min-width: 130px;
    }
    #custom-table th{
        font-family: "Times New Roman";
        text-align: center;
    }
    .custom-panel{
        font-family: "Times New Roman";
    }
    form input{
        height:29px!important;
    }
    form select{
        height:29px!important;
        font-size: 12px!important;
        margin: 0!important;
        padding: 0!important;
    }
    form select option{
        font-size: 12px!important;
    }
    form label{
        margin-bottom: 3px!important;
        margin-top: 10px!important;
    }
    form input[type=checkbox]{
        height:12px!important;
    }
    form input[type=radio]{
        height:12px!important;
    }

</style>
<link href="../../../../asset/css/simple-sidebar.css" rel="stylesheet">
<?php
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
?>
    <div>
        <p class="pull-right" style="margin: 40px 20px 0 0;font: italic bold 15px/30px Georgia, serif;;color: #010047;">
            Logged in as:<span style="color: #0000CC"><b> <?php echo $_SESSION['employeeName'] ?></b></span></p>
    </div>
<?php
}
?>
<div class="page-header" style="margin-left: 18px">
    <h2 style="font: italic bold 25px/30px Georgia, serif;;color: #010047;"><b>Easy Accounts</b>
        <small style="font-family:Courier New;color: #010047;">2RA Technology Limited</small>
    </h2>
</div>


<nav class="navbar navbar-inverse" style="background-color: #010047;width: 100%!important;>
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if (isset($_SESSION['id']) && !empty($_SESSION['id']))  {?>
            <a class="navbar-brand" href="../../../../index.php">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                        <?php
                        if (strstr($oneUserInfo['permitted_actions'],'Manage User') || $oneUserInfo['is_admin']==1) {
                           ?>

                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Manage User</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../User/ManageUser/User/create.php">Add New User</a></li>
                                <li><a href="../../../User/ManageUser/User/index.php">User List</a></li>
                            </ul>
                        </li>
                        <?php }  ?>
                        <?php
                        if (strstr($oneUserInfo['permitted_actions'],'User Role') || $oneUserInfo['is_admin']==1) {
                            ?>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">User Role</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="../../../User/Role/User/create.php">Create User Role</a></li>
                                    <li><a tabindex="-1" href="../../../User/Role/User/index.php">User Role List</a></li>
                                </ul>
                            </li>

                        <?php }  ?>
                        <li><a href="../../../User/ManageUser/ResetPassword/ResetPasswordForm.php">Change Password</a></li>
                        <li><a href="../../../User/ManageUser/Logout/logout.php">Log Out</a></li>

                    </ul>
                </li>
                <?php

                if (strstr($oneUserInfo['permitted_actions'],'Basic Entry') || $oneUserInfo['is_admin']==1) {

                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Basic Entry <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <?php
                        if (strstr($oneUserInfo['permitted_actions'],'Operation') || $oneUserInfo['is_admin']==1) {
                            ?>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#">Office Schedule Entry</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="../../../BasicEntry/Shift/ShiftEntry/create.php">Add New Shift</a></li>
                                    <li><a href="../../../BasicEntry/Shift/ShiftEntry/index.php">Shift List</a></li>

                                </ul>
                            </li>
                        <?php }  ?>
                        <?php
                        if (strstr($oneUserInfo['permitted_actions'],'Job Assign') || strstr($oneUserInfo['permitted_actions'],'Job Execute') || $oneUserInfo['is_admin']==1) {
                        ?>
                    <li class="dropdown-submenu"><a tabindex="-1" href="#">Project Tracking</a>
                            <ul class="dropdown-menu">
                            <?php
                            if (strstr($oneUserInfo['permitted_actions'],'Job Assign') || $oneUserInfo['is_admin']==1) {
                                ?>
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">Project</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/CreateProject/Create.php">Create New Project</a></li>
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/CreateProject/index.php">Project List</a></li>

                                    </ul>
                                </li>

                                <li class="dropdown-submenu"><a tabindex="-1" href="#">Task</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/AddSection/create.php">Create
                                                Task</a></li>
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/AddSection/index.php">Task List</a></li>

                                    </ul>
                                </li>

                                <li><a href="../../../BasicEntry/ProjectTracking/Report/report.php">Project Report</a></li>
                                <li><a href="../../../BasicEntry/ProjectTracking/Report/employeeEngagementReport.php">Employee Engagement Report</a></li>
                            <?php }  ?>
                                <li><a href="../../../BasicEntry/ProjectTracking/Report/performanceReport.php">Performance Report</a></li>


                            </ul>
                        </li>
                        <?php }  ?>
                    <?php
                    if (strstr($oneUserInfo['permitted_actions'],'Operation') || $oneUserInfo['is_admin']==1) {
                    ?>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Employee</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/Employee/ManageEmployee/create.php">Create Employee</a></li>
                                <li><a href="../../../BasicEntry/Employee/ManageEmployee/index.php">Employee List</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Holiday</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/Holiday/weekenedHoliday/create.php">Add Weekened Holiday</a></li>

                                <li><a tabindex="-1" href="../../../BasicEntry/Holiday/weekenedHoliday/createGH.php">Add Govt Holiday</a></li>
                                <li><a href="../../../BasicEntry/Holiday/weekenedHoliday/index.php">List of Holidays</a>
                                </li>
                            </ul>
                        </li>
                    <?php }  ?>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Employee Leave</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/EmployeeLeave/LeaveEntry/create.php">Apply for Leave</a></li>
                                <li><a href="../../../BasicEntry/EmployeeLeave/LeaveEntry/index.php">Your Leave Requests</a></li>
                                <li><a href="../../../BasicEntry/EmployeeLeave/LeaveEntry/approvedRequests.php">Your Approved Leave</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Manual Attendance</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/Attendense/AttendenseEntry/create.php">Attendance Entry</a></li>
                                <li><a href="../../../BasicEntry/Attendense/AttendenseEntry/index.php">Your Attendance</a></li>

                            </ul>
                        </li>
                    <?php
                    if (strstr($oneUserInfo['permitted_actions'],'Operation') || $oneUserInfo['is_admin']==1) {
                     ?>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Supplier</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/Supplier/SupplierEntry/create.php">Create Supplier</a></li>
                                <li><a href="../../../BasicEntry/Supplier/SupplierEntry/index.php">Supplier List</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Expense Type</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/ExpenseType/Expense/create.php">Create Expense Type</a></li>
                                <li><a href="../../../BasicEntry/ExpenseType/Expense/index.php">Expense Types</a></li>

                            </ul>
                        </li>
                    <?php }  ?>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Voucher</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/Voucher/VoucherEntry/create.php">Bill Entry</a></li>
                                <li><a href="../../../BasicEntry/Voucher/VoucherEntry/index.php">Your Bills</a></li>

                            </ul>
                        </li>
                        <li><a href="#">Create Negotiator</a></li>
                    <?php
                    if (strstr($oneUserInfo['permitted_actions'],'Basic Account') || $oneUserInfo['is_admin']==1) {
                        ?>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Account Information</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/AccountInfo/Account/create.php">Add Account</a></li>
                                <li><a href="../../../BasicEntry/AccountInfo/Account/index.php">Account Info</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Cheque Book</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/ChequeBook/ChequeBookEntry/create.php">Add Cheque Book</a></li>
                                <li><a href="../../../BasicEntry/ChequeBook/ChequeBookEntry/index.php">Cheque Book List</a></li>

                            </ul>
                        </li>
                    <?php }  ?>
                    <?php
                    if (strstr($oneUserInfo['permitted_actions'],'Operation') || $oneUserInfo['is_admin']==1) {
                    ?>
                        <li><a href="../../../BasicEntry/Attendense/AttendenseEntry/processAttendenseForm.php">Process Attendance Data</a></li>
                    <?php }  ?>
                        </ul>
                </li>
                <?php }  ?>

                    <?php

                    if (strstr($oneUserInfo['permitted_actions'],'Operation') || $oneUserInfo['is_admin']==1) {
                        ?>

                        <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operation <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Adjust Salary</a></li>
                        <li><a href="#">Create Budget</a></li>
                        <?php
                        if (strstr($oneUserInfo['permitted_actions'],'Cash Entry') || $oneUserInfo['is_admin']==1) {
                            ?>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Expense</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../Operation/Expense/EnterExpense/create.php">Enter Expense</a></li>
                                <li><a href="../../../Operation/Expense/EnterExpense/index.php">List Of Expenses</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Income</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../Operation/Income/IncomeEntry/create.php">Enter Income</a></li>
                                <li><a href="../../../Operation/Income/IncomeEntry/index.php">List Of Incomes</a></li>

                            </ul>
                        </li>
                        <?php }  ?>
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

                if (strstr($oneUserInfo['permitted_actions'],'Call Management') || $oneUserInfo['is_admin']==1) {
                    ?>

                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Call Management <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Enter Calls</a></li>
                    </ul>
                </li>
                <?php }  ?>
                <?php
                if (strstr($oneUserInfo['permitted_actions'],'Admin Op') || $oneUserInfo['is_admin']==1) {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Op <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Create Salary Detail</a></li>
                        <li><a href="#">Disburse Salary</a></li>
                        <li><a href="../../../BasicEntry/Attendense/AttendenseEntry/pendingAttendense.php">Approve Attendance</a></li>
                        <li><a href="../../../BasicEntry/EmployeeLeave/LeaveEntry/pendingLeave.php">Approve Leave</a></li>
                        <li><a href="../../../BasicEntry/Attendense/AttendenseEntry/pendingAttendense.php">Approve Outstation</a></li>
                        <li><a href="../../../BasicEntry/Voucher/VoucherEntry/pendingVoucher.php">Approve Voucher</a></li>
                        <li><a href="../../../Operation/Expense/EnterExpense/pendingExpense.php">Approve Expenses</a></li>
                        <li><a href="#">Approve Budget</a></li>
                    </ul>
                </li>

                <?php }  ?>

                <?php
                if (strstr($oneUserInfo['permitted_actions'],'Inventory') || $oneUserInfo['is_admin']==1) {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inventory<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Create Item</a></li>
                        <li><a href="#">Material Receive</a></li>
                        <li><a href="#">Material Issue</a></li>
                    </ul>
                </li>
                <?php }  ?>
                    <?php

                    if (strstr($oneUserInfo['permitted_actions'],'Marketing') || $oneUserInfo['is_admin']==1) {
                        ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Marketing<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Customer</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../Marketing/CustomerEntry/Customer/create.php">Create
                                        Customer</a></li>
                                <li><a href="../../../Marketing/CustomerEntry/Customer/index.php">Customer List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Promotion</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../Marketing/PromotionEntry/Promotion/create.php">Enter Promotion</a></li>
                                <li><a href="../../../Marketing/PromotionEntry/Promotion/index.php">Promotion List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Offers</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../Marketing/OffersEntry/Offers/create.php">Enter Offer</a></li>
                                <li><a href="../../../Marketing/OffersEntry/Offers/index.php">Offer List</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php }  ?>
                <?php

                if (strstr($oneUserInfo['permitted_actions'],'Service Report') || $oneUserInfo['is_admin']==1) {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Enter Records</a></li>
                        <li><a href="#">Service Approval</a></li>
                    </ul>
                </li>
                <?php }  ?>
                <?php

                if (strstr($oneUserInfo['permitted_actions'],'Operation') || $oneUserInfo['is_admin']==1) {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operation Reports <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <?php

                    if (strstr($oneUserInfo['permitted_actions'],'Inventory Report') || $oneUserInfo['is_admin']==1) {
                        ?>
                        <li><a href="#">Inventory Report</a></li>
                    <?php }  ?>
                        <li><a href="#">Offer Report</a></li>
                        <li><a href="#">Promotion Report</a></li>
                    <?php

                    if (strstr($oneUserInfo['permitted_actions'],'Service Report') || $oneUserInfo['is_admin']==1) {
                        ?>
                        <li><a href="#">Service Report</a></li>
                    <?php }  ?>
                    <?php

                    if (strstr($oneUserInfo['permitted_actions'],'Call Report') || $oneUserInfo['is_admin']==1) {
                        ?>
                        <li><a href="#">Call Report</a></li>
                    <?php }  ?>
                    </ul>
                </li>
                <?php }  ?>
                <?php
                if (strstr($oneUserInfo['permitted_actions'],'Reports') || $oneUserInfo['is_admin']==1) {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../../../Reports/AllReports/AttendanceReport/attendanceReportForm.php">Attendance Report</a></li>
                        <li><a href="../../../Reports/AllReports/SummaryReport/summaryReportForm.php">Summary Report</a></li>
                        <li><a href="#">Customer Report</a></li>
                        <li><a href="#">Employee Report</a></li>
                        <li><a href="#">Supplier Report</a></li>
                        <li><a href="../../../BasicEntry/ProjectTracking/Report/report.php">Task Report</a></li>
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
                <?php } }?>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="row">
<div class="col-md-12">
<div id="wrapper">
<!-- Sidebar -->
<div id="sidebar-wrapper" style="background-color: #010047;z-index: 13;width: 200px;height:850px;position: absolute">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a style="color: #5E740B">
                Shortcuts
            </a>
        </li>
        <?php if (isset($_SESSION['id']) && !empty($_SESSION['id']))  {?>

        <li>
            <a href="../../../../index.php">Pending Task</a>
        </li>
        <li>
            <a href="../../../BasicEntry/EmployeeLeave/LeaveEntry/create.php">Apply For Leave</a>
        </li>
        <li>
            <a href="../../../BasicEntry/Voucher/VoucherEntry/create.php">Voucher Entry</a>
        </li>
        <li>
            <a href="../../../BasicEntry/Attendense/AttendenseEntry/create.php">Manual Attendance</a>
        </li>
        <?php
            if (strstr($oneUserInfo['permitted_actions'],'Cash Entry') || $oneUserInfo['is_admin']==1) {
        ?>
        <li>
            <a href="../../../Operation/Expense/EnterExpense/create.php">Enter Expense</a>
        </li>
        <li>
            <a href="../../../Operation/Income/IncomeEntry/create.php">Enter Income</a>
        </li>
        <?php } }  ?>
    </ul>
</div>
</div>
<!-- /#sidebar-wrapper -->

