<!DOCTYPE html>
<html>

<head>
    <title>
        2RA Technology Limited
    </title>

    <link rel="stylesheet" href="../../../asset/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../../asset/css/main.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <link href="../../../asset/js/css/blitzer/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">



    <script type="text/javascript">
        $(document).ready(function() {
            $('dropdown-toggle').dropdown()
        });
    </script>

    <style>
        body {
            background-image: url("../../../asset/images/bg13.jpg");
            /*background-repeat: repeat-x;*/
        }
    </style>
</head>

<body>

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
            <a class="navbar-brand" href="../../../index.php">2RA</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Logout</a></li>
                        <li><a href="#">Manage User</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Basic Entry <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-submenu"><a tabindex="-1" href="#">Projects</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="../../../view/BasicEntry/Project/CreateProject.php">Create New Project</a></li>
                                <li><a href="../../../view/BasicEntry/Project/ProjectList.php">List of Projects</a></li>
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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Call Management <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Enter Calls</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Op <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Create Salary Detail</a></li>
                        <li><a href="#">Disburse Salary</a></li>
                        <li><a href="#">Approve Expenses</a></li>
                        <li><a href="#">Approve Budget</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inventory<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Create Item</a></li>
                        <li><a href="#">Material Receive</a></li>
                        <li><a href="#">Material Issue</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Marketing<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Create/Edit Customer</a></li>
                        <li><a href="#">Enter Promotion</a></li>
                        <li><a href="#">Enter Offers</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Enter Records</a></li>
                        <li><a href="#">Service Approval</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operation Reports <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Inventory Report</a></li>
                        <li><a href="#">Offer Report</a></li>
                        <li><a href="#">Promotion Report</a></li>
                        <li><a href="#">Service Report</a></li>
                        <li><a href="#">Call Report</a></li>
                    </ul>
                </li>

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
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<!--.....................Project Creation Form............................-->
<br><br><br><br>
<div class="row">

    <div class="col-md-2"></div>



    <div class="col-md-8">
        <div class="panel panel-primary custom-panel">
            <div class="panel-heading">Create Project</div>
            <br>
<form class=" form-group custom-input form-inline">
    <div class="form-group inline">
        <label class="control-label" for="exampleInputProjectCode">Project Code</label>
        <input type="text" class="form-control" id="exampleInputProjectCode"  placeholder="Enter Project Code">
    </div>

    <div class="form-group inline">
        <label class="control-label" for="customerName">Customer Name</label>
        <select class="form-control" id="customerName" style="width: 220px">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>

    <br>
    <div class="form-group">
        <label class="control-label" for="exampleInputProjectName">Project Name</label>
        <input type="text" class="form-control" id="exampleInputProjectName" placeholder="Enter Project Name">
    </div>
    <br>


    <div class="form-group">
        <label class="control-label" for="exampleInputPOAmount">PO Amount</label>
        <input type="text" class="form-control" id="exampleInputPOAmount"  placeholder="Enter PO Amount">
    </div>
    <br>

    <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="PODate">PO Date</label>
        <input class="form-control" type="text" name="PODate" id="PODate" placeholder="YYYY-MM-DD">
    </div>
    <br>

    <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="deliveryDate">Delivery Date</label>
        <input class="form-control" type="text" name="deliveryDate" id="deliveryDate" placeholder="YYYY-MM-DD">
    </div>
    <br>

    <div class="form-group">
        <label class="control-label" for="exampleTextarea">Description</label>
        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>
<br>
    <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</form>


    </div>

    <div class="col-md-2"></div>
</div>
<br><br><br><br>

<!--.....................Project Creation Form Ended....................-->



<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>-->

<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../../asset/js/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>

<script type="text/javascript">
    $(function () {
        $("#PODate").datepicker({
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
        $("#deliveryDate").datepicker({
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