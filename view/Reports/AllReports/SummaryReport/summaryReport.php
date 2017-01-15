<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
include_once '../../../../vendor/autoload.php';;
use App\Reports\fpdf\fpdf;
use App\Reports\AllReports\AllReports;

$_POST['companyId'] = $_SESSION['companyId'];
$from = $_POST['from'];
if (array_key_exists('toDate', $_POST)){
    $to = $_POST['to'];
} else {
    $to = $_POST['from'];
    $_POST['to'] = $_POST['from'];
}
//print_r($_POST);
//die();

$summary = new AllReports();
$summary->prepare($_POST);
$allEmployee = $summary->employee();
//print_r($allAttendance);
//die();

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Courier','B',14);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(25,0,'Summary Report',0,0,'C');
        // Arial bold 15
        $this->SetFont('Times','I',8);
        // Move to the right
        $this->Cell(50);

        $this->Cell(30,-10,'Print Date : '.date('Y-m-d h:i:s a'),0,0,'C');
        // Arial bold 15
        $this->SetFont('Arial','B',14);
        // Move to the right
        $this->Cell(80);
        $this->Ln(7);
        $this->SetFont('Courier','B',12);
        $this->Cell(80);
        $this->Cell(25,0,'2RA Technology Limited',0,0,'C');
        // Line break
        $this->Ln(8);
    }

    // Load data

    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

// Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }

// Better table
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }

// Colored table
    function FancyTable($header, $data)
    {
        foreach($data as $row) {
            $_POST['employeeId'] = $row['employee_id'];
            $summary = new AllReports();
            $summary->prepare($_POST);
            $allData = $summary->employeeAttendanceReport();

            $totalWorkingDay = 0;
            $totalHoliday = 0;
            foreach ($allData as $Data) {
                    $totalWorkingDay++;
                    $holiday = $summary->oneHoliday($Data['date']);
                    if (isset($holiday['date']) && !empty($holiday['date'])) {
                        $totalHoliday++;
                    }
            }
        }

        $totalWorkingDay = $totalWorkingDay-$totalHoliday;

        // Colors, line width and bold font
        $this->SetFillColor(232, 202, 247);
        $this->SetDrawColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(10, 20, 40, 27, 18, 18, 18, 18, 23);
        $this->SetFont('Times','',10);
        $this->Cell(20,5,'From : ',1,0,'L',false);
        $this->Cell(20,5,$_POST['from'],1,0,'L',false);
        $this->Cell(100,5,'',1,0,'C',false);
        $this->Cell(35,5,'Total Working Day : ',1,0,'L',false);
        $this->Cell(35,5,$totalWorkingDay,1,0,'L',false);
        $this->Ln(6);
        $this->Cell(20,5,'To : ',1,0,'L',false);
        $this->Cell(20,5,$_POST['to'],1,0,'L',false);
        $this->Cell(100,5,'',1,0,'C',false);
        $this->Cell(35,5,'Total Holiday : ',1,0,'L',false);
        $this->Cell(35,5,$totalHoliday,1,0,'L',false);
        $this->Ln(8);
        $this->SetFont('','B');
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $totalDuration = 0;
        $totalDay = 0;
        $totalHoliday = 0;
        $totalLate = 0;
        $totalAbsent = 0;
        $totalLeave = 0;
        $sl=0;
        foreach($data as $row)
        {
            $sl++;
            $_POST['employeeId'] = $row['employee_id'];
            $summary = new AllReports();
            $summary->prepare($_POST);
            $allData = $summary->employeeAttendanceReport();
            $totalDuration = 0;
            $totalPresent = 0;
            $totalLate = 0;
            $totalLeave = 0;
            $totalAbsent = 0;
            $totalHolidayDuty = 0;
            foreach($allData as $Data)
            {
                $totalDuration += $Data['duration'];
                if (isset($Data['in_time']) && !empty($Data['in_time'])) {
                    $holiday = $summary->oneHoliday($Data['date']);
                    if (isset($holiday['date']) && !empty($holiday['date'])) {
                        $totalHolidayDuty++;
                    }
                }
                if ($Data['status']=='A'){
                    $totalAbsent++;
                }
                if ($Data['status']=='CL' || $Data['status']=='SL' || $Data['status']=='ML' || $Data['status']=='EL' || $Data['status']=='H1,P' || $Data['status']=='H1,L' || $Data['status']=='H2,P' || $Data['status']=='H2,L' || $Data['status']=='CL,P' || $Data['status']=='CL,L' || $Data['status']=='SL,P' || $Data['status']=='SL,L' || $Data['status']=='ML,P' || $Data['status']=='ML,L' || $Data['status']=='EL,P' || $Data['status']=='EL,L'){
                    if ($Data['status']=='CL' || $Data['status']=='SL' || $Data['status']=='ML' || $Data['status']=='EL' || $Data['status']=='CL,P' || $Data['status']=='CL,L' || $Data['status']=='SL,P' || $Data['status']=='SL,L' || $Data['status']=='ML,P' || $Data['status']=='ML,L' || $Data['status']=='EL,P' || $Data['status']=='EL,L'){
                    $totalLeave+=1;
                    }elseif ($Data['status']=='H1,P' || $Data['status']=='H1,L' || $Data['status']=='H2,P' || $Data['status']=='H2,L'){
                        $totalLeave+=0.5;
                    }
                }
                if ($Data['status']=='P' || $Data['status']=='L' || $Data['status']=='H1,P' || $Data['status']=='H1,L' || $Data['status']=='H2,P' || $Data['status']=='H2,L'){
                   if ($Data['status']=='P' || $Data['status']=='L' && !isset($holiday['date'])){
                    $totalPresent+=1;
                   } elseif ($Data['status']=='H1,P' || $Data['status']=='H1,L' || $Data['status']=='H2,P' || $Data['status']=='H2,L'){
                       $totalPresent+=0.5;
                   }
                }
                if ($Data['status']=='L' || $Data['status']=='H1,L' || $Data['status']=='H2,L'){

                    if (isset($Data['holiday_name']) && !empty($Data['holiday_name'])){

                    } else{
                        $totalLate++;
                    }
                }
            }

            $hours = floor($totalDuration / (60*60));
            $totalDuration -= $hours * (60*60);
            $minutes = floor($totalDuration / 60);
            $totalDuration -= $minutes * 60;
            $seconds = $totalDuration;
            $totalDay++;

            $this->Cell($w[0],8,$sl,'LR',0,'C',$fill);
            $this->Cell($w[1],8,$row['employee_id'],'LR',0,'C',$fill);

            $this->Cell($w[2],8,$row['first_name'].' '.$row['last_name'],'LR',0,'C',$fill);

            $this->Cell($w[3],8,$hours.':'.$minutes.':'.$seconds,'LR',0,'C',$fill);
            $this->Cell($w[4],8,$totalPresent,'LR',0,'C',$fill);
            $this->Cell($w[5],8,$totalLate,'LR',0,'C',$fill);
            $this->Cell($w[6],8,$totalLeave,'LR',0,'C',$fill);
            $this->Cell($w[7],8,$totalAbsent,'LR',0,'C',$fill);
            $this->Cell($w[8],8,$totalHolidayDuty,'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;

            }


        }



    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-12);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(335,10,'copyright @ 2RA Technology Limited',0,0,'C');
    }
}

$pdf = new PDF();
// Column headings
$header = array('SL','ID', 'Name', 'Working Hour', 'Present', 'Late', 'Leave', 'Absent', 'Holiday Duty');

$pdf->SetFont('Times','',10);
$pdf->AddPage();
$pdf->FancyTable($header,$allEmployee);
$pdf->Output();
?>
