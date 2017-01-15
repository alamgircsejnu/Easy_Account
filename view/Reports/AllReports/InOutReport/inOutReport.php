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

$report = new AllReports();
$report->prepare($_POST);
$allPunch = $report->inOutReport();
//print_r($_POST);
//die();

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Courier', 'B', 16);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(25, 0, 'Detail In Out Report', 0, 0, 'C');
        // Arial bold 15
        $this->SetFont('Times', 'I', 8);
        // Move to the right
        $this->Cell(50);

        $this->Cell(30, -10, 'Print Date : ' . date('Y-m-d h:i:s a'), 0, 0, 'C');
        // Arial bold 15
        $this->SetFont('Arial', 'B', 14);
        // Move to the right
        $this->Cell(80);
        $this->Ln(7);
        $this->SetFont('Courier', 'B', 12);
        $this->Cell(80);
        $this->Cell(25, 0, '2RA Technology Limited', 0, 0, 'C');
        // Line break
        $this->Ln(8);
    }

    // Load data

    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

// Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

// Better table
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

// Colored table
    function FancyTable($header, $data)
    {

        // Colors, line width and bold font
        $this->SetFillColor(232, 202, 247);
        $this->SetDrawColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(25,25, 50, 30, 30, 30);

        $this->Cell(35,5,'From : '.$_POST['from'],1,0,'L',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(35,5,'',1,0,'C',false);
        $this->Cell(20,5,'',1,0,'C',false);
        $this->Cell(35,5,'To : '.$_POST['to'],1,0,'L',false);
        $this->Ln(6);

        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $tempDate = '';
        foreach ($data as $row) {
            $time = new \DateTime($row['ctime']);
            $row['ctime']='';
            $row['ctime'] = $time->format('h:i:s a');
            $date = $time->format('d-m-Y');
            if ($tempDate!=$date){
                $tempDate = $date;
            $this->Cell($w[0], 6, $date, 'LR', 0, 'C', $fill);
            } else{
                $this->Cell($w[0], 6, '', 'LR', 0, 'C', $fill);
            }
            $this->Cell($w[1], 6, $row['employee_id'], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row['employee_name'], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row['ctime'], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, '2RA Office', 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 6, $row['purpose'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-12);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(335, 10, 'copyright @ 2RA Technology Limited', 0, 0, 'C');
    }
}

$pdf = new PDF();
// Column headings
$header = array('Date','Employee ID','Employee Name', 'TIME', 'Gate', 'In/Out');
// Data loading
//$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Times','',10);
$pdf->AddPage();
$pdf->FancyTable($header,$allPunch);
$pdf->Output();
?>
