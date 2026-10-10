<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics and recent activity.
     */
    public function index(): View
    {
        $totalOfficers = Officer::count();
        $totalDepartments = Department::count();
        $totalPositions = Position::count();

        $activeOfficers = Officer::where('status', 'Active')->count();
        $inactiveOfficers = Officer::where('status', 'Inactive')->count();
        $resignedOfficers = Officer::where('status', 'Resigned')->count();

        // Recent officers with eager loading
        $recentOfficers = Officer::with(['department', 'position'])
            ->latest()
            ->take(6)
            ->get();

        // Department breakdown
        $departmentsSummary = Department::withCount('officers')
            ->orderByDesc('officers_count')
            ->take(6)
            ->get();

        // Position breakdown
        $positionsSummary = Position::withCount('officers')
            ->orderByDesc('officers_count')
            ->take(6)
            ->get();

        return view('dashboard', compact(
            'totalOfficers',
            'totalDepartments',
            'totalPositions',
            'activeOfficers',
            'inactiveOfficers',
            'resignedOfficers',
            'recentOfficers',
            'departmentsSummary',
            'positionsSummary'
        ));
    }
}
