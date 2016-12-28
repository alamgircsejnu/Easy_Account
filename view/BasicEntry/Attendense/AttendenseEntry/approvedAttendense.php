<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Attendense\AttendenseEntry\AttendenseEntry;

$_POST['companyId'] = $_SESSION['companyId'];

$attendense = new AttendenseEntry();
$attendense->prepare($_POST);
$allAttendense = $attendense->approvedRequests();
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
    <!--    <div class="col-md-1">-->
</div>
<div class="col-md-11" style="margin-left: 4%">
    <div id="custom-table" style="background-color: #9acfea;padding: 1px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Employee Id</th>
                    <th align="center">Employee Name</th>
                    <th align="center">Date</th>
                    <th align="center">Duty Location</th>
                    <th align="center">In Time</th>
                    <th align="center">Out Time</th>
                    <th align="center">Remarks</th>
                    <th align="center">Applied Date</th>
                    <th align="center">Approve</th>
                </tr>
                </thead>
                <?php
                if (isset($allAttendense) && !empty($allAttendense)) {
                $serial = 0;
                foreach ($allAttendense as $oneAttendense) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneAttendense['employee_id'] ?></td>
                    <td><?php echo $oneAttendense['employee_name']; ?></td>
                    <td><?php echo $oneAttendense['date']; ?></td>
                    <td><?php echo $oneAttendense['duty_location']; ?></td>
                    <td><?php echo $oneAttendense['in_time']; ?></td>
                    <td><?php echo $oneAttendense['out_time']; ?></td>
                    <td><?php echo $oneAttendense['remarks']; ?></td>
                    <td><?php echo $oneAttendense['created_at']; ?></td>
                    <td style="width: 130px">
                        <?php
                        if ($oneAttendense['is_approved'] == 0) {
                            ?>
                            <a href="approve.php?id=<?php echo $oneAttendense['id'] ?>" class="btn btn-primary"
                               onclick="return confirm('Are you sure?')">Approve</a>
                            <?php
                        } else {

                            ?>
                            Already Approved
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" align="center">
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
<!--    <div class="col-md-1"></div>-->
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