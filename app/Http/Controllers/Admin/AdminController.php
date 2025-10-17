<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Services\GainStatisticsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $gainStatisticsService;

    public function __construct(GainStatisticsService $gainStatisticsService)
    {
        $this->gainStatisticsService = $gainStatisticsService;
    }

    public function dashboard(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $dailyGainData = $this->gainStatisticsService->getDailyGains($month, $year);

        $totalGain = $this->gainStatisticsService->getTotalGain();
        $selectedMonthGain = $this->gainStatisticsService->getMonthGain($month, $year);

        return view('dashboard', [
            'vehiclesTotal' => Vehicle::count(),
            'customersTotal' => Customer::count(),
            'totalGain' => $totalGain,
            'selectedMonthGain' => $selectedMonthGain,
            'dailyLabels' => json_encode($dailyGainData['labels']),
            'dailyData' => json_encode($dailyGainData['data']),
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ]);
    }
}
