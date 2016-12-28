<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;

//$sectionId = $_GET['sectionId'];
$_POST['id']=$_GET['id'];
$_POST['companyId'] = $_SESSION['companyId'];
$project = new TaskExecution();
$project->prepare($_POST);
$allprojects = $project->projectReport();
$completionDate = $project->projectCompletionDate();
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
    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Task ID</th>
                    <th align="center">Section ID</th>
                    <th align="center"> Date</th>
                    <th align="center">Hour Worked</th>
                    <th align="center">Done By</th>
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
                    <td><?php echo $oneproject['created_at']; ?></td>
                    <td><?php echo $oneproject['work_hour']; ?></td>
                    <td><?php echo $oneproject['done_by']; ?></td>
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

</body>
</html>