<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Promotion\Promotion;

$_POST['companyId'] = $_SESSION['companyId'];

$id = $_GET['id'];

$promotion = new Promotion();
$promotion->prepare($_POST);
$onePromotion = $promotion->show($id);
$contactPersons = $promotion->contactPersons();
$allEmployees = $promotion->Employee();
$allProjects = $promotion->Projects();
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

            <div class="panel-heading">Edit Promotion Info</div>
            <br>
            <form role="form" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div>
                    <div class="col-md-6">
                        <label for="promotionId" style="margin-top: 5px">Event Code</label>
                        <input type="text" id="promotionId" name="promotionId" class="form-control custom-input"
                               value="<?php echo $onePromotion['promotion_id'] ?>"  placeholder="Event Code" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="customerName" style="margin-top: 5px">Customer Name</label>
                        <input type="customerName" id="customerName" name="customerName" class="form-control custom-input"
                               value="<?php echo $onePromotion['customer_name'] ?>"  placeholder="Customer Name" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="media" style="margin-top: 5px">Media</label>
                        <select name="media" class="form-control col-sm-6 custom-input" id="media">
                            <option></option>
                            <option <?php if ($onePromotion['media']=='Meeting') echo 'selected'?>>Meeting</option>
                            <option <?php if ($onePromotion['media']=='Phone Call') echo 'selected'?>>Phone Call</option>
                            <option <?php if ($onePromotion['media']=='Email') echo 'selected'?>>Email</option>
                            <option <?php if ($onePromotion['media']=='SMS') echo 'selected'?>>SMS</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="contactPerson" style="margin-top: 5px">Contact Person</label>
                        <select name="contactPerson" class="form-control col-sm-6 custom-input" id="contactPerson">
                            <option></option>
                            <?php
                            if (isset($contactPersons) && !empty($contactPersons)) {
                                foreach ($contactPersons as $onePerson) {
                                    ?>
                                    <option <?php if ($onePromotion['contact_person']==$onePerson['customer_contact']) echo 'selected'?>><?php echo $onePerson['customer_contact']?></option>
                                    <option <?php if ($onePromotion['contact_person']==$onePerson['factory_contact']) echo 'selected'?>><?php echo $onePerson['factory_contact']?></option>

                                <?php }}  ?>
                        </select>
                    </div>

                    <br><br><br>
                    <div class="col-md-6">
                        <label for="eventDate" style="margin-top: 5px">Event Date</label>
                        <input type="text" id="eventDate" name="eventDate" class="form-control custom-input"
                               value="<?php echo $onePromotion['promotion_date'] ?>" placeholder="Event Date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="mobilePhone" style="margin-top: 5px">Mobile Phone</label>
                        <select name="mobilePhone" class="form-control col-sm-6 custom-input" id="mobilePhone">
                            <option></option>
                            <?php
                            if (isset($contactPersons) && !empty($contactPersons)) {
                                foreach ($contactPersons as $onePerson) {
                                    ?>
                                    <option <?php if ($onePromotion['mobile_number']==$onePerson['customer_mobile']) echo 'selected'?>><?php echo $onePerson['customer_mobile']?></option>
                                    <option <?php if ($onePromotion['mobile_number']==$onePerson['customer_mobile2']) echo 'selected'?>><?php echo $onePerson['customer_mobile2']?></option>
                                    <option <?php if ($onePromotion['mobile_number']==$onePerson['customer_phone']) echo 'selected'?>><?php echo $onePerson['customer_phone']?></option>
                                    <option <?php if ($onePromotion['mobile_number']==$onePerson['factory_phone']) echo 'selected'?>><?php echo $onePerson['factory_phone']?></option>

                                <?php }}  ?>
                        </select>
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
                                    <option <?php if ($onePromotion['promoted_by']==$oneEmployee['employee_id']) echo 'selected'?>><?php echo $oneEmployee['employee_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="product" style="margin-top: 5px">Product</label>
                        <select name="product" class="form-control col-sm-6 custom-input" id="product">
                            <option></option>
                            <?php
                            if (isset($allProjects) && !empty($allProjects)) {
                                foreach ($allProjects as $oneProject) {
                                    ?>
                                    <option <?php if ($onePromotion['product']==$oneProject['project_id']) echo 'selected'?>><?php echo $oneProject['project_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="nextSched" style="margin-top: 5px">Next Schedule</label>
                        <input type="text" id="nextSched" name="nextSched" class="form-control custom-input"
                               value="<?php echo $onePromotion['next_sched'] ?>"  placeholder="Next Schedule">
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                        <label for="description" style="margin-top: 5px">Description</label>
                        <input type="text" id="description" name="description" class="form-control custom-input"
                               value="<?php echo $onePromotion['description'] ?>"  placeholder="Description">
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
        $("#eventDate").datepicker({
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