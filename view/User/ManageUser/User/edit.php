<?php
include_once '../../../../vendor/autoload.php';

use App\Users\ManageUser\User;
use App\Users\Role\Role;
$role = new Role();
$allRoles = $role->index();

//session_start();
$id = $_GET['id'];

$user = new User();
$oneUser = $user->show($id);
//$roles = explode(',',$oneUser['permitted_actions']);
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

    <div class="col-md-5">

        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Edit User</div>
            <br>
            <form role="form" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">

                <div class="col-sm-6">
                    <label for="firstName" style="margin-top: 4px">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-control custom-input"
                           value="<?php echo $oneUser['first_name']; ?>" placeholder="First" required>

                    <label for="lastname" style="margin-top: 4px">Last Name</label>
                    <input type="text" id="lastname" name="lastName" class="form-control custom-input"
                           value="<?php echo $oneUser['last_name']; ?>" placeholder="Last" required>


                    <label for="userName" style="margin-top: 4px">User Name</label>
                    <input type="text" id="userName" name="userName" class="form-control custom-input"
                           value="<?php echo $oneUser['user_name']; ?>" placeholder="User Name" required>

                    <label for="userType" style="margin-top: 4px">User Type</label>
                    <select required name="userType" class="form-control col-sm-6 custom-input" id="userType">
                        <option <?php if ($oneUser['user_type'] == "Admin") {
                            echo 'selected';
                        } ?>>Admin
                        </option>
                        <option <?php if ($oneUser['user_type'] == "Operator") {
                            echo 'selected';
                        } ?>>Operator
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="permittedActions" class="col-md-6" style="margin-top: 4px">Roles</label><br><br>
                    <div class="form-group pre-scrollable scrollable-checkbox col-md-12" style="float: right;width: 47%">

                        <div class="col-md-12" style="height: 155px">
                            <?php
                            if (isset($allRoles) && !empty($allRoles)) {

                            foreach ($allRoles as $oneRole) {

//
                            ?>
                            <input type="checkbox" class="checkBoxClass" name="permittedActions[]"
                                   value="<?php echo $oneRole['user_role']; ?>" id="<?php echo $oneRole['user_role']; ?>"
                                <?php if (strstr($oneUser['permitted_actions'],$oneRole['user_role'])) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>/>


                            <label for="<?php echo $oneRole['user_role'] ?>">&nbsp <?php echo $oneRole['user_role'] ?></label><br>

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
                        <div >
                            <div class="col-md-4" style="margin-left: 31px;margin-top: 17px">
                                <input class="check-all" type="checkbox" name="" id="ckbCheckAll"><label
                                    for="ckbCheckAll">&nbsp Select All</label>
                            </div>

                            <div class="col-md-4 pull-right" style="float: left;width: 4%;margin-top: 11px">
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
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