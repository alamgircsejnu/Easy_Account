
<?php
session_start();
use App\Users\Role\Role;
use App\Employee\ManageEmployee\Employee;
//echo $_SESSION['id'];
//die();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    include_once '../../../../vendor/autoload.php';



    $role = new Role();
    $allRoles = $role->index();

    $employee = new Employee();
    $allEmployees = $employee->index();

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

    <div class="col-md-4">


        <div class="panel panel-primary custom-panel" style="391px">

            <div class="panel-heading">Reset Your Password</div>
            <br>
            <form role="form" action="ResetPassword.php" method="post">
                <div class="col-sm-12">
                    <label for="employeeId" style="margin-top: 4px">Employee ID</label>
                    <?php if($_SESSION['admin'] == 1){?>
                    <select required name="employeeId" class="form-control col-sm-6 custom-input" id="userType">
                        <?php
                        if (isset($allEmployees) && !empty($allEmployees)) {
                            foreach ($allEmployees as $oneEmployee) {
                                ?>
                                <option><?php echo $oneEmployee['employee_id']?></option>

                            <?php }}  ?>
                    </select>
        <?php } else { ?>
                        <input type="text" id="employeeId" name="employeeId" class="form-control custom-input" value="<?php echo $_SESSION['username'];?>" readonly>
                    <?php }?>
                </div>
                <div class="col-sm-12">
                    <label for="currentPassword" style="margin-top: 10px">Current Password</label>
                    <input type="password" id="currentPassword" name="currentPassword" class="form-control custom-input"
                           placeholder="Current Password" required>

                </div>
                <div class="col-sm-12">
                    <label for="newPassword" style="margin-top: 10px">New Password</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control custom-input"
                           placeholder="New Password" required>

                </div>
                <div class="col-sm-12">
                    <label for="retypeNewPassword" style="margin-top: 10px">Retype New Password</label>
                    <input type="password" id="retypeNewPassword" name="retypeNewPassword" class="form-control custom-input"
                           placeholder="Retype New Password" required>

                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 27%;margin-top: 11px;margin-right: 14px;">
                                <button type="submit" class="btn btn-info pull-right">Reset Password</button>
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