<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Income\Income;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $_POST['companyId'] = $_SESSION['companyId'];
    $task = new Income();
    $task->prepare($_POST);
    $lastTask = $task->lastEntry();
    if (isset($lastTask) && !empty($lastTask)){
        $lastTaskId = $lastTask['income_id'];
        $taskYear = substr($lastTaskId,2,4);
//    echo $taskYear;
//    die();
        $currentYear =  date('Y');
        if ($taskYear==$currentYear){

            $taskNumber = substr($lastTaskId,6);
            $newTaskNumber = (int)$taskNumber +1;
            $newTaskId = 'IN'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
        } else{
            $newTaskNumber = '1001';
            $newTaskId = 'IN'.date('Y').$newTaskNumber;
        }
    } else{
        $newTaskNumber = '1001';
        $newTaskId = 'IN'.date('Y').$newTaskNumber;
    }

    $expenseTypes = $task->expenseTypes();
    $allProjects = $task->projectCodes();
    $allBanks = $task->bankNames();
    $accountNumbers = $task->accountNumbers();
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

        <div class="col-md-4"></div>

        <div class="col-md-6">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Add New Income</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <div>
                        <div class="col-md-6">
                            <label for="incomeId" style="margin-top: 5px">Income Code</label>
                            <input type="text" id="incomeId" name="incomeId" class="form-control custom-input"
                                   value="<?php echo $newTaskId ?>" placeholder="Income Code" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="incomeAmount" style="margin-top: 5px">Income Amount</label>
                            <input type="text" id="incomeAmount" name="incomeAmount" class="form-control custom-input"
                                    placeholder="Income Amount" required>
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="incomeDate" style="margin-top: 5px">Income Date</label>
                            <input type="text" id="incomeDate" name="incomeDate" class="form-control custom-input"
                                   placeholder="Income Date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="vat" style="margin-top: 5px">VAT</label>
                            <input type="text" id="vat" name="vat" class="form-control custom-input"
                                   placeholder="VAT">
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="ait" style="margin-top: 5px">AIT</label>
                            <input type="text" id="ait" name="ait" class="form-control custom-input"
                                   placeholder="AIT">
                        </div>
                        <div class="col-md-6">
                            <label for="payType" style="margin-top: 5px">Pay Type</label>
                            <select name="payType" class="form-control col-sm-6 custom-input" id="payType">
                                <option></option>
                                <option>Cash</option>
                                <option>Cheque</option>
                            </select>
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="chequeNo" style="margin-top: 5px">Cheque No</label>
                            <input type="text" id="chequeNo" name="chequeNo" class="form-control custom-input"
                                   placeholder="Cheque No">
                        </div>

                        <div class="col-md-6">
                            <label for="bankName" style="margin-top: 5px">Bank Name</label>
                            <input type="text" id="bankName" name="bankName" class="form-control custom-input"
                                   placeholder="Bank Name">
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="depositAC" style="margin-top: 5px">Deposit A/C</label>
                            <select required name="depositAC" class="form-control col-sm-6 custom-input" id="depositAC">
                                <option></option>
                                <?php
                                if (isset($accountNumbers) && !empty($accountNumbers)) {
                                    foreach ($accountNumbers as $oneAccount) {
                                        ?>
                                        <option><?php echo $oneAccount['account_number']?></option>

                                    <?php }}  ?>
                            </select>
                        </div>

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
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="projectPO" style="margin-top: 5px">Project PO</label>
                            <input type="text" id="projectPO" name="projectPO" class="form-control custom-input"
                                   placeholder="Project PO" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="projectName" style="margin-top: 5px">Project Name</label>
                            <input type="text" id="projectName" name="projectName" class="form-control custom-input"
                                   placeholder="Project Name" readonly>
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="customerName" style="margin-top: 5px">Customer Name</label>
                            <input type="text" id="customerName" name="customerName" class="form-control custom-input"
                                   placeholder="Customer Name" readonly>
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
                                    <button type="submit" class="btn btn-info pull-right">Add Income</button>
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
            $("#incomeDate").datepicker({
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
                    $("#projectPO").val(result['project_price']);
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
            } else if (payType == 'Cheque'){
                $('#bankName').prop('disabled', false);
                $('#chequeNo').prop('disabled', false);
                $('#creditAC').prop('disabled', false);
            } else if (payType == 'CreditEmp' || payType == 'CreditSupp'){
                $('#bankName').prop('disabled', true);
                $('#chequeNo').prop('disabled', true);
                $('#creditAC').prop('disabled', true);
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
    </body>
    </html>

<?php } ?>