<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$_POST['companyId'] = $_SESSION['companyId'];
$project = new TaskExecution();
$project->prepare($_POST);
$allprojects = $project->taskReport();
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

    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-9" style="background-color: #9acfea;padding: 1px;margin-left: 280px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Task ID</th>
                    <th align="center">Section ID</th>
                    <th align="center">Assigned To</th>
                    <th align="center">Primary Estimated Date</th>
                    <th align="center">Latest Estimated Date</th>
                    <th align="center">Estimated Days</th>
                    <th align="center">Latest Estimated Days</th>
                </tr>
                </thead>
                <?php
                if (isset($allprojects) && !empty($allprojects)) {
                $serial = 0;
                foreach ($allprojects as $oneproject) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneproject['project_id'] ?></td>
                    <td><?php echo $oneproject['section_id']; ?></td>
                    <td><?php echo $oneproject['assigned_to']; ?></td>
                    <td><?php echo $oneproject['primary_est_date']; ?></td>
                    <td><?php echo $oneproject['est_date']; ?></td>
                    <td><?php echo $oneproject['est_days']; ?></td>
                    <td><?php echo $oneproject['latest_est_days']; ?></td>

                    <td>
                        <a href="detailedReport.php?projectId=<?php echo $oneproject['project_id'] ?>&sectionId=<?php echo $oneproject['section_id'] ?>"> <img style="margin: 3%" border="0"
                                                                                    title="See Detailed Report" alt="Details"
                                                                                    src="../../../../asset/images/showDetails.png"
                                                                                    width="25" height="20"></a>
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