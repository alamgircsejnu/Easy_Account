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

        #custom-table td,th{
            border: 1px solid black;
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
    <div class="col-md-3">
        <?php
        if ($allVouchers[0]['is_approved']==1){
        ?>
        <a href="print.php?voucherNo=<?php echo $_GET['voucherNo'] ?>" target="_blank" class="btn btn-primary" style="margin-left: 125px">Print</a>
        <?php
        }else {
        ?>
            <a href="approveFromShow.php?voucherNo=<?php echo $_GET['voucherNo'] ?>" class="btn btn-primary" style="margin-left: 100px">Approve</a>
        <?php
        }
        ?>
    </div>
</div>

<div id="printReport" style="font-family: 'Palatino Linotype';width: 1300px;">
<div id="table-caption" class="row">
    <div class="col-md-3"></div>
    <div id="company-name" class="col-md-8" style="background-color: white;text-align: center">
       <h5><b>2RA TECHNOLOGY LIMITED</b></h5>
        <h6><b>3<sup>rd</sup> Floor, House# 294, Lane# 04, Mirpur DOHS, Dhaka</b></h6>
        <h4><b><u>BILL</u></b></h4><br>
    </div>
    <div class="col-md-2"></div>

<div class="row" style="margin-left: 106px;width: 100%">
    <div class="col-md-1"></div>
    <div class="col-md-8"  style="background-color: white">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <?php
       echo '<p>Name : '.$allVouchers[0]['employee_name'].'</p>'
        ?>
    </div>
    <div class="col-md-4">
        <?php
        echo '<p>Designation : '.$allVouchers[0]['employee_designation'].'</p>'
        ?>
    </div>
    <div class="col-md-3">
        <?php
        echo '<p>Project Name : '.$allVouchers[0]['project_name'].'</p>'
        ?>
    </div>
    <div class="col-md-1"></div>
</div><br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <?php
        echo '<p>Expense Type : '.$allVouchers[0]['expense_type'].'</p>'
        ?>
    </div>
    <div class="col-md-4">
        <?php
        echo '<p>Voucher No : '.$allVouchers[0]['voucher_no'].'</p>'
        ?>
    </div>
    <div class="col-md-3">
        <?php
        echo '<p>Date : '.$allVouchers[0]['date'].'</p>'
        ?>
    </div>
</div><br>
<div class="row">

    <div id="custom-table row" style="background-color: white;padding: 1px">

        <?php
        if ($allVouchers[0]['expense_type'] == 'Transport'){
        ?>
        <div class="col-md-1"></div>
        <div class="table-responsive" id="custom-table">
            <table class="col-md-10"  style="border: 1px solid black">
                <thead>
                <tr>
                    <th align="center" width="30">SL No.</th>
                    <th align="center" width="130">From</th>
                    <th align="center" width="130">To</th>
                    <th align="center" width="130">Vehicle</th>
                    <th align="center">Amount(taka)</th>
                    <th align="center">Remarks</th>
                </tr>
                </thead>
                <?php
                $totalAmount = 0;
                if (isset($allVouchers) && !empty($allVouchers)) {
                $serial = 0;

                foreach ($allVouchers as $oneVoucher) {
                $serial++;
                $totalAmount += $oneVoucher['amount'];
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneVoucher['from_place'] ?></td>
                    <td><?php echo $oneVoucher['to_place']?></td>
                    <td><?php echo $oneVoucher['vehicle']?></td>
                    <td><?php echo $oneVoucher['amount']; ?></td>
                    <td><?php echo $oneVoucher['remarks']; ?></td>
                </tr>
                <?php
                }
                } else {
                    ?>
                    <tr>
                        <td colspan="9" align="center">
                            <?php echo "No Data Available " ?>

                        </td>
                    </tr>
                <?php }
                ?>
                <tr>
                    <td colspan="4" style="text-align: right!important;">
                        <?php echo "Total Amount: " ?>

                    </td>
                    <td align="center">
                        <?php
                        $inWords = $voucher->convertingIntoWords($totalAmount);
                        ?>
                        <?php echo $totalAmount ?>

                    </td>
                    <td align="center">

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
        <?php
        } else {
        ?>
            <div class="table-responsive" id="custom-table">
                <div class="col-md-1"></div>
                <table style="border: 1px solid black" class="col-md-10">
                    <thead>
                    <tr style="border: 1px solid black">
                        <th align="center">SL No.</th>
                        <th align="center" style="width: 300px">Description</th>
                        <th align="center">Amount(taka)</th>
                        <th align="center">Remarks</th>
                    </tr>
                    </thead>
                    <?php
                    $totalAmount = 0;
                    if (isset($allVouchers) && !empty($allVouchers)) {
                    $serial = 0;
                    foreach ($allVouchers as $oneVoucher) {
                    $serial++;
                    $totalAmount += $oneVoucher['amount'];
                    ?>
                    <tbody>
                    <tr>
                        <td style="width: 50px!important;"><?php echo $serial ?></td>
                        <td style="width: 300px"><?php echo $oneVoucher['description'] ?></td>
                        <td style="width: 70px!important;"><?php echo $oneVoucher['amount']; ?></td>
                        <td style="width: 70px!important;"><?php echo $oneVoucher['remarks']; ?></td>
                    </tr>
                    <?php
                    }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9" align="center">
                                <?php echo "No Data Available " ?>

                            </td>
                        </tr>
                    <?php }
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right!important;">
                            <?php echo "Total Amount: " ?>

                        </td>
                        <td align="center">
                            <?php
                            $inWords = $voucher->convertingIntoWords($totalAmount);
                            ?>
                            <?php echo $totalAmount ?>

                        </td>
                        <td align="center">

                        </td>
                    </tr>
                    </tbody>
                </table>


            </div>

       <?php
        }
        ?>
        <div class="col-md-1"></div>
        <?php
        echo '<p style="margin-left: 10%;margin-top: 2%"><b>In Words </b>: '.$inWords.' Taka Only </p><br>';
        ?>
        <div style="height: 70px;">
            <div style="float: left;margin-left: 93px">
                <p><u>Submitted by</u></p>
            </div>
            <div style="float: left;margin-left: 200px">
                <p><u>Verified by</u></p>
            </div>
            <div style="float: left;margin-left: 200px">
                <p><u>Approved by</u></p>
            </div>
        </div>
    </div>
</div>
    </div>
    <div class="col-md-2"></div>
</div>
</div>

<br><br><br><br>
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="../../../../asset/js/jquery.min.js"></script>
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
<script>
    function printDiv() {
//        console.log(elementId);
        var divToPrint = document.getElementById('printReport').innerHTML;
        var myWindow=window.open();
        myWindow.document.write(divToPrint);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }

</script>
</body>
</html>