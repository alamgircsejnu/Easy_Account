<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ChequeBook\ChequeBookEntry\ChequeBookEntry;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $_POST['companyId'] = $_SESSION['companyId'];
    $chequeBook = new ChequeBookEntry();
    $chequeBook->prepare($_POST);
    $allBanks = $chequeBook->bankNames();
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

        <div class="col-md-4"></div>

        <div class="col-md-5">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Add Account Info</div>
                <br>
                <form role="form" action="store.php" method="post">

                    <div class="col-sm-12" style="margin-top: 21px;">
                        <div class="col-md-6">
                            <label for="bankName" style="margin-top: 4px">Bank Name</label>
                            <select required name="bankName" class="form-control col-sm-6 custom-input" id="bankName">
                                <option></option>
                                <?php
                                if (isset($allBanks) && !empty($allBanks)) {
                                    foreach ($allBanks as $oneBank) {
                                        ?>
                                        <option><?php echo $oneBank['account_bank']?></option>

                                    <?php }}  ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="accountNo" style="margin-top: 4px">Account Number</label>
                            <select name="accountNo" class="form-control col-sm-6 custom-input" id="accountNo">

                            </select>
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="from" style="margin-top: 4px">From</label>
                            <input type="text" id="from" name="from" class="form-control custom-input" required><br>
                        </div>
                        <div class="col-md-6">
                            <label for="to" style="margin-top: 4px">To</label>
                            <input type="text" id="to" name="to" class="form-control custom-input" required><br>
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

                    $('#accountNo').html('');
                    result.forEach(function(t) {
                        // $('#item') refers to the EMPTY select list
                        // the .append means add to the object refered to above

                        $('#accountNo').append('<option>'+t['account_number']+'</option>');
                    });
                }
            })

        });

    </script>
    </body>
    </html>

    <?php
} else{
    header('Location:../Login/login.php');

}
?>