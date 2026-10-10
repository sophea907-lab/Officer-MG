<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficerRequest;
use App\Http\Requests\UpdateOfficerRequest;
use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfficerController extends Controller
{
    /**
     * Display a listing of the officers with search and filtering.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $departmentId = $request->query('department_id');
        $positionId = $request->query('position_id');
        $status = $request->query('status');

        $officers = Officer::with(['department', 'position'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('officer_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($departmentId, function ($query, $departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->when($positionId, function ($query, $positionId) {
                $query->where('position_id', $positionId);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy('department_name')->get();
        $positions = Position::orderBy('position_name')->get();

        return view('officers.index', compact(
            'officers',
            'departments',
            'positions',
            'search',
            'departmentId',
            'positionId',
            'status'
        ));
    }

    /**
     * Show the form for creating a new officer.
     */
    public function create(): View
    {
        $departments = Department::orderBy('department_name')->get();
        $positions = Position::orderBy('position_name')->get();

        return view('officers.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created officer in storage.
     */
    public function store(StoreOfficerRequest $request): RedirectResponse
    {
        $officer = Officer::create($request->validated());

        return redirect()->route('officers.index')
            ->with('success', "Officer '{$officer->officer_name}' created successfully.");
    }

    /**
     * Display the specified officer.
     */
    public function show(Officer $officer): View
    {
        $officer->load(['department', 'position']);

        return view('officers.show', compact('officer'));
    }

    /**
     * Show the form for editing the specified officer.
     */
    public function edit(Officer $officer): View
    {
        $departments = Department::orderBy('department_name')->get();
        $positions = Position::orderBy('position_name')->get();

        return view('officers.edit', compact('officer', 'departments', 'positions'));
    }

    /**
     * Update the specified officer in storage.
     */
    public function update(UpdateOfficerRequest $request, Officer $officer): RedirectResponse
    {
        $officer->update($request->validated());

        return redirect()->route('officers.index')
            ->with('success', "Officer '{$officer->officer_name}' updated successfully.");
    }

    /**
     * Remove the specified officer from storage.
     */
    public function destroy(Officer $officer): RedirectResponse
    {
        $name = $officer->officer_name;
        $officer->delete();

        return redirect()->route('officers.index')
            ->with('success', "Officer '{$name}' deleted successfully.");
    }
}
