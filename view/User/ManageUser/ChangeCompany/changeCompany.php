<?php
session_start();
include_once '../../../../vendor/autoload.php';

use App\Users\ManageUser\User;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {

$id = $_SESSION['id'];

$user = new User();
$oneUser = $user->show($id);
$companies = explode(',', $oneUser['permitted_companies']);
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

    <div class="col-md-4">


        <div class="panel panel-primary custom-panel" style="391px">

            <div class="panel-heading">Select Company</div>
            <br>
            <form role="form" action="process.php" method="post">

                <div class="col-sm-12">
                    <label for="companyId" style="margin-top: 4px">Company Id</label>
                    <select required name="companyId" class="form-control col-sm-6 custom-input" id="companyId">
                        <?php
                        for ($i=0;$i<count($companies);$i++){
                        ?>
                            <option <?php
                            if (isset($_SESSION['companyId']) && !empty($_SESSION['companyId'])){
                            if($companies[$i] == $_SESSION['companyId']){ echo 'selected';}}?>><?php echo $companies[$i]?></option>
                       <?php
                        }
                        ?>
                    </select>

                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 27%;margin-top: 11px;margin-right: 14px;">
                                <button type="submit" class="btn btn-info pull-right">Set Company</button>
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

<?php
} else{
    header('Location:../Login/login.php');

}
?>