<?php

namespace App\Http\Controllers;

use App\Models\Mitigation;
use App\Models\Risk;
use Illuminate\Http\Request;

class MitigationController extends Controller
{
    /**
     * Display a listing of the mitigations with related risks.
     */
    public function index(Request $request)
    {
        $query = Mitigation::with('risk');

        if ($request->has('risk_id') && $request->risk_id != '') {
            $query->where('risk_id', $request->risk_id);
        }

        $mitigations = $query->get();

        // Get all risks for filter dropdown
        $risks = \App\Models\Risk::all();

        return view('mitigations.index', compact('mitigations', 'risks'));
    }

    /**
     * Show the form for editing the specified mitigation.
     */
    public function edit(Mitigation $mitigation)
    {
        return view('mitigations.edit', compact('mitigation'));
    }

    /**
     * Update the specified mitigation in storage.
     */
    public function update(Request $request, Mitigation $mitigation)
    {
        $validated = $request->validate([
            'mitigation_description' => 'nullable|string',
            'probability' => 'required|integer|between:1,5',
            'impact' => 'required|integer|between:1,5',
            'risk_description' => 'nullable|string',
        ]);

        $mitigation->update([
            'mitigation_description' => $validated['mitigation_description'] ?? $mitigation->mitigation_description,
            'probability' => $validated['probability'],
            'impact' => $validated['impact'],
        ]);

        // Update related risk's probability, impact, description, and level
        $risk = $mitigation->risk;
        $risk->probability = $validated['probability'];
        $risk->impact = $validated['impact'];
        if (isset($validated['risk_description'])) {
            $risk->description = $validated['risk_description'];
        }
        $risk->save();

        return redirect()->route('mitigations.index')->with('success', 'Mitigation updated successfully.');
    }
}
