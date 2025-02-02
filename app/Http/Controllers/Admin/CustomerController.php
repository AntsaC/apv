<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('admin.customers.index', [
            'customers' => Customer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.form',  [
            'accounts' => Account::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cardNumber' => 'required|numeric',
            'civility' => 'string',
            'firstName' => 'nullable|string|max:50',
            'lastName' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'additionnalAdress' => 'nullable|string',
            'city' => 'required|string|max:100',
            'homePhone' => 'nullable|string|max:20',
            'portablePhone' => 'nullable|string|max:20',
            'jobPhone' => 'nullable|string|max:20',
            'email' => 'email|unique:customers',
            'type' => 'required|string',
            'business_account_id' => 'nullable|exists:accounts,id',
        ]);
    
        Customer::create($validatedData);
    
        return redirect()->route('admin.customers.index')->with('success', 'Client ajouté avec succès.');
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
