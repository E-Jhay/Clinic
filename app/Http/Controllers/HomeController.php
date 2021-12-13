<?php

namespace App\Http\Controllers;

use App\Models\HealthProfile;
use App\Models\Patient;
use App\Models\ReleasedMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $patient = Patient::groupBy('name')
                ->groupBy('designation_id')
                ->groupBy('course_id')
                ->whereMonth('created_at', now()->month)
                ->get()->count();
        
        $medicinesGiven = ReleasedMedicine::whereMonth('created_at', now()->month)
                ->count();
        $mostlyAdmitted = Patient::with('designation')
                        ->select([
                            'designation_id',
                            // DB::raw("DATE_FORMAT(created_at, '%m') as month"),
                            DB::raw('COUNT(id) as patientsCount'),
                        ])
                        ->whereMonth('created_at', now()->month)
                        ->groupBy('designation_id')
                        ->orderBy('patientsCount', 'desc')->get()->toArray();
                        
        $profiles = HealthProfile::count();
        return view('dashboard', compact('patient', 'medicinesGiven', 'mostlyAdmitted', 'profiles'));
    }
}
