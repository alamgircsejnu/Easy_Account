<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Negotiator\NegotiatorEntry\Negotiator;

$_POST['companyId'] = $_SESSION['companyId'];

$id = $_GET['id'];

$negotiator = new Negotiator();
$negotiator->prepare($_POST);
$oneNegotiator = $negotiator->show($id);
$companies = $negotiator->company();
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

            <div class="panel-heading">Edit Negotiator Info</div>
            <br>
            <form role="form" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div>
                    <div class="col-md-6">
                        <label for="negoId" style="margin-top: 5px">Negotiator ID</label>
                        <input type="text" id="negoId" name="negoId" class="form-control custom-input"
                               value="<?php echo $oneNegotiator['nego_id'] ?>"  placeholder="Negotiator ID" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="negoName" style="margin-top: 5px">Negotiator Name</label>
                        <input type="negoName" id="negoName" name="negoName" value="<?php echo $oneNegotiator['nego_name'] ?>" class="form-control custom-input" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="negoDesignation" style="margin-top: 5px">Negotiator Designation</label>
                        <input type="text" id="negoDesignation" name="negoDesignation" value="<?php echo $oneNegotiator['nego_designation'] ?>" class="form-control custom-input">
                    </div>

                    <div class="col-md-6">
                        <label for="negoPhone" style="margin-top: 5px">Negotiator Phone</label>
                        <input type="text" id="negoPhone" name="negoPhone" value="<?php echo $oneNegotiator['nego_phone'] ?>" class="form-control custom-input" >
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="negoEmail" style="margin-top: 5px">Negotiator Email</label>
                        <input type="email" id="negoEmail" name="negoEmail" value="<?php echo $oneNegotiator['nego_email'] ?>" class="form-control custom-input">
                    </div>
                    <div class="col-md-6">
                        <label for="negoCompany" style="margin-top: 5px">Negotiator Company</label>
                        <select name="negoCompany" class="form-control col-sm-6 custom-input" id="negoCompany">
                            <option></option>
                            <?php
                            if (isset($companies) && !empty($companies)) {
                                foreach ($companies as $company) {
                                    ?>
                                    <option <?php if ($oneNegotiator['nego_company'] == $company['customer_name']) echo 'selected'?>><?php echo $company['customer_name']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
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