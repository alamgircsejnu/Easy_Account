<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
include_once '../../../../vendor/autoload.php';;
use App\Reports\fpdf\fpdf;
use App\Reports\AllReports\AllReports;
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $_POST['companyId'] = $_SESSION['companyId'];
    $from = $_POST['from'];
    if (array_key_exists('toDate', $_POST)) {
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
            $this->SetFont('Courier', 'B', 15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(25, 0, 'Leave Summary Report', 0, 0, 'C');
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
            $w = array(10, 20, 40, 23, 23, 30, 23, 23);
            $this->SetFont('Times', '', 10);
            $this->Cell(15, 5, 'From : ', 1, 0, 'R', false);
            $this->Cell(15, 5, $_POST['from'], 1, 0, 'L', false);
            $this->Cell(125, 5, '', 1, 0, 'C', false);
            $this->Cell(15, 5, 'To : ', 1, 0, 'R', false);
            $this->Cell(15, 5, $_POST['to'], 1, 0, 'L', false);
            $this->Ln(6);
            $this->SetFont('', 'B');
            for ($i = 0; $i < count($header); $i++)
                $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;
            $sl = 0;
            foreach ($data as $row) {
                $sl++;
                $_POST['employeeId'] = $row['employee_id'];
                $summary = new AllReports();
                $summary->prepare($_POST);
                $allData = $summary->leaveSummaryReport();

                $casualLeave = 0;
                $sickLeave = 0;
                $maternityLeave = 0;
                $earnLeave = 0;
                foreach ($allData as $Data) {
                    if (isset($Data['h_f']) && !empty($Data['h_f'])) {
                        if ($Data['purpose'] == 'CL') {
                            if ($Data['h_f'] == 'Full Day') {
                                $casualLeave += 1;
                            } elseif ($Data['h_f'] == 'First Half' || $Data['h_f'] == 'Second Half') {
                                $casualLeave += 0.5;
                            }
                        } elseif ($Data['purpose'] == 'SL') {
                            if ($Data['h_f'] == 'Full Day') {
                                $sickLeave += 1;
                            } elseif ($Data['h_f'] == 'First Half' || $Data['h_f'] == 'Second Half') {
                                $sickLeave += 0.5;
                            }
                        } elseif ($Data['purpose'] == 'ML') {
                            if ($Data['h_f'] == 'Full Day') {
                                $maternityLeave += 1;
                            } elseif ($Data['h_f'] == 'First Half' || $Data['h_f'] == 'Second Half') {
                                $maternityLeave += 0.5;
                            }
                        } elseif ($Data['purpose'] == 'EL') {
                            if ($Data['h_f'] == 'Full Day') {
                                $earnLeave += 1;
                            } elseif ($Data['h_f'] == 'First Half' || $Data['h_f'] == 'Second Half') {
                                $earnLeave += 0.5;
                            }
                        }
                    }
                }
                $totalLeave = $casualLeave + $sickLeave + $maternityLeave + $earnLeave;

                $this->Cell($w[0], 8, $sl, 'LR', 0, 'C', $fill);
                $this->Cell($w[1], 8, $row['employee_id'], 'LR', 0, 'C', $fill);

                $this->Cell($w[2], 8, $row['first_name'] . ' ' . $row['last_name'], 'LR', 0, 'C', $fill);

                $this->Cell($w[3], 8, $casualLeave, 'LR', 0, 'C', $fill);
                $this->Cell($w[4], 8, $sickLeave, 'LR', 0, 'C', $fill);
                $this->Cell($w[5], 8, $maternityLeave, 'LR', 0, 'C', $fill);
                $this->Cell($w[6], 8, $earnLeave, 'LR', 0, 'C', $fill);
                $this->Cell($w[7], 8, $totalLeave, 'LR', 0, 'C', $fill);
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
    $header = array('SL', 'ID', 'Name', 'Casual Leave', 'Sick Leave', 'Maternity Leave', 'Earn Leave', 'Total Leave');

    $pdf->SetFont('Times', '', 10);
    $pdf->AddPage();
    $pdf->FancyTable($header, $allEmployee);
    $pdf->Output();
} else{
    header('Location:../../../User/ManageUser/Login/login.php');
}
?>
