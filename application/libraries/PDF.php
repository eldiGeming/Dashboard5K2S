<?php
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Machines List', 0, 1, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 10, 'No', 1);
        $this->Cell(40, 10, 'Name', 1);
        $this->Cell(40, 10, 'Date', 1);
        $this->Cell(30, 10, 'Status', 1);
        $this->Ln();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function LoadData($data) {
        $this->SetFont('Arial', '', 10);
        foreach ($data as $key => $row) {
            $this->Cell(10, 10, $key + 1, 1);
            $this->Cell(40, 10, $row['name'], 1);
            $this->Cell(40, 10, $row['date'], 1);
            $this->Cell(30, 10, $row['status'], 1);
            $this->Ln();
        }
    }
}
?>
