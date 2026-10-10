<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $departments = Department::withCount('officers')
            ->when($search, function ($query, $search) {
                $query->where('department_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments', 'search'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create(): View
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        $department = Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', "Department '{$department->department_name}' created successfully.");
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')
            ->with('success', "Department '{$department->department_name}' updated successfully.");
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy(Department $department): RedirectResponse
    {
        $officerCount = $department->officers()->count();

        if ($officerCount > 0) {
            return redirect()->route('departments.index')
                ->with('error', "Cannot delete department '{$department->department_name}' because it has {$officerCount} assigned officer(s). Please reassign or remove them first.");
        }

        $departmentName = $department->department_name;
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', "Department '{$departmentName}' deleted successfully.");
    }
}
