<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Vehicle;
use App\Services\ServiceManagementService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceManagementService;

    public function __construct(ServiceManagementService $serviceManagementService)
    {
        $this->serviceManagementService = $serviceManagementService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $services = $this->serviceManagementService->getPaginatedServices($search);

        return view('admin.services.index', compact('services', 'search'));
    }

    public function create()
    {
        $service = new Service();
        $vehicles = Vehicle::orderBy('immatriculation')->get();

        return view('admin.services.form', compact('service', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'service_date' => 'required|date',
            'service_type' => 'nullable|string|max:255',
        ]);

        $this->serviceManagementService->createService($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = $this->serviceManagementService->findService($id);

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = $this->serviceManagementService->findService($id);
        $vehicles = Vehicle::orderBy('immatriculation')->get();

        return view('admin.services.form', compact('service', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'service_date' => 'required|date',
            'service_type' => 'nullable|string|max:255',
        ]);

        $this->serviceManagementService->updateService($id, $validated);

        return redirect()->route('admin.services.index')->with('success', 'Service modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->serviceManagementService->deleteService($id);

        return redirect()->route('admin.services.index')->with('success', 'Le service a été supprimé avec succès.');
    }
}
