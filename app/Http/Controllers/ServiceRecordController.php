<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use App\Models\ServiceRecord;
use Illuminate\Http\Request;

class ServiceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all service records
        $records = ServiceRecord::with(['barber', 'service'])->orderBy('service_date', 'desc')->get();

        return view('service_records.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form to create a service record
        $barbers = Barber::all();
        $services = Service::all();

        return view('service_records.create', compact('barbers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store a service record
        $request->validate([
            'service_date' => 'required|date',
            'extra_fees'   => 'nullable|numeric',
            'notes'        => 'nullable|string',
            'barber_id'    => 'required|exists:barbers,id',
            'service_id'   => 'required|exists:services,id',
        ]);

        ServiceRecord::create($request->only([
            'service_date',
            'extra_fees',
            'notes',
            'barber_id',
            'service_id',
        ]));

        return redirect()->route('service_records.index')->with('success', 'Service record created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Show form to edit a service record
        $serviceRecord = ServiceRecord::findOrFail($id);

        $barbers = Barber::all();
        $services = Service::all();

        return view('service_records.edit', compact('serviceRecord', 'barbers', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceRecord $serviceRecord)
    {
        // Validate and update a service record
        $request->validate([
            'service_date' => 'required|date',
            'extra_fees'   => 'nullable|numeric',
            'notes'        => 'nullable|string',
            'barber_id'    => 'required|exists:barbers,id',
            'service_id'   => 'required|exists:services,id',
        ]);

        $serviceRecord->update($request->all());

        return redirect()->route('service_records.index')->with('success', 'Service record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete a service record
        $record = ServiceRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('service_records.index')->with('success', 'Service record deleted successfully.');
    }
}
