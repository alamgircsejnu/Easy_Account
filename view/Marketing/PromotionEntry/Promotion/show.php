<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Promotion\Promotion;

$_POST['companyId'] = $_SESSION['companyId'];
//session_start();
$id = $_GET['id'];

$promotion = new Promotion();
$promotion->prepare($_POST);
$onePromotion = $promotion->show($id);
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

<div style="width: 100px;background-color:#2b669a;margin-left: 348px;height: 30px ">
    <a style="margin: 5%;padding: 5%" href="edit.php?id=<?php echo $onePromotion['id'] ?>"> <img style="margin: 3%"
                                                                                                border="0"
                                                                                                title="Edit User Info"
                                                                                                alt="Edit"
                                                                                                src="../../../../asset/images/edit.png"
                                                                                                width="25" height="20"></a>
    <a style="margin: 5%;padding: 5%" href="trash.php?id=<?php echo $onePromotion['id'] ?>"
       onclick="return confirm('Are you sure?')"> <img style="margin: 3%" border="0" title="Delete This User"
                                                       alt="Delete" src="../../../../asset/images/delete.png" width="25"
                                                       height="20"></a>
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
                                <p><b>Promotion Details</b></p>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Promotion Code :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['promotion_id'] ?></p>
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
                                <p><?php echo $onePromotion['customer_name']?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Contact Person :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['contact_person']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Next Schedule :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['next_sched']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Contact :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['mobile_number']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Description :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['description']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Product :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['product']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Promotion Date :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['promotion_date']; ?></p>
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
                                <p><?php echo $onePromotion['entry_date']; ?></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <p>Promoted By :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $onePromotion['promoted_by']; ?></p>
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
                                <p><?php echo $onePromotion['entry_by']; ?></p>
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