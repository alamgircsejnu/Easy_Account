<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ChequeBook\ChequeBookEntry\ChequeBookEntry;
$_POST['companyId'] = $_SESSION['companyId'];
$chequeBook = new ChequeBookEntry();
$chequeBook->prepare($_POST);
$allCheque = $chequeBook->index();
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
        th,td{
            text-align: center;
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
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <a href="deleteAll.php" class="btn btn-primary" onclick="return confirm('Are you sure? You want to delete all data?')">Delete All Data</a>
        <div id="custom-table" style="background-color: #9acfea;padding: 1px">


            <div class="table-responsive" id="custom-table">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th align="center">SL#</th>
                        <th align="center">Cheque Number</th>
                        <th align="center">Account Number</th>
                        <th align="center">Bank Name</th>
                        <th align="center">Status</th>
                        <th align="center">Received By</th>
                        <th align="center">Delete</th>
                    </tr>
                    </thead>
                    <?php
                    if (isset($allCheque) && !empty($allCheque)) {
                    $serial = 0;
                    foreach ($allCheque as $oneCheque) {
                    $serial++
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $serial ?></td>
                        <td><?php echo $oneCheque['cheque_number'] ?></td>
                        <td><?php echo $oneCheque['account_number']; ?></td>
                        <td><?php echo $oneCheque['bank_name']; ?></td>
                        <td><?php echo $oneCheque['status']; ?></td>
                        <td><?php echo $oneCheque['received_by']; ?></td>
                        <td style="width: 130px">
                            <a href="delete.php?id=<?php echo $oneCheque['id'] ?>" onclick="return confirm('Are you sure?')">
                                <img style="margin: 3%" border="0" title="Delete This Cheque" alt="Delete"
                                     src="../../../../asset/images/delete.png" width="25" height="20"></a>
                        </td>
                    </tr>
                    <?php
                    }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" align="center">
                                <?php echo "No Data Available " ?>

                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
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