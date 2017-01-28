<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\ManageUser\User;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
header('Location:../../../../index.php');
} else {
$user = new User();
$allEmployees = $user->allEmployee();
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
    <div class="col-md-4"></div>
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

    <div class="col-md-5"></div>

    <div class="col-md-4">


        <div class="panel panel-primary custom-panel" style="391px">

            <div class="panel-heading">Login here</div>
            <br>
            <form role="form" action="loginProcess.php" method="post">
                <div class="col-sm-12">
                    <label for="employeeId" style="margin-top: 5px">Employee ID</label>
                    <select required name="userName" class="form-control col-sm-6 custom-input" id="employeeId">
                        <option></option>
                        <?php
                        if (isset($allEmployees) && !empty($allEmployees)) {
                            foreach ($allEmployees as $oneEmployee) {
                                ?>
                                <option><?php echo $oneEmployee['employee_id']?></option>

                            <?php }}  ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label for="password" style="margin-top: 10px">Password</label>
                    <input type="password" id="password" name="password" class="form-control custom-input"
                           placeholder="Password" required>

                </div>
                <div class="col-sm-12">
                    <label for="companyId" style="margin-top: 4px">Company Id</label>
                    <select name="companyId" class="form-control col-sm-6 custom-input" id="companyId" required>

                    </select>

                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 27%;margin-top: 11px;margin-right: 14px;">
                                <button type="submit" class="btn btn-info pull-right">Login</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <div class="col-md-4"></div>
</div>
</div>

<br><br><br><br>
<script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../../../asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="../../../../asset/js/jquery.min.js"></script>

<script type="text/javascript">
    $('#employeeId').on('change', function(){
        employeeId = $('#employeeId option:selected').val(); // the dropdown item selected value
//        console.log(employeeId);
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { employeeId : employeeId },
            url : 'getAjaxCompanyData.php',
            success : function(result){
//                console.log(result);
//                $('#sectionId).val(result('section_id'));
//                $("#sectionId").val(result)
                $('#companyId').html('');
                result.forEach(function(t) {
                    // $('#item') refers to the EMPTY select list
                    // the .append means add to the object refered to above

                    $('#companyId').append('<option>'+t+'</option>');
                });
            }
        })

    });

</script>
</body>
</html>

<?php
}
?>