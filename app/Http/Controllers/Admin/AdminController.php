<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return view('dashboard', [
            'vehiclesTotal' => Vehicle::count(),
            'customersTotal'    => Customer::count()
        ]);
    }
}
