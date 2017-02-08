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
$voucher->printed();
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

        table td,th{
            border: 1px solid black;
        }
    </style>
</head>

<body>
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
<div id="printReport" style="font-family: 'Palatino Linotype'">
    <div id="table-caption" class="row" style="margin-bottom: 0px">
        <div class="col-md-2"></div>
        <div id="company-name" class="col-md-8" style="background-color: white;text-align: center">
            <h5 style="margin-bottom: 0px;font-size: 17px"><b>2RA TECHNOLOGY LIMITED</b></h5>
            <h6 style="margin-top: 0px;margin-bottom:0px;font-size: 14px"><b>3<sup>rd</sup> Floor, House# 294, Lane# 04, Mirpur DOHS, Dhaka</b></h6>
            <h4 style="margin-top: 0px;margin-bottom:0px;font-size: 17px"><b><u>BILL</u></b></h4>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div style="margin-top: 0px;font-size: 16px">
        <div style="background-color: white">
            <div style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px">
                <div>
                    <?php
                    echo '<p style="float: left;margin-left: 55px;margin-top: 5px;margin-bottom: 0px">Date : '.$allVouchers[0]['date'].'</p>'
                    ?>
                </div>
                <div>
                    <?php
                    echo '<p style="float: left;margin-left: 50px;margin-top: 5px;margin-bottom: 0px;min-width: 140px">Expense Type : '.$allVouchers[0]['expense_type'].'</p>'
                    ?>
                </div>
                <div>
                    <?php
                    echo '<p style="float: left;margin-left: 50px;margin-top: 5px;margin-bottom: 0px">Voucher No : '.$allVouchers[0]['voucher_no'].'</p>'
                    ?>
                </div>
            </div>
            <div style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px">
                <div>
                    <?php
                    echo '<p style="float: left;margin-left: 55px;margin-top: 5px;margin-bottom: 5px">Name : '.$allVouchers[0]['employee_name'].'</p>'
                    ?>
                </div>
                <div>
                    <?php
                    echo '<p style="float: left;margin-left: 70px;margin-top: 5px;margin-bottom: 5px">Project Name : '.$allVouchers[0]['project_name'].' - '.$allVouchers[0]['customer_name'].'</p>'
                    ?>
                </div>
            </div><br>
            <div>

                <div style="background-color: white;padding: 1px">
                    <?php
                    if ($allVouchers[0]['expense_type'] == 'Transport'){
                        ?>

                        <div>
                            <table style="border-collapse: collapse;border: 1px solid black;margin-left: 50px;">
                                <thead>
                                <tr>
                                    <th align="center" style="border-collapse: collapse;border: 1px solid black">SL.</th>
                                    <th align="center" width="200"  style="border-collapse: collapse;border: 1px solid black">From</th>
                                    <th align="center" width="200"  style="border-collapse: collapse;border: 1px solid black">To</th>
                                    <th align="center" width="140"  style="border-collapse: collapse;border: 1px solid black">Vehicle</th>
                                    <th align="center" width="140"  style="border-collapse: collapse;border: 1px solid black">Amount(BDT)</th>
                                    <th align="center" width="140"  style="border-collapse: collapse;border: 1px solid black">Remarks</th>
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
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black;font-size: 14px"><?php echo $serial ?></td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black;font-size: 14px"><?php echo $oneVoucher['from_place'] ?></td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black;font-size: 14px"><?php echo $oneVoucher['to_place']?></td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black;font-size: 14px"><?php echo $oneVoucher['vehicle']?></td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black;font-size: 14px"><?php echo $oneVoucher['amount']; ?></td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black;font-size: 14px"><?php echo $oneVoucher['remarks']; ?></td>
                                </tr>
                                <?php
                                }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" align="center">
                                            <?php echo "No Data Available " ?>

                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td colspan="4" style="text-align: right!important;border-collapse: collapse;border: 1px solid black">
                                        <?php echo "<p style='margin-right: 20px'><b>Total Amount: </b></p>" ?>

                                    </td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black">
                                        <?php
                                        $inWords = $voucher->convertingIntoWords($totalAmount);
                                        ?>
                                        <?php echo '<b>'.$totalAmount.'</b>' ?>

                                    </td>
                                    <td align="center">

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div>
                            <table style="border-collapse: collapse;margin-left: 50px">
                                <thead>
                                <tr>
                                    <th align="center" style="border-collapse: collapse;border: 1px solid black">SL No.</th>
                                    <th align="center" style="width: 350px;border-collapse: collapse;border: 1px solid black">Description</th>
                                    <th align="center" style="border-collapse: collapse;border: 1px solid black">Amount(BDT)</th>
                                    <th align="center" style="border-collapse: collapse;border: 1px solid black">Remarks</th>
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
                                    <td align="center" style="width: 50px!important;border-collapse: collapse;border: 1px solid black"><?php echo $serial ?></td>
                                    <td align="center" style="width: 350px;border-collapse: collapse;border: 1px solid black"><?php echo $oneVoucher['description'] ?></td>
                                    <td align="center" style="width: 100px!important;border-collapse: collapse;border: 1px solid black"><?php echo $oneVoucher['amount']; ?></td>
                                    <td align="center" style="width: 100px!important;border-collapse: collapse;border: 1px solid black"><?php echo $oneVoucher['remarks']; ?></td>
                                </tr>
                                <?php
                                }
                                } else {
                                    ?>
                                    <tr style="border-collapse: collapse;border: 1px solid black">
                                        <td colspan="4" align="center">
                                            <?php echo "No Data Available " ?>

                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td colspan="2" style="text-align: right!important;border-collapse: collapse;border: 1px solid black">
                                        <?php echo "<p style='margin-right: 20px'><b>Total Amount: </b></p> " ?>

                                    </td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black">
                                        <?php
                                        $inWords = $voucher->convertingIntoWords($totalAmount);
                                        ?>
                                        <?php echo '<b>'.$totalAmount.'</b>' ?>

                                    </td>
                                    <td align="center" style="border-collapse: collapse;border: 1px solid black">

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
                    <?php
                    echo '<p style="margin-left: 70px;margin-top: 2%"><b>In Words </b>: '.$inWords.' Taka Only </p><br>';
                    ?>
                    <div style="height: 70px;">
                        <div style="float: left;margin-left: 70px">
                            <p><u>Submitted by</u></p>
                        </div>
                        <div style="float: left;margin-left: 160px">
                            <p><u>Verified by</u></p>
                        </div>
                        <div style="float: left;margin-left: 160px">
                            <p><u>Approved by</u></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="show.php?voucherNo=<?php echo $_GET['voucherNo'] ?>" id="redirectShow"></a>
<br><br><br><br>
<script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="../../../../asset/js/jquery.min.js"></script>

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
        $('#redirectShow').trigger('click');
    }
    printDiv();

</script>
</body>
</html>
