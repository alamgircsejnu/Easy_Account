<?php
//session_start();
include_once '../../../../vendor/autoload.php';

use App\Users\ManageUser\User;
//session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
$currentId = $_SESSION['id'];

$userInfo = new User();
$oneUserInfo = $userInfo->show($currentId);
//$roles = explode(',',$oneUser['permitted_actions']);
}
?>

<div class="page-header">
    <h2>Easy Accounts <small>2RA Technology Limited</small></h2>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../../../../index.php">2RA</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if (isset($_SESSION['id']) && !empty($_SESSION['id']))  {?>
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
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">User Role</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../User/Role/User/create.php">Create User Role</a></li>
                                <li><a tabindex="-1" href="../../../User/Role/User/index.php">User Role List</a></li>
                            </ul>
                        </li>

                        <li><a href="../../../User/ManageUser/ResetPassword/ResetPasswordForm.php">Reset Password</a></li>
                        <li><a href="../../../User/ManageUser/Logout/logout.php">Log Out</a></li>

                    </ul>
                </li>
                <?php

                if (strstr($oneUserInfo['permitted_actions'],'Basic Entry') || $oneUserInfo['is_admin']==1) {
                    ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Basic Entry <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Task Tracking</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">Create Task</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/CreateProject/Create.php">Create New Task</a></li>
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/CreateProject/index.php">Task List</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a tabindex="-1" href="#">Add Section</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/AddSection/Create.php">Create
                                                Section</a></li>
                                        <li><a tabindex="-1" href="../../../BasicEntry/ProjectTracking/AddSection/index.php">Section List</a></li>

                                    </ul>
                                </li>
                                <li><a href="../../../BasicEntry/ProjectTracking/ExecuteProject.php">Execute Project</a></li>
                                <li><a href="../../../BasicEntry/ProjectTracking/ProjectReport.php">Task Report</a></li>

                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Employee</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../BasicEntry/Employee/ManageEmployee/create.php">Create Employee</a></li>
                                <li><a href="../../../BasicEntry/Employee/ManageEmployee/index.php">Employee List</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Create/Edit Supplier</a></li>
                        <li><a href="#">Expense Type</a></li>
                        <li><a href="#">Create Negotiator</a></li>
                        <li><a href="#">Account Information</a></li>
                        <li><a href="#">Add Cheque Book</a></li>
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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Op <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Create Salary Detail</a></li>
                        <li><a href="#">Disburse Salary</a></li>
                        <li><a href="#">Approve Expenses</a></li>
                        <li><a href="#">Approve Budget</a></li>
                    </ul>
                </li>


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
                        <li><a href="#">Create/Edit Customer</a></li>
                        <li><a href="#">Enter Promotion</a></li>
                        <li><a href="#">Enter Offers</a></li>
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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
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
                <?php }?>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


