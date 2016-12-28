<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\Marketing\Offer\Offer;

$_POST['companyId'] = $_SESSION['companyId'];

$offer = new Offer();
$offer->prepare($_POST);
$allOffers = $offer->index();
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
    <div id="custom-table" class="col-md-10" style="background-color: #9acfea;padding: 1px">


        <div class="table-responsive" id="custom-table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th align="center">SL#</th>
                    <th align="center">Offer Id</th>
                    <th align="center">Customer Name</th>
                    <th align="center">Contact Person</th>
                    <th align="center">Phone Number</th>
                    <th align="center">Mobile Number</th>
                    <th align="center">Description</th>
                    <th align="center">Offer Amount</th>
                    <th align="center">Offer Date</th>
                    <th align="center">Entry Date</th>
                    <th align="center">Promoted By</th>
                    <th align="center">Entry By</th>
                    <th align="center">Action</th>
                </tr>
                </thead>
                <?php
                if (isset($allOffers) && !empty($allOffers)) {
                $serial = 0;
                foreach ($allOffers as $oneOffer) {
                $serial++
                ?>
                <tbody>
                <tr>
                    <td><?php echo $serial ?></td>
                    <td><?php echo $oneOffer['offer_id'] ?></td>
                    <td><?php echo $oneOffer['customer_name']?></td>
                    <td><?php echo $oneOffer['contact_person']; ?></td>
                    <td><?php echo $oneOffer['phone_number']; ?></td>
                    <td><?php echo $oneOffer['mobile_number']; ?></td>
                    <td><?php echo $oneOffer['description']; ?></td>
                    <td><?php echo $oneOffer['offer_amount']; ?></td>
                    <td><?php echo $oneOffer['offer_date']; ?></td>
                    <td><?php echo $oneOffer['entry_date']; ?></td>
                    <td><?php echo $oneOffer['promoted_by']; ?></td>
                    <td><?php echo $oneOffer['entry_by']; ?></td>
                    <td>
                        <a href="show.php?id=<?php echo $oneOffer['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                     title="See Details" alt="Details"
                                                                                     src="../../../../asset/images/showDetails.png"
                                                                                     width="25" height="20"></a>
                        <a href="edit.php?id=<?php echo $oneOffer['id'] ?>"> <img style="margin: 3%" border="0"
                                                                                     title="Edit User Info" alt="Edit"
                                                                                     src="../../../../asset/images/edit.png"
                                                                                     width="25" height="20"></a>
                        <a href="trash.php?id=<?php echo $oneOffer['id'] ?>" onclick="return confirm('Are you sure?')">
                            <img style="margin: 3%" border="0" title="Delete This User" alt="Delete"
                                 src="../../../../asset/images/delete.png" width="25" height="20"></a>
                    </td>
                </tr>
                <?php
                }
                } else {
                    ?>
                    <tr>
                        <td colspan="13" align="center">
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