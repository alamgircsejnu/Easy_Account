
<?php
session_start();
include_once '../../../../vendor/autoload.php';
use App\ProjectTracking\TaskExecution\TaskExecution;
$_POST['companyId'] = $_SESSION['companyId'];
$project = new TaskExecution();
$project->prepare($_POST);
$workingEmployee = $project->workingEmployee();
//....................................................................................................
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 

"August", "September", "October", "November", "December");

$monthNumber = Array("1", "2", "3", "4", "5", "6", "7",

    "8", "9", "10", "11", "12");

if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");

if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");


$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
$colspan = $maxday+$startday;

?>
<!DOCTYPE html>
<html>
<head>
    <title>2RA Technology Limited</title>
    <link href="../../../../asset/css/pastReport.css" type="text/css" rel="stylesheet">

    <style>
        .scrollable{
            overflow: auto;
            overflow-y: hidden;
            margin: 0 auto;
            white-space: nowrap
        }

        .fn-scrollable *,
        .fn-scrollable *:after,
        .fn-scrollable *:before {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        #tdOfmonth td
        {
            padding:5px 50px 5px 50px;
        }

        /*#calenderReport a{*/
            /*color: red;*/
        /*}*/
    </style>

</head>
<body>

<div id="pastReport">
    <h2 id="example" style="padding-bottom: 2px">
        Employee Working Report
    </h2>
    <br>
    <div id="prevNext">
        <a class="pull-left btn btn-primary" href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" >Previous</a>
        <a class="pull-right btn btn-primary" href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>">Next</a>
    </div>
    <div class="scrollable">

        <div id="calenderReport">
            <table width="100%">
                <tr align="center" style="width: 500px;">
                    <td bgcolor="#999999" style="color:#FFFFFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="100%" border="1" cellpadding="2" cellspacing="2" id="tdOfmonth">
                            <tr align="center">
                                <td colspan="<?php echo $colspan+1; ?>" bgcolor="#b0b3b7" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
                            </tr>

                            <?php
                            $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
                            $maxday = date("t",$timestamp);
                            $thismonth = getdate ($timestamp);
                            $startday = $thismonth['wday'];
                            echo '<div class="scrollable">';
                            echo "<tr>";
                            echo '<td bgcolor="#b0b3b7" style="color:#FFFFFF">Employee Name</td>';

                            for ($j=0; $j<($maxday+$startday); $j++) {
                                if($j < $startday) {}
                                else echo "<td align='center' valign='middle' height='20px' bgcolor='#999999'>". ($j - $startday + 1) . "</td>";

                            }

                            echo "</tr>";
                            for ($m=0;$m<count($workingEmployee);$m++){
                                echo "<tr>";
                                echo '<td>'.$workingEmployee[$m]['done_by'].'</td>';
                                $workingReportData = $project->workingReportData($workingEmployee[$m]['done_by']);
//                            print_r($workingReportData);

                                for ($i=0; $i<($maxday+$startday); $i++) {

                                    $matched = 0;
                                    $section_id = '';

                                    for ($n=0;$n<count($workingReportData);$n++){
                                        $date = explode('-',$workingReportData[$n]['created_at']);
                                        $day = $date[2];
                                        $month = $date[1];
                                        $year = $date[0];
//                                    echo $day.' '.$month.' '.$year.'<br>';
                                        if($day==($i - $startday + 1) && $month==$monthNumber[$cMonth-1] && $year==$cYear) {

                                            $matched = 1;
                                            $section_id = $workingReportData[$n]['section_id'];
                                            break;
                                        }else{ $matched = 0;}



                                    }
                                    if($i < $startday) {

                                    }
                                    else if($matched==1) {

                                        echo "<td align='center' valign='middle' height='20px'>". $section_id . "</td>";

                                    }else{echo "<td align='center' valign='middle' height='20px'></td>";}

                                }
                                echo "</tr>";
                            }

                            echo '</div>';
                            ?>

                        </table>
                    </td>
                </tr>
            </table>

        </div>

    </div>
</div>
</body>
</html>