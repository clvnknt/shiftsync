<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeShiftRecord;

class ShiftController extends Controller
{
    public function startShift(Request $request)
    {
        return $this->handleShiftAction($request, 'start_shift');
    }

    public function startLunch(Request $request)
    {
        return $this->handleShiftAction($request, 'start_lunch');
    }

    public function endLunch(Request $request)
    {
        return $this->handleShiftAction($request, 'end_lunch');
    }

    public function endShift(Request $request)
    {
        return $this->handleShiftAction($request, 'end_shift');
    }

    protected function handleShiftAction(Request $request, $action)
    {
        $shiftRecordId = $request->input('employeeRecordId');
        $shiftRecord = EmployeeShiftRecord::find($shiftRecordId);

        if (!$shiftRecord) {
            return redirect()->route('inout')->with('error', 'Shift record not found.');
        }

        switch ($action) {
            case 'start_shift':
                if (!$shiftRecord->start_shift) {
                    $shiftRecord->start_shift = now();
                    $shiftRecord->save();
                }
                break;
            case 'start_lunch':
                if ($shiftRecord->start_shift && !$shiftRecord->start_lunch) {
                    $shiftRecord->start_lunch = now();
                    $shiftRecord->save();
                }
                break;
            case 'end_lunch':
                if ($shiftRecord->start_lunch && !$shiftRecord->end_lunch) {
                    $shiftRecord->end_lunch = now();
                    $shiftRecord->save();
                }
                break;
            case 'end_shift':
                if ($shiftRecord->start_shift && $shiftRecord->start_lunch && $shiftRecord->end_lunch && !$shiftRecord->end_shift) {
                    $shiftRecord->end_shift = now();
                    $shiftRecord->save();
                }
                break;
            default:
                return redirect()->route('inout')->with('error', 'Invalid action.');
        }

        return redirect()->route('inout')->with('success', ucfirst(str_replace('_', ' ', $action)) . ' logged successfully.');
    }
}