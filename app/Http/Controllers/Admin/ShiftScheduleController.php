<?php

// app/Http/Controllers/Admin/ShiftScheduleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShiftSchedule;
use Illuminate\Http\Request;

class ShiftScheduleController extends Controller
{
    public function index()
    {
        $shiftSchedules = ShiftSchedule::all();
        return view('admins.shift-schedules.index', compact('shiftSchedules'));
    }

    public function create()
    {
        return view('admins.shift-schedules.create-shift-schedule');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => 'required',
            'start_shift_time' => 'required|date_format:H:i:s',
            'shift_start_grace_period' => 'nullable|date_format:H:i:s',
            'lunch_start_time' => 'required|date_format:H:i:s',
            'end_lunch_time' => 'required|date_format:H:i:s',
            'end_shift_time' => 'required|date_format:H:i:s',
            'shift_timezone' => 'required'
        ]);

        ShiftSchedule::create([
            'shift_name' => $request->get('shift_name'),
            'start_shift_time' => $request->get('start_shift_time'),
            'shift_start_grace_period' => $request->get('shift_start_grace_period'),
            'lunch_start_time' => $request->get('lunch_start_time'),
            'end_lunch_time' => $request->get('end_lunch_time'),
            'end_shift_time' => $request->get('end_shift_time'),
            'shift_timezone' => $request->get('shift_timezone'),
        ]);

        return redirect()->route('admins.shift-schedules.index')->with('success', 'Shift Schedule created successfully.');
    }

    public function show($id)
    {
        $shiftSchedule = ShiftSchedule::find($id);
        return view('admins.shift-schedules.read-shift-schedule', compact('shiftSchedule'));
    }

    public function edit($id)
    {
        $shiftSchedule = ShiftSchedule::find($id);
        return view('admins.shift-schedules.update-shift-schedule', compact('shiftSchedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shift_name' => 'required',
            'start_shift_time' => 'required|date_format:H:i:s',
            'shift_start_grace_period' => 'nullable|date_format:H:i:s',
            'lunch_start_time' => 'required|date_format:H:i:s',
            'end_lunch_time' => 'required|date_format:H:i:s',
            'end_shift_time' => 'required|date_format:H:i:s',
            'shift_timezone' => 'required'
        ]);

        $shiftSchedule = ShiftSchedule::find($id);
        $shiftSchedule->shift_name = $request->get('shift_name');
        $shiftSchedule->start_shift_time = $request->get('start_shift_time');
        $shiftSchedule->shift_start_grace_period = $request->get('shift_start_grace_period');
        $shiftSchedule->lunch_start_time = $request->get('lunch_start_time');
        $shiftSchedule->end_lunch_time = $request->get('end_lunch_time');
        $shiftSchedule->end_shift_time = $request->get('end_shift_time');
        $shiftSchedule->shift_timezone = $request->get('shift_timezone');
        $shiftSchedule->save();

        return redirect()->route('admins.shift-schedules.index')->with('success', 'Shift Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $shiftSchedule = ShiftSchedule::find($id);
        $shiftSchedule->delete();

        return redirect()->route('admins.shift-schedules.index')->with('success', 'Shift Schedule deleted successfully.');
    }
}