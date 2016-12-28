<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Operation\Expense\Expense;

$_POST['companyId'] = $_SESSION['companyId'];
$_POST['employeeId'] = $_SESSION['username'];

$expense = new Expense();
$expense->prepare($_POST);
$allExpenses = $expense->index();
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
        #custom-table{
        td,th{
            width: 300px!important;
        }
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

    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Expense Id</th>
                    <th align="center">Expense Type</th>
                    <th align="center">Project Code</th>
                    <th align="center">Pay Type</th>
                    <th align="center">Expense Amount</th>
                    <th align="center">Expense Date</th>
                    <th align="center">Expensed By</th>
                    <th align="center">Action</th>
                    <th align="center">Status</th>
                </tr>
                </thead>
                <?php
                if (isset($allExpenses) && !empty($allExpenses)) {
                $serial = 0;
                foreach ($allExpenses as $oneExpense) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneExpense['expense_id'] ?></td>
                    <td><?php echo $oneExpense['expense_type']?></td>
                    <td><?php echo $oneExpense['project_id']?></td>
                    <td><?php echo $oneExpense['pay_type']; ?></td>
                    <td><?php echo $oneExpense['expense_amount']; ?></td>
                    <td><?php echo $oneExpense['expense_date']; ?></td>
                    <td><?php echo $oneExpense['expense_by']; ?></td>
                    <td width="130">
                        <a href="show.php?id=<?php echo $oneExpense['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                                   title="See Details" alt="Details"
                                                                                                   src="../../../../asset/images/showDetails.png"
                                                                                                   width="25" height="20"></a>
                        <a href="edit.php?id=<?php echo $oneExpense['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                                   title="Edit" alt="Edit"
                                                                                                   src="../../../../asset/images/edit.png"
                                                                                                   width="25" height="20"></a>
                        <a href="trash.php?id=<?php echo $oneExpense['id'] ?>" onclick="return confirm('Are you sure?')">
                            <img style="margin: 3%" border="0" title="Delete" alt="Delete"
                                 src="../../../../asset/images/delete.png" width="25" height="20"></a>
                    </td>
                    <td style="width: 130px">
                        <?php
                        if ($oneExpense['is_approved'] == 0) {
                            ?>
                            Pending
                            <?php
                        } else {

                            ?>
                            Approved
                            <?php
                        }
                        ?>
                    </td>
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-1"></div>
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