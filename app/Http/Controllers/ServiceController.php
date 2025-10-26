<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:fixed,percentage',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        // Additional validation for discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->withErrors(['discount_value' => 'Percentage discount cannot exceed 100%'])->withInput();
        }

        if ($request->discount_type === 'fixed' && $request->discount_value > $request->price) {
            return back()->withErrors(['discount_value' => 'Fixed discount cannot exceed the price'])->withInput();
        }

        // Create a new service
        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Service added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:fixed,percentage',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        // Additional validation for discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->withErrors(['discount_value' => 'Percentage discount cannot exceed 100%'])->withInput();
        }

        if ($request->discount_type === 'fixed' && $request->discount_value > $request->price) {
            return back()->withErrors(['discount_value' => 'Fixed discount cannot exceed the price'])->withInput();
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::destroy($id);

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
