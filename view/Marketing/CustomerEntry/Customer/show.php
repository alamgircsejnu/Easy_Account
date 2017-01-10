<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Customer\Customer;

$_POST['companyId'] = $_SESSION['companyId'];
//session_start();
$id = $_GET['id'];

$customer = new Customer();
$customer->prepare($_POST);
$oneCustomer = $customer->show($id);
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

<div style="width: 100px;background-color:#2b669a;margin-left: 414px;height: 30px ">
    <a style="margin: 5%;padding: 5%" href="edit.php?id=<?php echo $oneCustomer['id'] ?>"> <img style="margin: 3%"
                                                                                                border="0"
                                                                                                title="Edit User Info"
                                                                                                alt="Edit"
                                                                                                src="../../../../asset/images/edit.png"
                                                                                                width="25" height="20"></a>
    <a style="margin: 5%;padding: 5%" href="trash.php?id=<?php echo $oneCustomer['id'] ?>"
       onclick="return confirm('Are you sure?')"> <img style="margin: 3%" border="0" title="Delete This User"
                                                       alt="Delete" src="../../../../asset/images/delete.png" width="25"
                                                       height="20"></a>
</div>

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
                                <p><b>Customer Details</b></p>
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
                                <p><?php echo $oneCustomer['customer_id'] ?></p>
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
                                <p><?php echo $oneCustomer['customer_name']?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Customer Address :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_address']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Customer Phone :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_phone']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Customer Contact :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_contact']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Contact Designation :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['contact_desig']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Contact Email :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_email']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Contact Mobile :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_mobile']; ?></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <p>Factory Address :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_factory']; ?></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div>
                                <p>Factory Phone :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['factory_phone']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Factory Contact :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['factory_contact']; ?></p>
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
                                <p><?php echo $oneCustomer['fac_cont_desig']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Factory Email :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_email2']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Factory Mobile :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['customer_mobile2']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Starting Year :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['starting_year']; ?></p>
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
                                <p><?php echo $oneCustomer['data_entry_date']; ?></p>
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
                                <p><?php echo $oneCustomer['entry_by']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Debit :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['debit']; ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <p>Credit :</p>
                            </div>
                        </td>
                        <td>
                            <div>
                                <p><?php echo $oneCustomer['credit']; ?></p>
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
                                <p><?php echo $oneCustomer['status']; ?></p>
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