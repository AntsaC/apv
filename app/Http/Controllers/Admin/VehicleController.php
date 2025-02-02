<?php

namespace App\Http\Controllers\Admin;

use App\Enum\EnergyType;
use App\Enum\EventOrigin;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vehicles.index', [
            'vehicles' => Vehicle::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicle = new Vehicle();

        return view('admin.vehicles.form',  [
            'sellers' => Seller::all(),
            'origins' => EventOrigin::cases(),
            'energies'  => EnergyType::cases(),
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:20|unique:vehicles,immatriculation',
            'vin' => 'required|string|max:50|unique:vehicles,vin',
            'version' => 'nullable|string|max:255',
            'kilometrage' => 'nullable|integer|min:0',
            'circulationDate' => 'nullable|date',
            'purchaseDate' => 'nullable|date',
            'eventDate' => 'nullable|date',
            'lastEventDate' => 'nullable|date',
            'energy' => 'nullable|string',
            'saleType' => 'nullable|string',
            'saleFileNumber' => 'nullable|string|max:255',
            'saleOrigin' => 'nullable|string',
            'vn_seller_id' => 'nullable|exists:sellers,id',
            'vo_seller_id' => 'nullable|exists:sellers,id',
            'intermediate_seller_id' => 'nullable|exists:sellers,id',
        ]);
    
        $vehicle = Vehicle::create($validated);
    
        return redirect()->route('admin.vehicles.index')->with('success', 'Véhicule ajouté avec succès.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
