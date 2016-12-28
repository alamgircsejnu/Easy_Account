<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\CreateProject\ProjectTracking;

//session_start();
$id = $_GET['id'];

$project = new ProjectTracking();
$oneProject = $project->show($id);
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

<div style="width: 110px;background-color:#2b669a;margin-left: 351px;height: 30px ">
    <a style="margin: 5%;padding: 5%" href="edit.php?id=<?php echo $oneProject['id'] ?>"> <img style="margin: 3%"
                                                                                                border="0"
                                                                                                title="Edit User Info"
                                                                                                alt="Edit"
                                                                                                src="../../../../asset/images/edit.png"
                                                                                                width="25" height="20"></a>
    <a style="margin: 5%;padding: 5%" href="trash.php?id=<?php echo $oneProject['id'] ?>"
       onclick="return confirm('Are you sure?')"> <img style="margin: 3%" border="0" title="Delete This User"
                                                       alt="Delete" src="../../../../asset/images/delete.png" width="25"
                                                       height="20"></a>
    <div class="pull-right" style=" margin-right: -513px;height: 27px;width: 110px;">
        <a class="btn btn-primary" role="button" style="padding: 5%" href="sections.php?projectId=<?php echo $oneProject['project_id'] ?>"> Tasks of this project </a>
    </div>

</div>


<div class="row" style="margin-left: 21%;width: 800px">
    <div class="col-md-1"></div>
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;">
        <div class="row">
            <div class="table-responsive" id="custom-table">
                <table class="table table-bordered">
                    <tbody>
                    <tr style="background-color: #9acfea">
                        <td colspan="2">
                            <div align="center">
                                <p><b>Project Details</b></p>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project ID :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['project_id'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['project_name'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Customer ID :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['customer_id']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Customer Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['customer_name']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Description :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['project_description']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Status :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['project_status']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Price :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['project_price']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>PO Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['po_date']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Delivery Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['delivery_date']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Entry Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['created_at']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Entry By :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['created_by']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Closing Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['finished_at']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Project Payment :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneProject['project_payment']; ?></p>
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