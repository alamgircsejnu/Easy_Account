<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $_POST['companyId'] = $_SESSION['companyId'];
    $task = new VoucherEntry();
    $task->prepare($_POST);
    $lastTask = $task->lastEntry();
    if (isset($lastTask) && !empty($lastTask)){
        $lastTaskId = $lastTask['voucher_no'];
        $taskYear = substr($lastTaskId,2,4);
//    echo $taskYear;
//    die();
        $currentYear =  date('Y');
        if ($taskYear==$currentYear){

            $taskNumber = substr($lastTaskId,6);
            $newTaskNumber = (int)$taskNumber +1;
            $newTaskId = 'VN'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
        } else{
            $newTaskNumber = '1001';
            $newTaskId = 'VN'.date('Y').$newTaskNumber;
        }
    } else{
        $newTaskNumber = '1001';
        $newTaskId = 'VN'.date('Y').$newTaskNumber;
    }

    $expenseTypes = $task->expenseTypes();
    $allEmployees = $task->employees();
    $allProjects = $task->runningProjects();
    $allCustomers = $task->Customers();
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

<!--        .............................voucher.............................-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <script type="text/javascript">
            // if Google is down, it looks to local file...
            if (typeof jQuery == 'undefined') {
                document.write(unescape("%3Cscript src='../../../../asset/js/jquery-1.11.2.min.js' type='text/javascript'%3E%3C/script%3E"));
            }
        </script>
        <script type="text/javascript" src="../../../../asset/js/clone-form-td.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> <!-- only added as a smoke test for js conflicts -->
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

        <div class="col-md-4"></div>

        <div class="col-md-6">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Bill Entry Form</div>
                <br>
                <form role="form" action="store.php" method="post">
                    <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label" for="voucherNo">Voucher No<sup style="color: red">*</sup></label>
                        <input id="voucherNo" name="voucherNo" type="text" value="<?php echo $newTaskId ?>" placeholder="" class="form-control" required="" readonly style="height: 30px">

                    </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="date">Date<sup style="color: red">*</sup></label>
                            <input id="date" name="date" type="text" placeholder="YY-MM-DD" class="form-control" required="" style="height: 30px">

                        </div>

                    <div class="form-group col-md-4">
                        <label class="control-label" for="expenseType">Expense Type<sup style="color: red">*</sup></label>
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
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="employeeId">Employee ID<sup style="color: red">*</sup></label>
                            <select required name="employeeId" class="form-control col-sm-6 custom-input" id="employeeId">
                                <option></option>
                                <?php
                                if (isset($allEmployees) && !empty($allEmployees)) {
                                    foreach ($allEmployees as $oneEmployee) {
                                        ?>
                                        <option value="<?php echo $oneEmployee['employee_id']?>"><?php echo $oneEmployee['employee_id']?></option>

                                    <?php }}  ?>
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="employeeName">Employee Name:</label>
                            <input id="employeeName" name="employeeName" type="text" placeholder="" class="form-control" readonly style="height: 30px">

                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="customerName">Customer Name<sup style="color: red">*</sup></label>
                            <select required name="customerName" class="form-control col-sm-6 custom-input" id="customerName">
                                <option></option>
                                <?php
                                if (isset($allCustomers) && !empty($allCustomers)) {
                                    foreach ($allCustomers as $oneCustomer) {
                                        ?>
                                        <option value="<?php echo $oneCustomer['customer_name']?>"><?php echo $oneCustomer['customer_name']?></option>

                                    <?php }}  ?>
                            </select>

                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label class="control-label" for="projectId">Project Code<sup style="color: red">*</sup></label>
                            <select required name="projectId" class="form-control col-sm-6 custom-input" id="projectId">
                                <option></option>
                            </select>


                        </div>
                        <div class="form-group  col-md-4">
                            <label class="control-label" for="projectName">Project Name</label>
                            <input id="projectName" name="projectName" type="text" placeholder="" class="form-control" readonly style="height: 30px">
                        </div>
                        <div class="form-group  col-md-4">
                            <label class="control-label" for="projectDescription">Project Description</label>
                            <input id="projectDescription" name="projectDescription" type="text" placeholder="" class="form-control" readonly style="height: 30px">
                        </div>
                    </div>
                    <hr style="background-color: rebeccapurple;border-top-color: rebeccapurple;color: rebeccapurple;"><br>
                    <div>
                        <div id="transport_label">
                        <div class="form-group col-md-2">
                        <label class="control-label" for="from">From<sup style="color: red">*</sup></label>
                        </div>
                        <div class="form-group col-md-2">
                        <label class="control-label" for="to">To<sup style="color: red">*</sup></label>
                        </div>
                        <div class="form-group col-md-2">
                        <label class="control-label" for="vehicle">Vehicle<sup style="color: red">*</sup></label>
                        </div>
                        </div>
                        <div class="form-group col-md-6" id="description_label">
                        <label class="control-label" for="description">Description<sup style="color: red">*</sup></label>
                        </div>
                        <div class="form-group col-md-3">
                        <label class="control-label" for="amount">Amount<sup style="color: red">*</sup></label>
                        </div>
                        <div class="form-group col-md-3">
                        <label class="control-label" for="remark">Remark:</label>
                         </div>
                    </div><br><br>
                    <div id="entry1" class="clonedInput row">
                        <!--            <h4 id="reference" name="reference" class="heading-reference">Entry #1</h4>-->
                        <fieldset>
                            <div id="transport_div">
                            <!-- Text input-->
                            <div class="form-group col-md-2">

                                <input id="from" name="ID1_from" type="text" placeholder="" class="input_fn form-control" style="height: 30px">

                            </div>
                            <!-- Text input-->
                            <div class="form-group  col-md-2">

                                <input id="to" name="ID1_to" type="text" placeholder="" class="input_ln form-control" style="height: 30px">

                            </div>
                            <div class="form-group  col-md-2">
                                <select id="vehicle" name="ID1_vehicle" type="text" placeholder="" class="select_pn form-control" style="height: 30px">
                                    <option></option>
                                    <option>Rickshaw</option>
                                    <option>Bus</option>
                                    <option>CNG</option>
                                    <option>Car</option>
                                    <option>Train</option>
                                    <option>Pick-Up</option>
                                    <option>Micro-Bus</option>
                                    <option>Rickshaw-Van</option>
                                </select>

                            </div>
                            </div>
                            <div id="description_div" class="form-group col-md-6">

                                <input id="description" name="ID1_description" type="text" placeholder="" class="input_qn form-control" style="height: 30px">

                            </div>
                            <div class="form-group  col-md-3">

                                <input id="amount" name="ID1_amount" type="text" placeholder="" class="input_mn form-control" required="" style="height: 30px">

                            </div>

                            <div class="form-group  col-md-3">

                                <input id="remark" name="ID1_remark" type="text" placeholder="" class="input_on form-control" style="height: 30px">
                                <br>
                            </div>

                    </div><!-- end #entry1 -->
                    <!-- Button (Double) -->
                    <br>
                    <div id="buttonSet1">
                    <p class="pull-right">
                        <button type="button" id="btnAdd" name="btnAdd" class="btn btn-info">add</button>
                        <button type="button" id="btnDel" name="btnDel" class="btn btn-danger">remove</button>
                    </p>

                    <p>
                        <button id="submit_button" name="" class="btn btn-primary">Submit</button>
                    </p>
                    </div>
                    </fieldset>

                </form>
            </div>
        </div>


        <div class="col-md-2"></div>
    </div>


    <br><br><br><br>
    <script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>


    <script type="text/javascript">
        $(function () {
            $("#date").datepicker({
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
    <script type="text/javascript">
        $('#description_label').hide()
        $('#description_div').hide()
//        $('#buttonSet1').hide()

        $('#expenseType').change(function () {
            var value = this.value;
            if(value=="Transport")
            {
                $('#description_label').hide()
                $('#description_div').hide()
                $("#transport_label").show();
                $("#transport_div").show();
                $('#buttonSet1').show()
            } else {
                $("#transport_label").hide();
                $("#transport_div").hide();
                $("#description_label").show();
                $("#description_div").show();
                $('#buttonSet1').show()
            }
        });
    </script>
    <script type="text/javascript">
        $('#employeeId').on('change', function(){
            employeeId = $('#employeeId option:selected').val(); // the dropdown item selected value
            $.ajax({
                type :'POST',
                dataType:'json',
                data : { employeeId : employeeId },
                url : 'getAjaxEmployeeData.php',
                success : function(result){

                    $("#employeeName").val(result)
                }
            })

        });

    </script>
    <script type="text/javascript">
        $('#customerName').on('change', function(){
            customerName = $('#customerName option:selected').val(); // the dropdown item selected value
//        console.log(bankName);
            $.ajax({
                type :'POST',
                dataType:'json',
                data : { customerName : customerName },
                url : 'getAjaxProjectData.php',
                success : function(result){

                    $('#projectId').html('');
                    $('#projectId').append('<option></option>');
                    result.forEach(function(t) {
                        // $('#item') refers to the EMPTY select list
                        // the .append means add to the object refered to above
                        $('#projectId').append('<option>'+t['project_id']+'</option>');
                    });
                }
            })

        });

    </script>
    <script type="text/javascript">
        $('#projectId').on('change', function(){
            projectId = $('#projectId option:selected').val(); // the dropdown item selected value
            console.log(projectId);
            $.ajax({
                type :'POST',
                dataType:'json',
                data : { projectId : projectId },
                url : 'getAjaxProjectInformation.php',
                success : function(result){
                    console.log(result);
                    $("#projectName").val(result['project_name']);
                    $("#projectDescription").val(result['project_description']);
                }
            })

        });

    </script>
    <br><br><br><br><br><br>
    </body>
    </html>

<?php } ?>