<?php

namespace App\Services;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GainStatisticsService
{
    /**
     * Get daily gains for a specific month and year
     *
     * @param int $month
     * @param int $year
     * @return array
     */
    public function getDailyGains(int $month, int $year): array
    {
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $dailyGains = Service::select(
            DB::raw('DATE(service_date) as date'),
            DB::raw('SUM(price) as total')
        )
        ->whereBetween('service_date', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return $this->formatDailyData($dailyGains, $startDate, $endDate);
    }

    /**
     * Format daily data for Chart.js
     *
     * @param \Illuminate\Support\Collection $dailyGains
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return array
     */
    private function formatDailyData($dailyGains, Carbon $startDate, Carbon $endDate): array
    {
        $labels = [];
        $data = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $labels[] = $currentDate->format('d/m');

            $gain = $dailyGains->firstWhere('date', $dateStr);
            $data[] = $gain ? (float) $gain->total : 0;

            $currentDate->addDay();
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    /**
     * Get total gain from all services
     *
     * @return float
     */
    public function getTotalGain(): float
    {
        return (float) Service::sum('price');
    }

    /**
     * Get gain for a specific month and year
     *
     * @param int $month
     * @param int $year
     * @return float
     */
    public function getMonthGain(int $month, int $year): float
    {
        return (float) Service::whereYear('service_date', $year)
            ->whereMonth('service_date', $month)
            ->sum('price');
    }

    /**
     * Get current month gain
     *
     * @return float
     */
    public function getCurrentMonthGain(): float
    {
        return $this->getMonthGain(Carbon::now()->month, Carbon::now()->year);
    }
}
