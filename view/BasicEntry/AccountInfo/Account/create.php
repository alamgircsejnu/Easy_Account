<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\AccountInfo\Account\Account;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $_POST['companyId'] = $_SESSION['companyId'];
    $task = new Account();
    $task->prepare($_POST);
    $lastTask = $task->lastEntry();
    if (isset($lastTask) && !empty($lastTask)){
        $lastTaskId = $lastTask['account_id'];
        $taskYear = substr($lastTaskId,2,4);
//    echo $taskYear;
//    die();
        $currentYear =  date('Y');
        if ($taskYear==$currentYear){

            $taskNumber = substr($lastTaskId,6);
            $newTaskNumber = (int)$taskNumber +1;
            $newTaskId = 'AC'.$taskYear.$newTaskNumber;
//echo $first;
//echo '<br>';
//echo $newTaskId;
//die();
        } else{
            $newTaskNumber = '1001';
            $newTaskId = 'AC'.date('Y').$newTaskNumber;
        }
    } else{
        $newTaskNumber = '1001';
        $newTaskId = 'AC'.date('Y').$newTaskNumber;
    }
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

        <div class="col-md-5">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Add Account Info</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <div class="col-sm-12" style="margin-top: 21px;">
                        <div class="col-md-6">
                            <label for="accountId" style="margin-top: 4px">Account Id</label>
                            <input type="text" id="accountId" name="accountId" value="<?php echo $newTaskId ?>"
                                   class="form-control custom-input" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="accountNo" style="margin-top: 4px">Account No</label>
                            <input type="text" id="accountNo" name="accountNo" class="form-control custom-input" required><br>
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="bankName" style="margin-top: 4px">Bank Name</label>
                            <input type="text" id="bankName" name="bankName" class="form-control custom-input" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="accountThresh" style="margin-top: 4px">Account Threshold</label>
                            <input type="text" id="accountThresh" name="accountThresh" class="form-control custom-input" required><br>
                        </div>
                    </div>

                    <br><br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px">
                                    <button type="submit" class="btn btn-info pull-right" style="width: 82px;margin-right: 15px;">Insert</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="col-md-3"></div>
    </div>


    <br><br><br><br>
    <script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../../asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <script src="jquery.checkAll.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>

    </body>
    </html>

<?php
} else{
    header('Location:../../../User/ManageUser/Login/login.php');
    }
?>