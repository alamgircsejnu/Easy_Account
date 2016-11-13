<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;

$projectId = $_GET['projectId'];
//echo $projectId;

$project = new ProjectTracking();
$allSections = $project->sections($projectId);

//print_r($allSections);
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
    <div style="width: 500px;margin-left: 20%">
        <?php

        if (isset($_SESSION['successMessage'])) {
            echo '<h3 style="color: green;background-color: ghostwhite">' . $_SESSION['successMessage'] . '</h3><br>';
            unset($_SESSION['successMessage']);
        } else if (isset($_SESSION['errorMessage'])) {
            echo '<h3 style="color: red;background-color: ghostwhite">' . $_SESSION['errorMessage'] . '</h3><br>';
            unset($_SESSION['errorMessage']);
        }

        ?>
    </div>
    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">Section</th>
                    <th align="center">Task ID</th>
                    <th align="center">Section ID</th>
                    <th align="center">Section Description</th>
                    <th align="center">Assigned To</th>
                    <th align="center">Primary Estimated Date</th>
                    <th align="center">Latest Estimated Date</th>
                    <th align="center">Estimated Days</th>
                    <th align="center">Latest Estimated Days</th>
                </tr>
                </thead>
                <?php
                if (isset($allSections) && !empty($allSections)) {
                $serial = 0;
                foreach ($allSections as $oneSections) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td width="80px"><?php echo 'Section-'. $serial ?></td>
                    <td><?php echo $oneSections['project_id']; ?></td>
                    <td><?php echo $oneSections['section_id']; ?></td>
                    <td><?php echo $oneSections['section_description']; ?></td>
                    <td><?php echo $oneSections['assigned_to']; ?></td>
                    <td><?php echo $oneSections['primary_est_date']; ?></td>
                    <td><?php echo $oneSections['est_date']; ?></td>
                    <td><?php echo $oneSections['est_days']; ?></td>
                    <td><?php echo $oneSections['latest_est_days']; ?></td>
                    <td style="width: 120px">
                        <a href="../AddSection/show.php?id=<?php echo $oneSections['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                     title="See Details" alt="Details"
                                                                                     src="../../../../asset/images/showDetails.png"
                                                                                     width="25" height="20"></a>
                        <a href="../AddSection/edit.php?id=<?php echo $oneSections['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                     title="Edit User Info" alt="Edit"
                                                                                     src="../../../../asset/images/edit.png"
                                                                                     width="25" height="20"></a>
                        <a href="trash.php?id=<?php echo $oneSections['id'] ?>" onclick="return confirm('Are you sure?')">
                            <img style="margin: 3%" border="0" title="Delete This User" alt="Delete"
                                 src="../../../../asset/images/delete.png" width="25" height="20"></a>
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
