<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BookingDetails;
use App\Models\Counsellor;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class BookingAnalysisController extends Controller
{
    public function generateAnalysisPDF()
    {

        $categoryData = BookingDetails::select('category', DB::raw('count(*) as total'))
    ->groupBy('category')
    ->get();
        // Gather Gender Distribution Data
        $genderData = BookingDetails::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get();

        // Gather Year-wise Booking Data
        $yearData = BookingDetails::select('year', DB::raw('count(*) as total'))
            ->whereNotNull('year')
            ->groupBy('year')
            ->get();

        // Gather Faculty Distribution Data
        $facultyData = BookingDetails::select('faculty', DB::raw('count(*) as total'))
            ->whereNotNull('faculty')
            ->groupBy('faculty')
            ->get();

        // Gather Counselor Performance Data
        $counselorData = Counsellor::join('booking_details', 'counsellors.counsellor_id', '=', 'booking_details.counsellor_id')
            ->select('counsellors.full_name_with_rate', DB::raw('count(*) as total'))
            ->groupBy('counsellors.counsellor_id', 'counsellors.full_name_with_rate')
            ->get();

            $counselorPerformance = BookingDetails::select(
                'counsellors.full_name_with_rate as counselor_name',
                DB::raw("SUM(CASE WHEN booking_details.status = 'pending' THEN 1 ELSE 0 END) as pending"),
                DB::raw("SUM(CASE WHEN booking_details.status = 'done' THEN 1 ELSE 0 END) as done"),
                DB::raw('count(*) as total')
            )
            ->join('counsellors', 'counsellors.counsellor_id', '=', 'booking_details.counsellor_id')
            ->groupBy('counsellors.full_name_with_rate')
            ->get();

        // Pass data to the PDF view
        $pdf = Pdf::loadView('pdf.booking_analysis', compact('genderData', 'yearData', 'facultyData', 'categoryData', 'counselorPerformance'));

        // Return the PDF for download
        return $pdf->download('booking_analysis.pdf');
    }
}