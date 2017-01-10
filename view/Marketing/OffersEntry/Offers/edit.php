<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Offer\Offer;

$_POST['companyId'] = $_SESSION['companyId'];

$id = $_GET['id'];

$offer = new Offer();
$offer->prepare($_POST);
$oneOffer = $offer->show($id);
$allCustomers = $offer->Customers();
$allEmployees = $offer->Employee();
$allProjects = $offer->Projects();
$totalAmount = $offer->totalAmount();
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

    <div class="col-md-6">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Edit Offer Info</div>
            <br>
            <form role="form" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div>
                    <div class="col-md-6">
                        <label for="offerId" style="margin-top: 5px">Offer Code</label>
                        <input type="text" id="offerId" name="offerId" class="form-control custom-input"
                               value="<?php echo $oneOffer['offer_id'] ?>"  placeholder="Offer Code" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="amount" style="margin-top: 5px">Amount</label>
                        <input type="text" id="amount" name="amount" class="form-control custom-input"
                               value="<?php echo $oneOffer['offer_amount'] ?>"  placeholder="Amount" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="customerName" style="margin-top: 5px">Customer Name</label>
                        <select name="customerName" class="form-control col-sm-6 custom-input" id="customerName">
                            <option></option>
                            <?php
                            if (isset($allCustomers) && !empty($allCustomers)) {
                                foreach ($allCustomers as $oneCustomer) {
                                    ?>
                                    <option <?php if ($oneOffer['customer_name']==$oneCustomer['customer_name']) echo 'selected'?>><?php echo $oneCustomer['customer_name']?></option>
                                <?php }}  ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" style="margin-top: 5px">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control custom-input"
                               value="<?php echo $oneOffer['phone_number'] ?>"  placeholder="Phone" required>
                    </div>

                    <br><br><br>
                    <div class="col-md-6">
                        <label for="contactPerson" style="margin-top: 5px">Contact Person</label>
                        <input type="text" id="contactPerson" name="contactPerson" class="form-control custom-input"
                               value="<?php echo $oneOffer['contact_person'] ?>" placeholder="Contact Person" required>
                    </div>
                    <div class="col-md-6">
                        <label for="mobilePhone" style="margin-top: 5px">Mobile Phone</label>
                        <input type="text" id="mobilePhone" name="mobilePhone" class="form-control custom-input"
                               value="<?php echo $oneOffer['mobile_number'] ?>"  placeholder="Mobile Phone" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="promotedBy" style="margin-top: 5px">Promoted By</label>
                        <select name="promotedBy" class="form-control col-sm-6 custom-input" id="promotedBy">
                            <option></option>
                            <?php
                            if (isset($allEmployees) && !empty($allEmployees)) {
                                foreach ($allEmployees as $oneEmployee) {
                                    ?>
                                    <option <?php if ($oneOffer['promoted_by']==$oneEmployee['employee_id']) echo 'selected'?>><?php echo $oneEmployee['employee_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="offerDate" style="margin-top: 5px">Offer Date</label>
                        <input type="text" id="offerDate" name="offerDate" class="form-control custom-input"
                               value="<?php echo $oneOffer['offer_date']?>"  placeholder="Offer Date">
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="description" style="margin-top: 5px">Description</label>
                        <input type="text" id="description" name="description" class="form-control custom-input"
                               value="<?php echo $oneOffer['description']?>" placeholder="Description">
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

    <br><br><br><br><br><br><br><br>
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
        $("#offerDate").datepicker({
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
        $("#nextSched").datepicker({
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