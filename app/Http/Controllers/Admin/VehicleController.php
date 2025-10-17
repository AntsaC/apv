<?php

namespace App\Http\Controllers\Admin;

use App\Enum\EnergyType;
use App\Enum\EventOrigin;
use App\Http\Controllers\Controller;
use App\Imports\VehiclesImport;
use App\Models\Seller;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $vehicles = $this->vehicleService->getPaginatedVehicles($search);

        return view('admin.vehicles.index', compact('vehicles', 'search'));
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
            'eventOrigin' => 'nullable|string',
            'vn_seller_id' => 'nullable|exists:sellers,id',
            'vo_seller_id' => 'nullable|exists:sellers,id',
            'intermediate_seller_id' => 'nullable|exists:sellers,id',
        ]);

        $this->vehicleService->createVehicle($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Véhicule ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = $this->vehicleService->findVehicle($id);

        return view('admin.vehicles.form', [
            'sellers' => Seller::all(),
            'origins' => EventOrigin::cases(),
            'energies'  => EnergyType::cases(),
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:20',
            'vin' => 'required|string|max:50',
            'version' => 'nullable|string|max:255',
            'kilometrage' => 'nullable|integer|min:0',
            'circulationDate' => 'nullable|date',
            'purchaseDate' => 'nullable|date',
            'eventDate' => 'nullable|date',
            'lastEventDate' => 'nullable|date',
            'energy' => 'nullable|string',
            'saleType' => 'nullable|string',
            'saleFileNumber' => 'nullable|string|max:255',
            'eventOrigin' => 'nullable|string',
            'vn_seller_id' => 'nullable|exists:sellers,id',
            'vo_seller_id' => 'nullable|exists:sellers,id',
            'intermediate_seller_id' => 'nullable|exists:sellers,id',
        ]);

        $this->vehicleService->updateVehicle($id, $validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Véhicule modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->vehicleService->deleteVehicle($id);

        return redirect()->route('admin.vehicles.index')->with('success', 'Le véhicule a été supprimé');
    }

    public function showImportForm()
    {
        return view('admin.vehicles.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new VehiclesImport, $request->file('file'));

        return redirect()->route('admin.vehicles.index')->with('success', 'All data has been successfully imported!');
    }
}
