<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Employee\ManageEmployee\Employee;

$_POST['companyId'] = $_SESSION['companyId'];
//session_start();
$id = $_GET['id'];

$employee = new Employee();
$employee->prepare($_POST);
$oneEmployee = $employee->show($id);
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


<div class="row" style="margin-left: 21%;width: 800px">
    <div class="col-md-2"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;">
        <div class="row">
            <div class="table-responsive" id="custom-table">
                <table class="table table-bordered">
                    <tbody>
                    <tr style="background-color: #9acfea">
                        <td colspan="2">
                            <div align="center">
                                <p><b>User Details</b></p>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Employee ID :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['employee_id'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['first_name'].' '.$oneEmployee['last_name'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Card ID :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['card_id']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Department :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['department']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Designation :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['designation']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Date of Birth :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['date_of_birth']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Joining Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['joining_date']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Shift :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['shift']; ?></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <p>Contact No :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['contact_no']; ?></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <p>Present Address :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['present_address']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Permanent Address :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['permanent_address']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Status :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['status']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Blood Group :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['blood_group']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Remarks :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneEmployee['remarks']; ?></p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
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