<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
include_once '../../../../vendor/autoload.php';;
use App\Reports\fpdf\fpdf;
use App\Reports\AllReports\AllReports;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
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

$leave = new AllReports();
$leave->prepare($_POST);
$employee = $leave->oneEmployee();
$allLeave = $leave->leaveReport();
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
        $this->Cell(25,0,'Employee Leave Report',0,0,'C');
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
        $this->Ln(10);
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
    function FancyTable($header,$employee, $data)
    {

        // Colors, line width and bold font
        $this->SetFillColor(232, 202, 247);
        $this->SetDrawColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(13, 26, 27, 27, 23, 35, 35);

        $this->Cell(40,5,'Employee ID : '.$_POST['employeeId'],1,0,'L',false);
        $this->Cell(32,5,'',1,0,'C',false);
        $this->Cell(33,5,'',1,0,'C',false);
        $this->Cell(20,5,'',1,0,'C',false);
        $this->Cell(35,5,'Employee Name : '.$employee['first_name'].' '.$employee['last_name'],1,0,'L',false);
        $this->Ln(6);
        $this->Cell(35,5,'From : '.$_POST['from'],1,0,'L',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(20,5,'',1,0,'C',false);
        $this->Cell(35,5,'To : '.$_POST['to'],1,0,'L',false);
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
        $SL = 0;
        $casualLeave = 0;
        $sickLeave = 0;
        $maternityLeave = 0;
        $earnLeave = 0;
        foreach($data as $row)
        {
            $SL++;

            if ($row['purpose']=='CL' || $row['purpose']=='SL' || $row['purpose']=='ML' || $row['purpose']=='EL'){
                if ($row['purpose']=='CL'){
                    $leaveType = 'Casual Leave';
                    if ($row['h_f']=='First Half' || $row['h_f']=='Second Half') {
                        $casualLeave+=0.5;
                    } elseif ($row['h_f']=='Full Day'){
                        $casualLeave+=1;
                    }
                } elseif ($row['purpose']=='SL'){
                    $leaveType = 'Sick Leave';
                    if ($row['h_f']=='First Half' || $row['h_f']=='Second Half') {
                        $sickLeave+=0.5;
                    } elseif ($row['h_f']=='Full Day'){
                        $sickLeave+=1;
                    }
                } elseif ($row['purpose']=='ML'){
                    $leaveType = 'Maternity Leave';
                    if ($row['h_f']=='First Half' || $row['h_f']=='Second Half') {
                        $maternityLeave+=0.5;
                    } elseif ($row['h_f']=='Full Day'){
                        $maternityLeave+=1;
                    }
                } elseif ($row['purpose']=='EL'){
                    $leaveType = 'Earn Leave';
                    if ($row['h_f']=='First Half' || $row['h_f']=='Second Half') {
                        $earnLeave+=0.5;
                    } elseif ($row['h_f']=='Full Day'){
                        $earnLeave+=1;
                    }
                }
            }
            if ($row['h_f']=='First Half' || $row['h_f']=='Second Half' || $row['h_f']=='Full Day'){
                if ($row['h_f']=='First Half' || $row['h_f']=='Second Half'){
                    $HF = 'Half Day';
                } elseif ($row['h_f']=='Full Day'){
                    $HF = 'Full Day';
                }
            }

            $this->Cell($w[0],7,$SL,'LR',0,'C',$fill);
            $this->Cell($w[1],7,$row['date'],'LR',0,'C',$fill);
            $this->Cell($w[2],7,$leaveType,'LR',0,'C',$fill);
            $this->Cell($w[3],7,$HF,'LR',0,'C',$fill);
            $this->Cell($w[4],7,$row['ref'],'LR',0,'C',$fill);
            $this->Cell($w[5],7,$row['approved_date'],'LR',0,'C',$fill);
            $this->Cell($w[6],7,$row['approved_by'],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->SetDrawColor(0,0,0);
//        $this->Line(10, 230, 254-50, 230); // 50mm from each edge
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(8);
        $this->SetDrawColor(255,255,255);
        $this->Cell(130);
        $this->Cell(35,5,'Casual Leave',1,0,'R',false);
        $this->Cell(5,5,':',1,0,'L',false);
        $this->Cell(5,5,$casualLeave,1,0,'C',false);$this->Ln();
        $this->Cell(130);
        $this->Cell(35,5,'Sick Leave',1,0,'R',false);
        $this->Cell(5,5,':',1,0,'L',false);
        $this->Cell(5,5,$sickLeave,1,0,'C',false);$this->Ln();
        $this->Cell(130);
        $this->Cell(35,5,'Maternity Leave',1,0,'R',false);
        $this->Cell(5,5,':',1,0,'L',false);
        $this->Cell(5,5,$maternityLeave,1,0,'C',false);$this->Ln();
        $this->Cell(130);
        $this->Cell(35,5,'Earn Leave',1,0,'R',false);
        $this->Cell(5,5,':',1,0,'L',false);
        $this->Cell(5,5,$earnLeave,1,0,'C',false);$this->Ln();
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
$header = array('SL','DATE', 'LEAVE TYPE','HALF/FULL', 'REF.', 'APPROVED DATE', 'APPROVED BY');
// Data loading
//$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Times','',10);
$pdf->AddPage();
$pdf->FancyTable($header,$employee,$allLeave);
$pdf->Output();
} else{
    header('Location:../../../User/ManageUser/Login/login.php');
}
?>
