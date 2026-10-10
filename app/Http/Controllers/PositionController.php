<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    /**
     * Display a listing of the positions.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $positions = Position::withCount('officers')
            ->when($search, function ($query, $search) {
                $query->where('position_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('positions.index', compact('positions', 'search'));
    }

    /**
     * Show the form for creating a new position.
     */
    public function create(): View
    {
        return view('positions.create');
    }

    /**
     * Store a newly created position in storage.
     */
    public function store(StorePositionRequest $request): RedirectResponse
    {
        $position = Position::create($request->validated());

        return redirect()->route('positions.index')
            ->with('success', "Position '{$position->position_name}' created successfully.");
    }

    /**
     * Show the form for editing the specified position.
     */
    public function edit(Position $position): View
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified position in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position): RedirectResponse
    {
        $position->update($request->validated());

        return redirect()->route('positions.index')
            ->with('success', "Position '{$position->position_name}' updated successfully.");
    }

    /**
     * Remove the specified position from storage.
     */
    public function destroy(Position $position): RedirectResponse
    {
        $officerCount = $position->officers()->count();

        if ($officerCount > 0) {
            return redirect()->route('positions.index')
                ->with('error', "Cannot delete position '{$position->position_name}' because it has {$officerCount} assigned officer(s). Please reassign or remove them first.");
        }

        $positionName = $position->position_name;
        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', "Position '{$positionName}' deleted successfully.");
    }
}
