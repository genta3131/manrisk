<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use Illuminate\Http\Request;

class RiskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $risks = Risk::all();
        return view('risks.index', compact('risks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('risks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validasi input untuk semua field yang diperlukan
            $validated = $request->validate([
                'risk_id' => 'required|string|max:255',
                'status' => 'required|boolean',
                'risk_category' => 'required|string|max:255',
                'identification_date_range' => 'nullable|string',
                'description' => 'required|string',
                'probability' => 'required|integer|between:1,5',
                'impact' => 'required|integer|between:1,5',
            ]);

            // Parse identification_date_range to get start date
            $identification_date_range = $request->input('identification_date_range');
            $identification_date = null;
            if ($identification_date_range) {
                // Expected format: "12 Mei 2025 s.d 31 Mei 2025"
                // Parse to get start and end dates
                $parts = explode(' s.d ', $identification_date_range);
                if (count($parts) == 2) {
                    $start_date_str = trim($parts[0]);
                    $end_date_str = trim($parts[1]);

                    // Convert month names to numbers for parsing
                    $months = [
                        'Januari' => '01',
                        'Februari' => '02',
                        'Maret' => '03',
                        'April' => '04',
                        'Mei' => '05',
                        'Juni' => '06',
                        'Juli' => '07',
                        'Agustus' => '08',
                        'September' => '09',
                        'Oktober' => '10',
                        'November' => '11',
                        'Desember' => '12',
                    ];

                    // Helper function to convert Indonesian date string to Carbon date
                    $convertToDate = function($dateStr) use ($months) {
                        foreach ($months as $name => $num) {
                            if (str_contains($dateStr, $name)) {
                                $dateStr = str_replace($name, $num, $dateStr);
                                break;
                            }
                        }
                        // Expected format now: "12 05 2025"
                        $dateParts = explode(' ', $dateStr);
                        if (count($dateParts) == 3) {
                            return \Carbon\Carbon::createFromFormat('d m Y', $dateStr);
                        }
                        return null;
                    };

                    $start_date = $convertToDate($start_date_str);
                    $end_date = $convertToDate($end_date_str);

                    if ($start_date && $end_date) {
                        $identification_date = $start_date->format('d F Y') . ' - ' . $end_date->format('d F Y');
                    }
                }
            }
            if (!$identification_date) {
                $identification_date = date('Y-m-d'); // default to today if parsing fails or null
            }

            // Hitung level sebagai hasil perkalian antara probability dan impact
            $level = $request->probability * $request->impact;

            // Simpan data risiko dengan level yang sudah dihitung
            $risk = new Risk();
            $risk->risk_id = $request->input('risk_id');
            $risk->status = (bool) $request->input('status');
            $risk->risk_category = $request->input('risk_category');
            $risk->description = $request->input('description');
            $risk->probability = $request->input('probability');
            $risk->impact = $request->input('impact');
            $risk->level = $level;  // Menyimpan hasil perkalian ke kolom level
            $risk->identification_date = $identification_date;
            $risk->save();

            return redirect()->route('risks.index')->with('success', 'resiko berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Risk $risk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Risk $risk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Risk $risk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Risk $risk)
    {
        //
    }
}
