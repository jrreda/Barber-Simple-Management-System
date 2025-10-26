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

    /**
     * Calulate the total revenue of a barber.
     */
    public function revenue(Request $request)
    {
        $startDate  = $request->get('start_date', now()->startOfMonth());
        $endDate    = $request->get('end_date', now()->endOfMonth());
        $proportion = $request->get('proportion', 5);                      // Default proportion is 5%

        $barberIncomes = Barber::with(['serviceRecords' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('service_date', [$startDate, $endDate]);
        }, 'serviceRecords.service'])
        ->get()
        ->map(function($barber) use ($proportion) {
            $totalIncome = $barber->serviceRecords->sum(function($record) {
                return $record->service->final_price + ($record->extra_fees ?? 0);
            });

            return [
                'name'         => $barber->name,
                'total_income' => $barber->serviceRecords->sum(function($record) {
                    return $record->service->final_price + ($record->extra_fees ?? 0);
                }),
                'services_count' => $barber->serviceRecords->count(),
                'bonus'          => ($totalIncome * $proportion) / 100,
                'records'        => $barber->serviceRecords
            ];
        });

        $totalIncome = $barberIncomes->sum('total_income');
        $totalBonus = $barberIncomes->sum('bonus');

        return view('revenue.index', compact('totalIncome', 'barberIncomes', 'totalBonus', 'startDate', 'endDate', 'proportion'));
    }
}
