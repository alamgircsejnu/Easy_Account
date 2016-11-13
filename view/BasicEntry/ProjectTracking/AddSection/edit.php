<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\AddSection\AddSection;
use App\ProjectTracking\CreateProject\ProjectTracking;
use App\Employee\ManageEmployee\Employee;

if (isset($_SESSION['id']) && !empty($_SESSION['id'])){
//session_start();
$id = $_GET['id'];

    $project = new ProjectTracking();
    $allProjects = $project->index();

    $employee = new Employee();
    $allEmployees = $employee->index();

    $section = new AddSection();
    $oneSection = $section->show($id);
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
        <link href="../../../../asset/js/css/blitzer/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">

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
        <div style="width: 200px">
            <?php

            if (isset($_SESSION['successMessage'])) {
                echo '<h2 style="color: green;>' . $_SESSION['successMessage'] . '</h2><br>';
                unset($_SESSION['successMessage']);
            } else if (isset($_SESSION['errorMessage'])) {
                echo '<h2 style="color: red;>' . $_SESSION['errorMessage'] . '</h2><br>';
                unset($_SESSION['errorMessage']);
            }

            ?>
        </div>
        <div class="col-md-3"></div>

        <div class="col-md-6">


            <div class="panel panel-primary custom-panel">

                <div class="panel-heading">Edit Section</div>
                <br>
                <form role="form" action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div>
                        <div class="col-md-6">
                            <label for="projectId" style="margin-top: 5px">Task ID</label>
                            <select required name="projectId" class="form-control col-sm-6 custom-input" id="userType">
                                <?php
                                if (isset($allProjects) && !empty($allProjects)) {
                                    foreach ($allProjects as $oneProject) {
                                        ?>
                                        <option <?php if ($oneProject['project_id'] == $oneSection['project_id']) {
                                            echo 'selected';
                                        } ?>><?php echo $oneProject['project_id']?></option>

                                    <?php }}  ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="sectionId" style="margin-top: 5px">Section ID</label>
                            <input type="text" id="sectionId" name="sectionId" class="form-control custom-input"
                                   value="<?php echo $oneSection['section_id'] ?>"  placeholder="Secion ID" required>
                        </div>

                        <div class="col-md-6">
                            <label for="assignedTo" style="margin-top: 5px">Assigned To</label>
                            <select required name="assignedTo" class="form-control col-sm-6 custom-input" id="assignedTo">
                                <?php
                                if (isset($allEmployees) && !empty($allEmployees)) {
                                    foreach ($allEmployees as $oneEmployee) {
                                        ?>
                                        <option <?php if ($oneEmployee['first_name'].' '.$oneEmployee['last_name'] == $oneSection['assigned_to']) {
                                            echo 'selected';
                                        } ?>><?php echo $oneEmployee['first_name'].' '.$oneEmployee['last_name'];?></option>

                                    <?php }}  ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="assignedDate" style="margin-top: 5px">Assigned Date</label>
                            <input type="text" id="assignedDate" name="assignedDate" class="form-control custom-input"
                                   value="<?php echo $oneSection['assigned_date'] ?>" placeholder="Assigned Date">
                        </div>
                        <br><br><br>
                        <div class="col-md-6">
                            <label for="primaryEstimatedDate" style="margin-top: 5px">Estimated Date</label>
                            <input type="text" id="primaryEstimatedDate" name="primaryEstimatedDate" class="form-control custom-input"
                                   value="<?php echo $oneSection['primary_est_date'] ?>"  placeholder="Estimated Date">
                        </div>

                        <div class="col-md-6">
                            <label for="estimatedDays" style="margin-top: 5px">Estimated Days</label>
                            <input type="text" id="estimatedDays" name="estimatedDays" class="form-control custom-input"
                                   value="<?php echo $oneSection['est_days'] ?>" placeholder="Estimated Days" required>
                        </div>
                        <br><br><br>
                    </div>

                    <div class="col-md-12">
                        <label for="sectionDescription" style="margin-top: 5px">Section Description</label>
                        <textarea class="form-control custom-input" style="resize: none" name="sectionDescription" id="sectionDescription"><?php echo $oneSection['section_description'] ?></textarea>
                    </div>
                    <br><br><br>

                    <br><br><br>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div>
                                <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                    <button type="submit" class="btn btn-info pull-right">Update Section</button>
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


    <script src="jquery.checkAll.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>
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

    <script type="text/javascript">
        $(function () {
            $("#assignedDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+10"
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $("#primaryEstimatedDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+10"
            });
        });
    </script>

    <style>
        .ui-datepicker{
            font-size: 15px;
        }
    </style>

    <script type="text/javascript">
        $(function () {
            $("#joiningDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-80:+15"
            });
        });
    </script>
    <style>
        .ui-datepicker{
            font-size: 15px;

        }
        .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
            color: #2b669a;
            font-family: ...;
            font-size: 16px;
            font-weight: bold;
        }

    </style>
    </body>
    </html>

<?php } ?>