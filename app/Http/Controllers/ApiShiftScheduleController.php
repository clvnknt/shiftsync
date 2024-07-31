<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShiftSchedule;

class ApiShiftScheduleController extends Controller
{
    public function index()
    {
        $shiftSchedules = ShiftSchedule::all();
        return response()->json($shiftSchedules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_shift_time' => 'required|date_format:H:i:s',
            'shift_start_grace_period' => 'nullable|date_format:H:i:s',
            'lunch_start_time' => 'required|date_format:H:i:s',
            'end_lunch_time' => 'required|date_format:H:i:s',
            'end_shift_time' => 'required|date_format:H:i:s',
            'shift_timezone' => 'required|string|max:6',
        ]);

        $shiftSchedule = ShiftSchedule::create($request->all());
        return response()->json($shiftSchedule, 201);
    }

    public function show($id)
    {
        $shiftSchedule = ShiftSchedule::findOrFail($id);
        return response()->json($shiftSchedule);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_shift_time' => 'required|date_format:H:i:s',
            'shift_start_grace_period' => 'nullable|date_format:H:i:s',
            'lunch_start_time' => 'required|date_format:H:i:s',
            'end_lunch_time' => 'required|date_format:H:i:s',
            'end_shift_time' => 'required|date_format:H:i:s',
            'shift_timezone' => 'required|string|max:6',
        ]);

        $shiftSchedule = ShiftSchedule::findOrFail($id);
        $shiftSchedule->update($request->all());
        return response()->json($shiftSchedule);
    }

    public function destroy($id)
    {
        $shiftSchedule = ShiftSchedule::findOrFail($id);
        $shiftSchedule->delete();
        return response()->json(null, 204);
    }
}