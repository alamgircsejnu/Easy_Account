<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Customer\Customer;

$_POST['companyId'] = $_SESSION['companyId'];

$id = $_GET['id'];

$customer = new Customer();
$customer->prepare($_POST);
$oneCustomer = $customer->show($id);
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

    <div class="col-md-6">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Edit Customer Info</div>
            <br>
            <form role="form" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div>
                    <div class="col-md-6">
                        <label for="customerId" style="margin-top: 5px">Customer ID</label>
                        <input type="text" id="customerId" name="customerId" class="form-control custom-input"
                               value="<?php echo $oneCustomer['customer_id'] ?>"  placeholder="Customer ID" required>
                    </div>
                    <div class="col-md-6">
                        <label for="customerName" style="margin-top: 5px">Customer Name</label>
                        <input type="customerName" id="customerName" name="customerName" class="form-control custom-input"
                               value="<?php echo $oneCustomer['customer_name'] ?>"  placeholder="Customer Name" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="customerAddress" style="margin-top: 5px">Customer Address</label>
                        <input type="text" id="customerAddress" name="customerAddress" class="form-control custom-input"
                               value="<?php echo $oneCustomer['customer_address'] ?>"  placeholder="Customer Address" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="factoryAddress" style="margin-top: 5px">Factory Address</label>
                        <input type="text" id="factoryAddress" name="factoryAddress" class="form-control custom-input"
                               value="<?php echo $oneCustomer['customer_factory'] ?>"  placeholder="Factory Address" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="customerContact" style="margin-top: 5px">Customer Contact</label>
                        <input type="text" id="customerContact" name="customerContact" class="form-control custom-input"
                               value="<?php echo $oneCustomer['customer_contact'] ?>" placeholder="Customer Contact" required>
                    </div>
                    <div class="col-md-6">
                        <label for="factoryContact" style="margin-top: 5px">Factory Contact</label>
                        <input type="text" id="factoryContact" name="factoryContact" class="form-control custom-input"
                               value="<?php echo $oneCustomer['factory_contact'] ?>"  placeholder="Factory Contact" required>
                    </div>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <label for="designation" style="margin-top: 5px">Designation</label>
                    <input type="text" id="designation" name="designation" class="form-control custom-input"
                           value="<?php echo $oneCustomer['contact_desig'] ?>" placeholder="Designation" required>
                </div>
                <div class="col-md-6">
                    <label for="factoryDesignation" style="margin-top: 5px">Designation</label>
                    <input type="text" id="factoryDesignation" name="factoryDesignation" class="form-control custom-input"
                           value="<?php echo $oneCustomer['fac_cont_desig'] ?>"  placeholder="Designation" required>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <label for="customerEmail" style="margin-top: 5px">Customer Email</label>
                    <input type="text" id="customerEmail" name="customerEmail" class="form-control custom-input"
                           value="<?php echo $oneCustomer['customer_email'] ?>"  placeholder="Customer Email" required>
                </div>
                <div class="col-md-6">
                    <label for="factoryEmail" style="margin-top: 5px">Factory Email</label>
                    <input type="text" id="factoryEmail" name="factoryEmail" class="form-control custom-input"
                           value="<?php echo $oneCustomer['customer_email2'] ?>"  placeholder="Factory Email" required>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <label for="customerMobile" style="margin-top: 5px">Customer Mobile</label>
                    <input type="text" id="customerMobile" name="customerMobile" class="form-control custom-input"
                           value="<?php echo $oneCustomer['customer_mobile'] ?>"  placeholder="Customer Mobile" required>
                </div>
                <div class="col-md-6">
                    <label for="factoryMobile" style="margin-top: 5px">Factory Mobile</label>
                    <input type="text" id="factoryMobile" name="factoryMobile" class="form-control custom-input"
                           value="<?php echo $oneCustomer['customer_mobile2'] ?>" placeholder="Factory Mobile" required>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <label for="customerPhone" style="margin-top: 5px">Customer Phone</label>
                    <input type="text" id="customerPhone" name="customerPhone" class="form-control custom-input"
                           value="<?php echo $oneCustomer['customer_phone'] ?>"  placeholder="Customer Phone" required>
                </div>
                <div class="col-md-6">
                    <label for="factoryPhone" style="margin-top: 5px">Factory Phone</label>
                    <input type="text" id="factoryPhone" name="factoryPhone" class="form-control custom-input"
                           value="<?php echo $oneCustomer['factory_phone'] ?>" placeholder="Factory Phone" required>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <label for="startingYear" style="margin-top: 5px">Starting Year</label>
                    <input type="text" id="startingYear" name="startingYear" class="form-control custom-input"
                           value="<?php echo $oneCustomer['starting_year'] ?>" placeholder="Starting Year" required>
                </div>

                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Update</button>
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
        $("#dateOfBirth").datepicker({
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
</body>
</html>