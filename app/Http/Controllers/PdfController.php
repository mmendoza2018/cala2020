<?php

namespace App\Http\Controllers;

use App\Models\ComplaintsBook;
use Illuminate\Http\Request;
use PDF;


class PdfController extends Controller
{
    function complaint(ComplaintsBook $complaintsBook)
    {
        $generalInfo = \App\Models\General::first();
        $pdf = PDF::loadView("admin.pdfs.complaint", ["complaintsBook" => $complaintsBook, "generalInfo" => $generalInfo], [], [
            'format' => 'A4-P' // 'A4-L' para landscape (horizontal), 'A4' para portrait (vertical)
        ]);

        return $pdf->output('', 'S');
    }
}
