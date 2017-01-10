<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;
use App\ProjectTracking\TaskExecution\TaskExecution;
use App\Users\ManageUser\User;

$_POST['companyId'] = $_SESSION['companyId'];

$id = $_SESSION['id'];

$user = new User();
$user->prepare($_POST);
$oneUser = $user->show($id);

$section = new AddSection();
$section->prepare($_POST);
$execute = new TaskExecution();
$execute->prepare($_POST);
$allSections = $section->finishedSections();
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
        td{
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
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px;margin-left: 210px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr  style="background-color: #5171a5">
                    <th align="center">Name</th>
                    <th align="center">Project ID</th>
                    <th align="center">Section ID</th>
                    <th align="center">Start Date</th>
                    <th align="center">End Date</th>
                    <th align="center">Commitment(Days)</th>
                    <th align="center">Executed In(Days)</th>
                    <th align="center">Efficiency</th>

                </tr>
                </thead>
                <?php
                if (isset($allSections) && !empty($allSections)) {
                $serial = 0;
                foreach ($allSections as $oneSections) {
                $serial++;
                $startDate = $execute->startDate($oneSections['section_id']);
                $daysWorked = $execute->daysWorked($oneSections['section_id']);
                $count = count($daysWorked);
                $efficiencyVal = ($oneSections['est_days'] * 100) / $count;
                $efficiency = number_format((float)$efficiencyVal, 2, '.', '');

                ?>
                <tbody>
                <?php
                 if ($_SESSION['employeeName']== $oneSections['assigned_to'] || strstr($oneUser['permitted_actions'],'Job Assign') || $oneUser['is_admin']==1){
                ?>
                <tr>
                    <td width="150px"><?php echo $oneSections['assigned_to'] ?></td>
                    <td><?php echo $oneSections['project_id'] ?></td>
                    <td><?php echo $oneSections['section_id']; ?></td>
                    <td><?php echo $startDate['created_at']; ?></td>
                    <td><?php echo $oneSections['finished_at']; ?></td>
                    <td><?php echo $oneSections['est_days']; ?></td>
                    <td><?php echo $count; ?></td>
                    <td><?php echo ($efficiency).'%'; ?></td>

                </tr>

                <?php
                 } else{
                 ?>
                     <tr>
                         <td colspan="8"><?php echo 'No Data Available' ?></td>


                     </tr>
                <?php
                 }
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