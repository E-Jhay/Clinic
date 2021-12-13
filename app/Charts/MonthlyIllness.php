<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Patient;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlyIllness extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $query = Patient::select([
                    'diagnosis',
                    // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
                    DB::raw('COUNT(id) as diagnosisCount'),
                ])
                ->whereMonth('created_at', now()->month)
                ->groupBy('diagnosis')
                ->orderBy('diagnosis')
                ->get();
        $illnesses = [];
        $query->each(function ($item) use (&$illnesses){
            $illnesses[] = $item->diagnosis;
        });
        $illnessesCount = [];
        $query->each(function ($item) use (&$illnessesCount){
            $illnessesCount[] = $item->diagnosisCount;
        });

        return Chartisan::build()
            ->labels($illnesses)
            ->dataset('Illnesses This Month', $illnessesCount);
    }
}