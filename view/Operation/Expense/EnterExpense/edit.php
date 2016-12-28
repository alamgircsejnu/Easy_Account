<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;

$_POST['companyId'] = $_SESSION['companyId'];

$_POST['id'] = $_GET['id'];

$expense = new Expense();
$expense->prepare($_POST);
$expenseTypes = $expense->expenseTypes();
$allProjects = $expense->projectCodes();
$allVouchers = $expense->vouchers();
$allEmployees = $expense->allEmployee();
$allSuppliers = $expense->allSuppliers();
$oneExpense = $expense->show();
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

    <div class="col-md-6">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Edit Expense</div>
            <br>
            <form role="form" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <div>
                    <div class="col-md-6">
                        <label for="expenseId" style="margin-top: 5px">Expense Code</label>
                        <input type="text" id="expenseId" name="expenseId" class="form-control custom-input"
                               value="<?php echo $oneExpense['expense_id'] ?>" placeholder="Expense Code" required>
                    </div>
                    <div class="col-md-6">
                        <label for="expenseType" style="margin-top: 5px">Expense Type</label>
                        <select required name="expenseType" class="form-control col-sm-6 custom-input" id="expenseType">
                            <option></option>
                            <?php
                            if (isset($expenseTypes) && !empty($expenseTypes)) {
                                foreach ($expenseTypes as $oneType) {
                                    ?>
                                    <option <?php if ($oneExpense['expense_type']==$oneType['expense_type']) echo 'selected'?>><?php echo $oneType['expense_type']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="amount" style="margin-top: 5px">Amount</label>
                        <input type="text" id="amount" name="amount" class="form-control custom-input"
                             value="<?php echo $oneExpense['expense_amount']?>"  placeholder="Amount" required>
                    </div>
                    <div class="col-md-6">
                        <label for="payType" style="margin-top: 5px">Pay Type</label>
                        <select name="payType" class="form-control col-sm-6 custom-input" id="payType">
                            <option></option>
                            <option <?php if ($oneExpense['pay_type']=='Cash') echo 'selected'?>>Cash</option>
                            <option <?php if ($oneExpense['pay_type']=='Cheque') echo 'selected'?>>Cheque</option>
                            <option <?php if ($oneExpense['pay_type']=='CreditEmp') echo 'selected'?>>CreditEmp</option>
                            <option <?php if ($oneExpense['pay_type']=='CreditSupp') echo 'selected'?>>CreditSupp</option>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="balance" style="margin-top: 5px">Balance</label>
                        <input type="text" id="balance" name="balance" class="form-control custom-input"
                               placeholder="Balance" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="expDate" style="margin-top: 5px">Exp Date</label>
                        <input type="text" id="expDate" name="expDate" class="form-control custom-input"
                               value="<?php echo $oneExpense['expense_date']?>" placeholder="Expense Date">
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="bankName" style="margin-top: 5px">Bank Name</label>
                        <select name="bankName" class="form-control col-sm-6 custom-input" id="bankName">
                            <option></option>
                            <option <?php if ($oneExpense['cheque_bank']=='Brac Bank') echo 'selected'?>>Brac Bank</option>
                            <option <?php if ($oneExpense['cheque_bank']=='DBBL') echo 'selected'?>>DBBL</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="creditAC" style="margin-top: 5px">Credit A/C</label>
                        <select name="creditAC" class="form-control col-sm-6 custom-input" id="creditAC">
                            <option></option>
                            <option>Cash Account</option>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="chequeNo" style="margin-top: 5px">Cheque No</label>
                        <select name="chequeNo" class="form-control col-sm-6 custom-input" id="chequeNo">
                            <option></option>
                            <option <?php if ($oneExpense['cheque_no']=='123456') echo 'selected'?>>123456</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="customerName" style="margin-top: 5px">Customer Name</label>
                        <input type="text" id="customerName" name="customerName" class="form-control custom-input"
                                 placeholder="Customer Name" readonly>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="projectId" style="margin-top: 5px">Project Code</label>
                        <select required name="projectId" class="form-control col-sm-6 custom-input" id="projectId">
                            <option></option>
                            <?php
                            if (isset($allProjects) && !empty($allProjects)) {
                                foreach ($allProjects as $oneProject) {
                                    ?>
                                    <option <?php if ($oneExpense['project_id']==$oneProject['project_id']) echo 'selected'?>><?php echo $oneProject['project_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="projectName" style="margin-top: 5px">Project Name</label>
                        <input type="text" id="projectName" name="projectName" class="form-control custom-input"
                               value="<?php echo $oneExpense['project_name']?>"  placeholder="Project Name" readonly>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="supplierId" style="margin-top: 5px">Supplier ID</label>
                        <select name="supplierId" class="form-control col-sm-6 custom-input" id="supplierId">
                            <option></option>
                            <?php
                            if (isset($allSuppliers) && !empty($allSuppliers)) {
                                foreach ($allSuppliers as $oneSupplier) {
                                    ?>
                                    <option <?php if ($oneExpense['supplier_id']==$oneSupplier['supplier_id']) echo 'selected'?>><?php echo $oneSupplier['supplier_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="expensedBy" style="margin-top: 5px">Expensed By</label>
                        <select name="expensedBy" class="form-control col-sm-6 custom-input" id="expensedBy">
                            <option></option>
                            <?php
                            if (isset($allEmployees) && !empty($allEmployees)) {
                                foreach ($allEmployees as $oneEmployee) {
                                    ?>
                                    <option <?php if ($oneExpense['expense_by']==$oneEmployee['first_name'].' '.$oneEmployee['last_name']) echo 'selected'?>><?php echo $oneEmployee['first_name'].' '.$oneEmployee['last_name']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="description" style="margin-top: 5px">Description</label>
                        <input type="text" id="description" name="description" class="form-control custom-input"
                               value="<?php echo $oneExpense['description']?>"  placeholder="Description">
                    </div>
                    <br><br><br>
                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Update</button>
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
        $("#expDate").datepicker({
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