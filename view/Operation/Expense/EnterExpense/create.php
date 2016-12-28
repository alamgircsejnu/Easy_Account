<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
$_POST['companyId'] = $_SESSION['companyId'];
$task = new Expense();
$task->prepare($_POST);
$lastTask = $task->lastEntry();
if (isset($lastTask) && !empty($lastTask)){
    $lastTaskId = $lastTask['expense_id'];
    $taskYear = substr($lastTaskId,2,4);
//    echo $taskYear;
//    die();
    $currentYear =  date('Y');
    if ($taskYear==$currentYear){

        $taskNumber = substr($lastTaskId,6);
        $newTaskNumber = (int)$taskNumber +1;
        $newTaskId = 'EX'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
    } else{
        $newTaskNumber = '1001';
        $newTaskId = 'EX'.date('Y').$newTaskNumber;
    }
} else{
    $newTaskNumber = '1001';
    $newTaskId = 'EX'.date('Y').$newTaskNumber;
}

$expenseTypes = $task->expenseTypes();
$allProjects = $task->projectCodes();
$allVouchers = $task->vouchers();
$allEmployees = $task->allEmployee();
$allSuppliers = $task->allSuppliers();
$allBanks = $task->bankNames();
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
            font-family: "Georgia"!important;
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

            <div class="panel-heading">Add New Expense</div>
            <br>
            <form role="form" action="store.php" method="post">
                <div class="col-md-4">
                    <label for="voucherNo" style="margin-top: 5px;float: right">Add Voucher :</label>
                </div>
                <div class="col-md-6">

                    <select name="voucherNo" class="form-control col-sm-6 custom-input" id="voucherNo">
                        <option></option>
                        <?php
                        if (isset($allVouchers) && !empty($allVouchers)) {
                            foreach ($allVouchers as $oneVoucher) {
                                ?>
                                <option><?php echo $oneVoucher['voucher_no']?></option>

                            <?php }}  ?>
                    </select>
                </div>
                <br><br><br>
                <div>
                    <div class="col-md-6">
                        <label for="expenseId" style="margin-top: 5px">Expense Code</label>
                        <input type="text" id="expenseId" name="expenseId" class="form-control custom-input"
                               value="<?php echo $newTaskId ?>" placeholder="Expense Code" required>
                    </div>
                    <div class="col-md-6">
                        <label for="expenseType" style="margin-top: 5px">Expense Type</label>
                        <select required name="expenseType" class="form-control col-sm-6 custom-input" id="expenseType">
                            <option></option>
                            <?php
                            if (isset($expenseTypes) && !empty($expenseTypes)) {
                                foreach ($expenseTypes as $oneType) {
                                    ?>
                                    <option><?php echo $oneType['expense_type']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="amount" style="margin-top: 5px">Amount</label>
                        <input type="text" id="amount" name="amount" class="form-control custom-input"
                               placeholder="Amount" required>
                    </div>
                    <div class="col-md-6">
                        <label for="payType" style="margin-top: 5px">Pay Type</label>
                        <select name="payType" class="form-control col-sm-6 custom-input" id="payType">
                            <option></option>
                            <option>Cash</option>
                            <option>Cheque</option>
                            <option>CreditEmp</option>
                            <option>CreditSupp</option>
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
                               placeholder="Expense Date">
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="bankName" style="margin-top: 5px">Bank Name</label>
                        <select name="bankName" class="form-control col-sm-6 custom-input" id="bankName">
                            <option></option>
                            <?php
                            if (isset($allBanks) && !empty($allBanks)) {
                                foreach ($allBanks as $oneBank) {
                                    if ($oneBank['account_bank']!='NA'){
                                    ?>
                                    <option><?php echo $oneBank['account_bank']?></option>

                                <?php }}}  ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="creditAC" style="margin-top: 5px">Credit A/C</label>
                        <select name="creditAC" class="form-control col-sm-6 custom-input" id="creditAC">
                            <option></option>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="chequeNo" style="margin-top: 5px">Cheque No</label>
                        <select name="chequeNo" class="form-control col-sm-6 custom-input" id="chequeNo">
                            <option></option>
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
                                    <option><?php echo $oneProject['project_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="projectName" style="margin-top: 5px">Project Name</label>
                        <input type="text" id="projectName" name="projectName" class="form-control custom-input"
                               placeholder="Project Name" readonly>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="supplierId" style="margin-top: 5px">Supplier Name</label>
                        <select name="supplierId" class="form-control col-sm-6 custom-input" id="supplierId">
                            <option></option>
                            <?php
                            if (isset($allSuppliers) && !empty($allSuppliers)) {
                                foreach ($allSuppliers as $oneSupplier) {
                                    ?>
                                    <option><?php echo $oneSupplier['supplier_name']?></option>

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
                                    <option><?php echo $oneEmployee['employee_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="description" style="margin-top: 5px">Description</label>
                        <input type="text" id="description" name="description" class="form-control custom-input"
                               placeholder="Description">
                    </div>
                    <br><br><br>



                </div>

                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Add Expense</button>
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
<script type="text/javascript">
    $('#projectId').on('change', function(){
        projectId = $('#projectId option:selected').val(); // the dropdown item selected value
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { projectId : projectId },
            url : 'getAjaxProjectData.php',
            success : function(result){

                $("#projectName").val(result['project_name']);
                $("#customerName").val(result['customer_name']);
            }
        })

    });

</script>
<script type="text/javascript">
    $(function () {
        $('#bankName').prop('disabled', true);
        $('#chequeNo').prop('disabled', true);
        $('#creditAC').prop('disabled', true);
    });
    $('#payType').on('change', function(){
        payType = $('#payType option:selected').val(); // the dropdown item selected value
        if (payType == 'Cash'){
            $('#bankName').prop('disabled', true);
            $('#chequeNo').prop('disabled', true);
            $('#creditAC').prop('disabled', false);
            $('#creditAC').html('');
            $('#bankName').html('');
            $('#creditAC').append('<option selected>Cash Account</option>');
        } else if (payType == 'Cheque'){
            $('#bankName').prop('disabled', false);
            $('#chequeNo').prop('disabled', false);
            $('#creditAC').prop('disabled', false);

        } else if (payType == 'CreditEmp' || payType == 'CreditSupp'){
            $('#bankName').prop('disabled', true);
            $('#chequeNo').prop('disabled', true);
            $('#creditAC').prop('disabled', true);
            $('#creditAC').html('');
            $('#bankName').html('');
            $('#creditAC').append('<option></option>');
        }

    });

</script>
<script type="text/javascript">
    $('#expenseType').on('change', function(){
        $('#voucherNo').prop('disabled', true);
    });

</script>
<script type="text/javascript">
    $('#voucherNo').on('change', function(){
        voucherNo = $('#voucherNo option:selected').val(); // the dropdown item selected value

        $.ajax({
            type :'POST',
            dataType:'json',
            data : { voucherNo : voucherNo },
            url : 'getAjaxVoucherData.php',
            success : function(result){
                console.log(result);
                $("#amount").val(result['amount']);
                $("#expenseType").val(result['expenseType']);
                $("#expDate").val(result['expDate']);
                $("#projectId").val(result['projectId']);
                $("#projectName").val(result['projectName']);
                $("#customerName").val(result['customerName']);
                $("#expensedBy").val(result['expensedBy']);
            }
        })

    });

</script>
<script type="text/javascript">
    $('#bankName').on('change', function(){
        bankName = $('#bankName option:selected').val(); // the dropdown item selected value
//        console.log(bankName);
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { bankName : bankName },
            url : 'getAjaxAccountData.php',
            success : function(result){

                $('#creditAC').html('');
                $('#creditAC').append('<option></option>');
                result.forEach(function(t) {
                    // $('#item') refers to the EMPTY select list
                    // the .append means add to the object refered to above
                    $('#creditAC').append('<option>'+t['account_number']+'</option>');
                    });
            }
        })

    });

</script>
<script type="text/javascript">
    $('#creditAC').on('change', function(){
        creditAC = $('#creditAC option:selected').val(); // the dropdown item selected value
//        console.log(bankName);
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { creditAC : creditAC },
            url : 'getAjaxChequeData.php',
            success : function(result){
//                console.log(result);
//                $("#balance").val(result['account_balance']);
                $('#chequeNo').html('');
                $('#chequeNo').append('<option></option>');
                result.forEach(function(t) {
                    // $('#item') refers to the EMPTY select list
                    // the .append means add to the object refered to above

                    $('#chequeNo').append('<option>'+t['cheque_number']+'</option>');
                });
            }
        })

    });

</script>
<script type="text/javascript">
    $('#creditAC').on('change', function(){
        creditAC = $('#creditAC option:selected').val(); // the dropdown item selected value

        $.ajax({
            type :'POST',
            dataType:'json',
            data : { creditAC : creditAC },
            url : 'getAjaxAccountBalance.php',
            success : function(result){
                console.log(result);
                $("#balance").val(result['account_balance']);
            }
        })

    });

</script>
</body>
</html>

<?php } ?>