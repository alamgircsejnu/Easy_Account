<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Customer\Customer;

$_POST['companyId'] = $_SESSION['companyId'];

$customer = new Customer();
$customer->prepare($_POST);
$allCustomers = $customer->index();
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
        #custom-table{
            td,th{
                width: 300px!important;
            }
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
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Customer ID</th>
                    <th align="center">Customer Name</th>
                    <th align="center">Customer Address</th>
                    <th align="center">Customer Phone</th>
                    <th align="center">Customer Contact</th>
                    <th align="center">Contact Designation</th>
                    <th align="center">Contact Email</th>
                    <th align="center">Contact Mobile</th>
                    <th align="center">Factory Address</th>
                    <th align="center">Factory Phone</th>
                    <th align="center">Factory Contact</th>
                    <th align="center">Designation</th>
                    <th align="center">Factory Email</th>
                    <th align="center">Factory Mobile</th>
                    <th align="center">Starting Year</th>
                    <th align="center">Entry Date</th>
                    <th align="center">Entry By</th>
                    <th align="center">Debit</th>
                    <th align="center">Crebit</th>
                    <th align="center">Status</th>
                    <th align="center">Action</th>
                </tr>
                </thead>
                <?php
                if (isset($allCustomers) && !empty($allCustomers)) {
                $serial = 0;
                foreach ($allCustomers as $oneCustomer) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneCustomer['customer_id'] ?></td>
                    <td><?php echo $oneCustomer['customer_name']?></td>
                    <td><?php echo $oneCustomer['customer_address']; ?></td>
                    <td><?php echo $oneCustomer['customer_phone']; ?></td>
                    <td><?php echo $oneCustomer['customer_contact']; ?></td>
                    <td><?php echo $oneCustomer['contact_desig']; ?></td>
                    <td><?php echo $oneCustomer['customer_email']; ?></td>
                    <td><?php echo $oneCustomer['customer_mobile']; ?></td>
                    <td><?php echo $oneCustomer['customer_factory']; ?></td>
                    <td><?php echo $oneCustomer['factory_phone']; ?></td>
                    <td><?php echo $oneCustomer['factory_contact']; ?></td>
                    <td><?php echo $oneCustomer['fac_cont_desig']; ?></td>
                    <td><?php echo $oneCustomer['customer_email2']; ?></td>
                    <td><?php echo $oneCustomer['customer_mobile2']; ?></td>
                    <td><?php echo $oneCustomer['starting_year']; ?></td>
                    <td><?php echo $oneCustomer['data_entry_date']; ?></td>
                    <td><?php echo $oneCustomer['entry_by']; ?></td>
                    <td><?php echo $oneCustomer['debit']; ?></td>
                    <td><?php echo $oneCustomer['credit']; ?></td>
                    <td><?php echo $oneCustomer['status']; ?></td>
                    <td>
                        <a href="show.php?id=<?php echo $oneCustomer['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                     title="See Details" alt="Details"
                                                                                     src="../../../../asset/images/showDetails.png"
                                                                                     width="25" height="20"></a>
                        <a href="edit.php?id=<?php echo $oneCustomer['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                     title="Edit User Info" alt="Edit"
                                                                                     src="../../../../asset/images/edit.png"
                                                                                     width="25" height="20"></a>
                        <a href="trash.php?id=<?php echo $oneCustomer['id'] ?>" onclick="return confirm('Are you sure?')">
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
</html>