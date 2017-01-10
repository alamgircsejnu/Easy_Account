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

$attendance = new AllReports();
$attendance->prepare($_POST);
$allAttendance = $attendance->employeeAttendanceReport();
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
        $this->Cell(25,0,'Employee Attendance Report',0,0,'C');
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

        // Colors, line width and bold font
        $this->SetFillColor(232, 202, 247);
        $this->SetDrawColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(23, 23, 23, 23, 23, 23, 33, 23);

        $this->Cell(35,5,'From : '.$_POST['from'],1,0,'L',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(35,5,'To : '.$_POST['to'],1,0,'L',false);
        $this->Ln(5);
        $this->Cell(40,5,'Employee ID : '.$_POST['employeeId'],1,0,'L',false);
        $this->Cell(32,5,'',1,0,'C',false);
        $this->Cell(33,5,'',1,0,'C',false);
        $this->Cell(35,5,'Employee Name : '.$data[0]['employee_name'],1,0,'L',false);
        $this->Ln(8);

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
        foreach($data as $row)
        {

            $totalDay++;
            if (isset($row['holiday_name']) && !empty($row['holiday_name'])){
                $totalHoliday++;
            }

            if ($row['status']=='A'){
                $totalAbsent++;
            }
            if ($row['status']=='CL' || $row['status']=='SL' || $row['status']=='ML' || $row['status']=='EL'){
                $totalLeave++;
            }

            $date = $row['date'];
            $day = date('l', strtotime($date));
            $row['day'] = $day;
            if (!empty($row['in_time'])){
            $time = new \DateTime($row['in_time']);
            $row['in_time']='';
            $row['in_time'] = $time->format('h:i:s a');
            $time = new \DateTime($row['out_time']);
            $row['out_time']='';
            $row['out_time'] = $time->format('h:i:s a');
                $totalDuration += $row['duration'];
            $row['duration']=gmdate('H:i:s', $row['duration']);

            }

            $this->Cell($w[0],6,$row['date'],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row['day'],'LR',0,'C',$fill);
            if ($row['status']=='L'){
                $totalLate++;
                $this->SetTextColor(255,0,0);
            }
            $this->Cell($w[2],6,$row['in_time'],'LR',0,'C',$fill);
            if ($row['status']=='L'){
                $this->SetTextColor(0);
            }
            $this->Cell($w[3],6,$row['out_time'],'LR',0,'C',$fill);
            $this->Cell($w[4],6,$row['duration'],'LR',0,'C',$fill);
            $this->Cell($w[5],6,$row['status'],'LR',0,'C',$fill);
            $this->Cell($w[6],6,$row['holiday_name'],'LR',0,'C',$fill);
            $this->Cell($w[7],6,$row['remarks'],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->SetDrawColor(0,0,0);
//        $this->Line(10, 230, 254-50, 230); // 50mm from each edge
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(3);

        $this->SetDrawColor(255,255,255);
        $hours = floor($totalDuration / (60*60));
        $totalDuration -= $hours * (60*60);
        $minutes = floor($totalDuration / 60);
        $totalDuration -= $minutes * 60;
        $seconds = $totalDuration;
        $this->Cell($w[0],0,'','T');
        $this->Cell($w[1],0,'','T');
        $this->Cell($w[2],0,'','T');
        $this->SetFont('Arial','B',8);
        $this->Cell($w[3],0,'TOTAL',1,0,'C','T');
        $this->Cell($w[4],0,$hours.':'.$minutes.':'.$seconds,1,0,'C','T');
        $this->Cell($w[5],0,'','T');
        $this->Cell($w[6],0,'','T');
        $this->Cell($w[7],0,'','T');
        $this->Ln(2);
        $this->SetDrawColor(255,255,255);
        $totalWorkingDay = $totalDay-$totalHoliday;
        $totalPresent = $totalWorkingDay-($totalLeave+$totalAbsent);
        $this->Cell(35,5,'Total Working Day',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,$totalWorkingDay,1,0,'C',false);$this->Ln();
        $this->Cell(35,5,'Total HoliDay',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,$totalHoliday,1,0,'C',false);$this->Ln();
        $this->Cell(35,5,'Total Present',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,$totalPresent,1,0,'C',false);$this->Ln();
        $this->Cell(35,5,'Total Late',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,$totalLate,1,0,'C',false);$this->Ln();
        $this->Cell(35,5,'Total Absent',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,$totalAbsent,1,0,'C',false);$this->Ln();
        $this->Cell(35,5,'Total Leave',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,$totalLeave,1,0,'C',false);$this->Ln();
        $this->Cell(35,5,'Effeciency',1,0,'L',false);
        $this->Cell(10,5,':',1,0,'L',false);
        $this->Cell(5,5,'',1,0,'C',false);

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
$header = array('DATE','DAY', 'IN TIME', 'OUT TIME', 'DURATION', 'STATUS', 'HOLIDAY NAME', 'REMARKS');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Times','',10);
$pdf->AddPage();
$pdf->FancyTable($header,$allAttendance);
$pdf->Output();
?>
