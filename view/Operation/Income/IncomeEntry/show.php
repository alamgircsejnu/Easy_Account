<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Income\Income;

$_POST['companyId'] = $_SESSION['companyId'];
//session_start();
$_POST['id'] = $_GET['id'];

$income = new Income();
$income->prepare($_POST);
$oneIncome = $income->show();
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
    </style>
</head>

<body>

<?php
include_once '../../../../view/Navigation/Nav/Navbar/navigation.php';
?>


<br><br>

<div class="row" style="margin-left: 21%;width: 800px">
    <div class="col-md-2"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;">
        <div class="row">
            <div class="table-responsive" id="custom-table">
                <table class="table table-bordered">
                    <tbody>
                    <tr style="background-color: #9acfea">
                        <td colspan="2">
                            <div align="center">
                                <p><b>Income Details</b></p>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Income ID :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['income_id'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Id :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['project_id']?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['project_name']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Description :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['description']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Pay Type :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['pay_type']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Cheque No :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['cheque_no']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Bank Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['cheque_bank']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Deposit A/C :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['deposit_bank']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Income Amount :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['income_amount']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Income Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['income_date']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Entry Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['entry_date']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Entry By :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['entry_by']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>VAT :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['vat']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>AIT :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['ait']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Customer Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneIncome['customer_name']; ?></p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
</div>


<br><br><br><br>
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="../../../../asset/js/jquery.min.js"></script>
<script src="jquery.checkAll.js"></script>
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
</body>
</html>