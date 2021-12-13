<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Patient;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopComplaints extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $query = Patient::select([
                    'complaints',
                    // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
                    DB::raw('COUNT(id) as complaintsCount'),
                ])
                ->whereMonth('created_at', now()->month)
                ->groupBy('complaints')
                ->orderBy('complaintsCount', 'desc')
                ->take(5)
                ->get();
        $complaints = [];
        $complaintsCount = [];
        $query->each(function ($item) use (&$complaints, &$complaintsCount){
            $complaints[] = $item->complaints;
            $complaintsCount[] = $item->complaintsCount;
        });
        return Chartisan::build()
            ->labels($complaints)
            ->dataset('Top 5 complaints this month', $complaintsCount);
    }
}