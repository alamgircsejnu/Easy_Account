<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;
use App\Employee\ManageEmployee\Employee;
use App\ProjectTracking\AddSection\AddSection;
//echo $_SESSION['id'];
//die();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
$_POST['companyId'] = $_SESSION['companyId'];
$project = new ProjectTracking();
$project->prepare($_POST);
$allProjects = $project->index();

    $firstProject = $project->firstEntry();
    $projectId = $firstProject['project_id'];
    if (isset($projectId) && !empty($projectId)){
        $section = new AddSection();
        $section->prepare($_POST);
        $oneSection = $section->lastEntry($projectId);


        if (isset($oneSection) && !empty($oneSection)){
            $section = $oneSection['section_id'];
            $exploded = explode('-',$section);
            $exploded[1] = (int)$exploded[1]+1;
            if ($exploded[1]<10){
                $exploded[1] = '0'.$exploded[1];
            }
            $sectionId = implode('-',$exploded);


        } else {
            $sectionId = $projectId.'-01';
        }
    }

$employee = new Employee();
$employee->prepare($_POST);
$allEmployees = $employee->index();

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
    <style type="text/css">
        td
        {
            padding:5px 15px 5px 15px;
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
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">


        <div class="panel panel-primary custom-panel">

            <div class="panel-heading">Create New Task</div>
            <br>
            <form role="form" action="store.php" method="post">

                <div class="col-md-8">
                    <div class="col-md-6">
                        <label for="projectId" style="margin-top: 5px">Project ID</label>
                        <select required name="projectId" class="form-control col-sm-6 custom-input" id="projectId">
                            <?php
                            if (isset($allProjects) && !empty($allProjects)) {
                                foreach ($allProjects as $oneProject) {
                                    ?>
                                    <option><?php echo $oneProject['project_id']?></option>

                                <?php }}  ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="sectionId" style="margin-top: 5px">Task ID</label>
                        <input type="text" id="sectionId" name="sectionId" class="form-control custom-input"
                              value="<?php if (isset($sectionId) && !empty($sectionId)) echo $sectionId; ?>" placeholder="Task ID" required>
                    </div>

                    <div class="col-md-6">
                        <label for="assignedTo" style="margin-top: 5px">Assigned To</label>
                        <select required name="assignedTo" class="form-control col-sm-6 custom-input" id="assignedTo">
                            <?php
                            if (isset($allEmployees) && !empty($allEmployees)) {
                                foreach ($allEmployees as $oneEmployee) {
                                    ?>
                                    <option><?php echo $oneEmployee['first_name'].' '.$oneEmployee['last_name'];?></option>

                                <?php }}  ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="assignedDate" style="margin-top: 5px">Assigned Date</label>
                        <input type="text" id="assignedDate" name="assignedDate" class="form-control custom-input"
                             value="<?php echo date('Y-m-d')?>"  placeholder="Assigned Date">
                    </div>
                    <br><br><br>
                    <div class="col-md-6">
                        <label for="primaryEstimatedDate" style="margin-top: 5px">Estimated Completion Date</label>
                        <input type="text" id="primaryEstimatedDate" name="primaryEstimatedDate" class="form-control custom-input"
                               placeholder="Estimated Date">
                    </div>

                    <div class="col-md-6">
                        <label for="estimatedDays" style="margin-top: 5px">Estimated Completion Days</label>
                        <input type="text" id="estimatedDays" name="estimatedDays" class="form-control custom-input"
                               placeholder="Estimated Days" required>
                    </div>
                    <br><br><br>
                    <div class="col-md-10">
                        <label for="sectionDescription" style="margin-top: 5px">Section Description</label>
                        <textarea class="form-control custom-input" style="resize: none" name="sectionDescription" id="sectionDescription"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label for="assignedTo" style="margin-top: 21px">Priority</label>
                        <select required name="priorityOfNewSection" class="form-control col-sm-6 custom-input" id="assignedTo">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 inline" style="min-height: 239px;border: 1px solid gray">
                    <h5 style="border-bottom: 1px solid gray">Priorities</h5>
                    <div id="priorityValues"></div>

                </div>


                <br><br><br>

                <br><br><br>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div>
                            <div class="col-md-4" style="float: right;width: 4%;margin-top: 11px;margin-right: 17px">
                                <button type="submit" class="btn btn-info pull-right">Add Task</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <div class="col-md-2"></div>
</div>


<br><br><br><br>
<script src="../../../../asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../../../asset/js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="../../../../asset/js/js/jquery-ui-1.10.4.custom.min.js"></script>

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

<script type="text/javascript">
    $('#projectId').on('change', function(){
        taskId = $('#projectId option:selected').val(); // the dropdown item selected value
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { taskId : taskId },
            url : 'getAjaxData.php',
            success : function(result){
//                console.log(result);
//                $('#sectionId).val(result('section_id'));
                $("#sectionId").val(result)
                }
        })

    });

</script>
<script type="text/javascript">
    $('#assignedTo').on('change', function(){
        assignedTo = $('#assignedTo option:selected').val();
//        console.log(assignedTo);// the dropdown item selected value
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { assignedTo : assignedTo },
            url : 'getAjaxProjectPriorityData.php',
            success : function(result){
                var trHTML = '<tr><td>Task ID</td><td align="center">Priority</td></tr>';
                $.each(result, function (i, item) {
                    console.log(item.priority);
                    var pro=item.priority;
                    if (pro==1){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1" selected>1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==2){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2" selected>2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==3){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3" selected>3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==4){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4" selected>4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==5){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5" selected>5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==6){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6" selected>6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==7){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7" selected>7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==8){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8" selected>8</option><option value="9">9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==9){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9" selected>9</option><option value="10">10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }
                    else if (pro==10){
                        trHTML += '<tr><td>' + item.section_id + '</td><td><select required name="priority[]" id="selectBox"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10" selected>10</option></select><input type="hidden" name="id[]" value="' + item.id + '"></td></tr>';
                    }


                    var div = document.getElementById('priorityValues');
                    while(div.firstChild){
                        div.removeChild(div.firstChild);
                    }
                    $('#priorityValues').append(trHTML);

                });
            }
        })

    });
</script>

<script type="text/javascript">
    $('#primaryEstimatedDate').on('change', function(){
        estimatedDate = $('#primaryEstimatedDate').val();
        assignedDate = $('#assignedDate').val();// the dropdown item selected value
        $.ajax({
            type :'POST',
            dataType:'json',
            data : { estimatedDate : estimatedDate,assignedDate : assignedDate},
            url : 'getAjaxDateDiff.php',
            success : function(result){
//                console.log(result);
//                $('#sectionId).val(result('section_id'));
                $("#estimatedDays").val(result)
            }
        })

    });

</script>



<br><br><br><br><br><br><br>
</body>
</html>

<?php } ?>