<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barbers = Barber::all();
        return view('barbers.index', compact('barbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:barbers,email',
            'phone'   => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Create a new barber
        Barber::create($request->only(['name', 'email', 'phone', 'address']));

        return redirect()->route('barbers.index')->with('success', 'Barber added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barber = Barber::findOrFail($id);
        return view('barbers.edit', compact('barber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barber $barber)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:barbers,email,' . $barber->id,
            'phone'   => 'required|string|max:20|unique:barbers,phone',
            'address' => 'nullable|string|max:255',
        ]);
        $barber->update($request->only('name', 'email', 'phone', 'address'));

        return redirect()->route('barbers.index')->with('success', 'Barber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Barber::destroy($id);

        return redirect()->route('barbers.index')->with('success', 'Barber deleted successfully.');
    }
}
