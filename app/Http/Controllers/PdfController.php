<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    //
    public function generatePdf()
    {
        $pdf = app('fpdf');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Hello World!');
        $pdf->Output();

        exit;
    }
}
