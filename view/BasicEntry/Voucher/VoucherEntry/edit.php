<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Voucher\VoucherEntry\VoucherEntry;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['employeeId'] = $_SESSION['username'];
$_POST['voucherNo'] = $_GET['voucherNo'];
$voucher = new VoucherEntry();
$voucher->prepare($_POST);
$allVouchers = $voucher->show();
$expenseTypes = $voucher->expenseTypes();
$allEmployees = $voucher->employees();
$allProjects = $voucher->runningProjects();
//print_r($allVouchers);
//die();
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

    <div class="col-md-3"></div>

    <div class="col-md-7">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Bill Entry Form</div>
            <br>
            <form role="form" action="update.php" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label" for="voucherNo">Voucher No<sup style="color: red">*</sup></label>
                        <input id="voucherNo" name="voucherNo" type="text" value="<?php echo $allVouchers[0]['voucher_no'] ?>" placeholder="" class="form-control" required="" style="height: 30px">

                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="date">Date<sup style="color: red">*</sup></label>
                        <input id="date" name="date" type="text" value="<?php echo $allVouchers[0]['date'] ?>" placeholder="" class="form-control" required="" style="height: 30px">

                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label" for="expenseType">Expense Type<sup style="color: red">*</sup></label>
                        <select required name="expenseType" class="form-control col-sm-6 custom-input" id="expenseType" required="">
                            <option></option>
                            <?php
                            if (isset($expenseTypes) && !empty($expenseTypes)) {
                                foreach ($expenseTypes as $oneType) {
                                    ?>
                                    <option <?php if ($allVouchers[0]['expense_type']==$oneType['expense_type']) echo 'selected'?>><?php echo $oneType['expense_type']?></option>

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
                                    <option value="<?php echo $oneEmployee['employee_id']?>" <?php if ($allVouchers[0]['employee_id']==$oneEmployee['employee_id']) echo 'selected'?>><?php echo $oneEmployee['employee_id']?></option>

                                <?php }}  ?>
                        </select>

                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="designation">Designation:</label>
                        <input id="designation" name="designation" type="text" value="<?php echo $allVouchers[0]['employee_designation'] ?>" placeholder="" class="form-control" style="height: 30px">

                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label" for="projectId">Project Code<sup style="color: red">*</sup></label>
                        <select required name="projectId" class="form-control col-sm-6 custom-input" id="projectId">
                            <option></option>
                            <?php
                            if (isset($allProjects) && !empty($allProjects)) {
                                foreach ($allProjects as $oneProject) {
                                    ?>
                                    <option <?php if ($allVouchers[0]['project_id']==$oneProject['project_id']) echo 'selected'?>><?php echo $oneProject['project_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                </div>
                <hr style="background-color: rebeccapurple;border-top-color: rebeccapurple;color: rebeccapurple;"><br>

                    <!--            <h4 id="reference" name="reference" class="heading-reference">Entry #1</h4>-->
                    <fieldset>
                        <?php if ($allVouchers[0]['expense_type']=='Transport') {
                            ?>
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
                                <div class="form-group col-md-3">
                                    <label class="control-label" for="amount">Amount<sup style="color: red">*</sup></label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label" for="remark">Remark:</label>
                                </div>
                            </div><br><br>
                            <?php
                        if (isset($allVouchers) && !empty($allVouchers)) {
                            $serial = 0;
                            foreach ($allVouchers as $oneVoucher) {
                                $serial++
                                ?>

                        <div id="<?php echo 'entry'.$serial?>" class="clonedInput row">
                                <div id="transport_div">
                                    <!-- Text input-->
                                    <div class="form-group col-md-2">
                                        <input id="from" name="<?php echo 'ID'.$serial.'_from'?>" value="<?php echo $oneVoucher['from_place']?>" type="text" placeholder=""
                                               class="input_fn form-control" style="height: 30px">
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group  col-md-2">
                                        <input id="to" name="<?php echo 'ID'.$serial.'_to'?>" type="text" value="<?php echo $oneVoucher['to_place']?>" placeholder=""
                                               class="input_ln form-control" style="height: 30px">
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <select id="vehicle" name="<?php echo 'ID'.$serial.'_vehicle'?>" type="text" value="<?php echo $oneVoucher['vehicle']?>" placeholder=""
                                                class="select_pn form-control" style="height: 30px">
                                            <option></option>
                                            <option <?php if ($oneVoucher['vehicle']=='Rickshaw') echo 'selected'?>>Rickshaw</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Bus') echo 'selected'?>>Bus</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Rickshaw') echo 'CNG'?>>CNG</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Car') echo 'selected'?>>Car</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Train') echo 'selected'?>>Train</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Pick-Up') echo 'selected'?>>Pick-Up</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Micro-Bus') echo 'selected'?>>Micro-Bus</option>
                                            <option <?php if ($oneVoucher['vehicle']=='Rickshaw-Van') echo 'selected'?>>Rickshaw-Van</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  col-md-3">
                                    <input id="amount" name="<?php echo 'ID'.$serial.'_amount'?>" type="text" value="<?php echo $oneVoucher['amount']?>" placeholder=""
                                           class="input_mn form-control" required="" style="height: 30px">
                                </div>

                                <div class="form-group  col-md-3">
                                    <input id="remark" name="<?php echo 'ID'.$serial.'_remark'?>" type="text" value="<?php echo $oneVoucher['remarks']?>" placeholder=""
                                           class="input_on form-control" style="height: 30px">
                                    <br>
                                </div>
                        </div><!-- end #entry1 -->
                                <?php
                            }
                        }
                        } else {
                        ?>
                            <?php
                        if (isset($allVouchers) && !empty($allVouchers)) {
                            ?>
                            <div>

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
                            <?php
                            $serial = 0;
                            foreach ($allVouchers as $oneVoucher) {
                                $serial++
                                ?>

                        <div id="<?php echo 'entry'.$serial?>" class="clonedInput row">
                            <div class="form-group  col-md-6">
                                <input id="description" name="<?php echo 'ID'.$serial.'_description'?>" type="text" value="<?php echo $oneVoucher['description']?>" placeholder=""
                                       class="input_qn form-control" required="" style="height: 30px">
                            </div>
                                <div class="form-group  col-md-3">
                                    <input id="amount" name="<?php echo 'ID'.$serial.'_amount'?>" type="text" value="<?php echo $oneVoucher['amount']?>" placeholder=""
                                           class="input_mn form-control" required="" style="height: 30px">
                                </div>
                                <div class="form-group  col-md-3">
                                    <input id="remark" name="<?php echo 'ID'.$serial.'_remark'?>" type="text" value="<?php echo $oneVoucher['remarks']?>" placeholder=""
                                           class="input_on form-control" style="height: 30px">
                                    <br>
                                </div>
                        </div><!-- end #entry1 -->
                                <?php
                         }
                        }
                        }
                        ?>
                    </fieldset>

                <!-- Button (Double) -->
                <br>
                <div id="buttonSet1">
                    <p class="pull-right">
                        <button type="button" id="btnAdd" name="btnAdd" class="btn btn-info">add</button>
                        <button type="button" id="btnDel" name="btnDel" class="btn btn-danger">remove</button>
                    </p>

                    <p>
                        <button id="submit_button" name="" class="btn btn-primary">Update</button>
                    </p>
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
    $('#description_div').hide()
    //        $('#buttonSet1').hide()

    $('#expenseType').change(function () {
        var value = this.value;
        if(value=="Transport")
        {
            $('#description_div').hide()
            $("#transport_div").show();
            $('#buttonSet1').show()
        } else {
            $("#transport_div").hide();
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

                $("#designation").val(result)
            }
        })

    });

</script>
<br><br><br><br><br><br>
</body>
</html>
