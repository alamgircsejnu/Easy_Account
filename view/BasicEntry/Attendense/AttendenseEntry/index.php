<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
$_POST['companyId'] = $_SESSION['companyId'];
$_POST['employeeId'] = $_SESSION['username'];

$attendense = new AttendenseEntry();
$attendense->prepare($_POST);
$allId = $attendense->attendanceId();

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

        th, td {
            text-align: center;
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
    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px;margin-left: 210px;max-height: 450px;overflow: scroll">

        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                        <th align="center">SL#</th>
                        <th align="center">Employee Id</th>
                        <th align="center">Employee Name</th>
                        <th align="center">Entry Time</th>
                        <th align="center">Exit Time</th>
                        <th align="center">remarks</th>
                        <th align="center">Status</th>
                        <th align="center">Actions</th>
                    </tr>
                    </thead>
                    <?php
                    if (isset($allId) && !empty($allId)) {
                    $serial = 0;
                    foreach ($allId as $oneId) {
                    $_POST['attId'] = $oneId['att_id'];
                    $attendense = new AttendenseEntry();
                    $attendense->prepare($_POST);
                    $attendense = $attendense->index();
                    $serial++
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $serial ?></td>
                        <td><?php echo $attendense[0]['employee_id'] ?></td>
                        <td><?php echo $attendense[0]['employee_name']; ?></td>
                        <td><?php if (isset($attendense[0]['ctime']) && !empty($attendense[0]['ctime']) && $attendense[0]['purpose']=='Entry'){
                            echo $attendense[0]['ctime'];
                            } ?></td>
                            <td><?php if (isset($attendense[1]['ctime']) && !empty($attendense[1]['ctime']) && $attendense[1]['purpose']=='Exit'){
                                echo $attendense[1]['ctime'];
                                }elseif (isset($attendense[0]['ctime']) && !empty($attendense[0]['ctime']) && $attendense[0]['purpose']=='Exit'){
                                    echo $attendense[0]['ctime'];
                                }?></td>

                        <td><?php echo $attendense[0]['remarks']; ?></td>
                        <td style="width: 130px">
                            <?php
                            if ($attendense[0]['is_approved'] == 0) {
                                ?>
                                Pending
                                <?php
                            } else {

                                ?>
                                Approved
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit.php?attId=<?php echo $attendense[0]['att_id'] ?>"> <img style="margin: 3%" border="0"
                                                                                         title="Edit" alt="Edit"
                                                                                         src="../../../../asset/images/edit.png"
                                                                                         width="25" height="20"></a>
                            <a href="delete.php?attId=<?php echo $attendense[0]['att_id'] ?>" onclick="return confirm('Are you sure?')">
                                <img style="margin: 3%" border="0" title="Delete This User" alt="Delete"
                                     src="../../../../asset/images/delete.png" width="25" height="20"></a>
                        </td>
                    </tr>
                    <?php
                    }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9" align="center">
                                <?php echo "No Data Available " ?>

                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
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
    header('Location:../../../User/ManageUser/Login/login.php');
}
?>