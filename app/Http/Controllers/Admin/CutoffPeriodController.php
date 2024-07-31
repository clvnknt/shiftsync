<?php

// app/Http/Controllers/Admin/CutoffPeriodController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CutoffPeriod;
use Illuminate\Http\Request;

class CutoffPeriodController extends Controller
{
    public function index()
    {
        $cutoffPeriods = CutoffPeriod::all();
        return view('admins.cutoff-periods.index', compact('cutoffPeriods'));
    }

    public function create()
    {
        return view('admins.cutoff-periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'period' => 'required|string|max:255',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',
            'cutoff_timezone' => 'required|string|max:10',
        ]);

        CutoffPeriod::create($request->all());

        return redirect()->route('admins.cutoff-periods.index')->with('success', 'Cutoff Period created successfully.');
    }

    public function show($id)
    {
        $cutoffPeriod = CutoffPeriod::find($id);
        return view('admins.cutoff-periods.show', compact('cutoffPeriod'));
    }

    public function edit($id)
    {
        $cutoffPeriod = CutoffPeriod::find($id);
        return view('admins.cutoff-periods.edit', compact('cutoffPeriod'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'period' => 'required|string|max:255',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',
            'cutoff_timezone' => 'required|string|max:10',
        ]);

        $cutoffPeriod = CutoffPeriod::find($id);
        $cutoffPeriod->update($request->all());

        return redirect()->route('admins.cutoff-periods.index')->with('success', 'Cutoff Period updated successfully.');
    }

    public function destroy($id)
    {
        $cutoffPeriod = CutoffPeriod::find($id);
        $cutoffPeriod->delete();

        return redirect()->route('admins.cutoff-periods.index')->with('success', 'Cutoff Period deleted successfully.');
    }
}