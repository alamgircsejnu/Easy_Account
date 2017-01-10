<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Users\Role\Role;
use App\Users\Company\Company;
use App\Employee\ManageEmployee\Employee;
//echo $_SESSION['id'];
//die();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {



$_POST['companyId'] = $_SESSION['companyId'];

$role = new Role();
 $role->prepare($_POST);
$allRoles = $role->index();

$company = new Company();
 $company->prepare($_POST);
$allCompanies = $company->index();

$employee = new Employee();
$employee->prepare($_POST);
$allEmployees = $employee->employee();

//print_r($allUsers);

//die();
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

    <div class="col-md-6">

        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Create New User</div>
            <br>
            <form role="form" action="store.php" method="post">

                    <div class="col-sm-6">

                    <label for="userName" style="margin-top: 4px">Employee ID</label>
                        <select required name="userName" class="form-control col-sm-6 custom-input" id="userType">
                            <option></option>
                            <?php
                            if (isset($allEmployees) && !empty($allEmployees)) {
                            foreach ($allEmployees as $oneEmployee) {
                            ?>
                            <option><?php echo $oneEmployee['employee_id']?></option>

                            <?php }}  ?>
                        </select>
                        <br><br><br>

                    <label for="userType" style="margin-top: 4px">User Type</label>
                        <select required name="userType" class="form-control col-sm-6 custom-input" id="userType">
                            <option>Admin</option>
                            <option selected>Operator</option>
                        </select><br><br><br>


                        <label for="password" style="margin-top: 4px">Type Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control custom-input" required><br>

                    <label for="retypePassword" style="margin-top: 4px">Retype Password</label>
                        <input type="password" id="retypePassword" name="retypePassword"
                               class="form-control custom-input" required><br>

                </div>
                <div class="form-group">

                    <div class="form-group pre-scrollable scrollable-checkbox col-md-5" style="float: right;width: 47%">
                        <label for="permittedActions" class="col-md-6" style="margin-top: 4px">Roles</label><br><br>

                        <div class="col-md-12" style="height: 201px">

                            <?php
                            if (isset($allRoles) && !empty($allRoles)) {

                            foreach ($allRoles as $oneRole) {

                            ?>

                                <input type="checkbox" class="checkBoxClass" name="permittedActions[]"
                                       value="<?php echo $oneRole['user_role']?>" id="<?php echo $oneRole['user_role']?>">
                                <label for="<?php echo $oneRole['user_role']?>">&nbsp <?php echo $oneRole['user_role']?></label><br>



                                <?php
                            }
                            }
                            ?>


                        </div>
                    </div>

                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="margin-left: 31px;margin-top: 17px">
                                <input class="check-all" type="checkbox" name="" id="ckbCheckAll">
                                <label for="ckbCheckAll">&nbsp Select All</label>
                            </div>

                        </div>
                    </div>
                </div>

<!--                ...........................................-->
                <div class="form-group">

                    <div class="form-group pre-scrollable scrollable-checkbox col-md-6" style="float: left;width: 100%">
                        <label for="permittedCompanies" class="col-md-6" style="margin-top: 4px">Companies</label><br><br>

                        <div class="col-md-12" style="height: 101px;">

                            <?php
                            if (isset($allCompanies) && !empty($allCompanies)) {

                                foreach ($allCompanies as $oneCompany) {

                                    ?>

                                    <input type="checkbox" class="checkBoxCompanyClass" name="permittedCompanies[]"
                                           value="<?php echo $oneCompany['company_id']?>" id="<?php echo $oneCompany['company_name']?>">
                                    <label for="<?php echo $oneCompany['company_name']?>">&nbsp <?php echo $oneCompany['company_name']?></label><br>



                                    <?php
                                }
                            }
                            ?>


                        </div>
                    </div>

                </div>
                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="margin-left: 31px;margin-top: 17px">
                                <input class="check-all-company" type="checkbox" name="" id="ckbCheckAllCompany">
                                <label for="ckbCheckAllCompany">&nbsp Select All</label>
                            </div>

                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 22px;margin-right: 50px">
                                <button type="submit" class="btn btn-info pull-right">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

    <div class="col-md-3"></div>
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
<script>
    $(document).ready(function () {
        $("#ckbCheckAllCompany").click(function () {
            if (this.checked)
                $(".checkBoxCompanyClass").prop('checked', "checked");
            else
                $(".checkBoxCompanyClass").removeProp('checked');
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