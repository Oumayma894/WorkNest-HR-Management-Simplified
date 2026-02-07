<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
     public function index()
    {
        $holidays = Holiday::all();
        return view('admin.holiday-list', compact('holidays'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'date' => 'required|date',
        ]);

          $validated['admin_id'] = Auth::guard('admin')->id(); 
        $holiday = Holiday::create($validated);

        return response()->json($holiday, 201);
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string',
        'date' => 'required|date',
    ]);

    $holiday = Holiday::findOrFail($id);
    $holiday->update($validated);

    return response()->json(['message' => 'Holiday updated successfully']);
}

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
