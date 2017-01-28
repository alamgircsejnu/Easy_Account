<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Negotiator\NegotiatorEntry\Negotiator;

$_POST['companyId'] = $_SESSION['companyId'];
//session_start();
$id = $_GET['id'];

$negotiator = new Negotiator();
$negotiator->prepare($_POST);
$oneNegotiator = $negotiator->show($id);
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
                                <p><b>Negotiator Details</b></p>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator ID :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_id'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator Name :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_name']?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator Designation :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_designation']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator Company :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_company']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator Phone :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_phone']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator Email :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_email']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Negotiator Due :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneNegotiator['nego_due']; ?></p>
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
                                <p><?php echo $oneNegotiator['entry_date']; ?></p>
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
                                <p><?php echo $oneNegotiator['entry_by']; ?></p>
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