@extends('layouts.app')

@section('title', 'Timesheet - StaffCentral')

@section('content')
    <div class="container mt-4 mb-5">
        <!-- Header: Timesheet -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Timesheet</h2>
            </div>
        </div>
        
        <!-- Legend and View Records Format -->
        <div class="row mb-2-adjusted">
            <div class="col-md-6 d-flex mb-2">
                <div class="card flex-fill mx-1 legend-view-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <img src="{{ asset('media/images/icons/timesheet/legend.png') }}" alt="Legend Icon" class="img-fluid" style="width: 50px; height: 50px;">
                            Legend
                        </h5>
                        <!-- Legend Items -->
                        <div class="row">
                            <div class="col-md-6">
                                <p>SS - Shift Started</p>
                                <p>LS - Lunch Started</p>
                                <p>LE - Lunch Ended</p>
                                <p>SE - Shift Ended</p>
                            </div>
                            <div class="col-md-6">
                                <p>HR - Hours Rendered</p>
                                <p>UT - Undertime</p>
                                <p>OT - Overtime</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 d-flex mb-2">
                <div class="card flex-fill mx-1 legend-view-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <img src="{{ asset('media/images/icons/timesheet/view-format.png') }}" alt="Choose View Format Icon" class="img-fluid" style="width: 50px; height: 50px;">
                            View Records Format
                        </h5>

                        <!-- Shift Name Dropdown -->
                        <div id="shiftNameDropdownContainer" class="mt-3">
                            <label for="shiftNameSelect">Select Shift Name:</label>
                            <select id="shiftNameSelect" class="form-control">
                                <option value="">-</option>
                                <!-- Populate shift names -->
                                @foreach($shiftNames as $id => $shiftName)
                                    <option value="{{ $id }}">{{ $shiftName }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Dropdown for view format -->
                        <div id="viewFormatContainer" class="mt-3">
                            <label for="viewFormatSelect">Select Format:</label>
                            <select id="viewFormatSelect" class="form-control">
                                <option value="">-</option>
                                <option value="cutoff">Cutoff Period</option>
                                <option value="range">Date Range</option>
                            </select>
                        </div>
                        
                        <!-- Container for cutoff period dropdown -->
                       <!-- Container for cutoff period dropdown -->
<div id="cutoffContainer" class="mt-3">
    <label for="cutoffSelect">Select Cutoff Period:</label>
    <select id="cutoffSelect" class="form-control">
        <option value="">-</option>
        <!-- Populate assigned cutoff periods -->
        @foreach($employeeRecord->assignedCutoffPeriods as $assignedCutoffPeriod)
            <option value="{{ $assignedCutoffPeriod->cutoff_period_id }}">{{ $assignedCutoffPeriod->cutoffPeriod->period }}</option>
        @endforeach
    </select>
</div>

                        
                        <!-- Container for date range input fields -->
                        <div id="dateRangeContainer" class="mt-3" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Buttons for Cutoff Period view -->
                        <div id="cutoffButtons" class="mt-3" style="display: none;">
                            <button id="viewButton" type="button" class="btn btn-success">View</button>
                        </div>
                        
                        <!-- Icons for Date Range view -->
                        <div id="rangeIcons" class="mt-3" style="display: none;">
                            <button type="button" class="btn btn-success" onclick="fetchRecords()">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Records -->
        <div class="row records-summary-spacing ">
            <div class="col-md-12">
                <div class="card mx-1">
                    <div class="card-body">
                        <h4 class="mb-3">
                            <img src="{{ asset('media/images/icons/timesheet/records.png') }}" alt="Records Icon" class="img-fluid" style="width: 50px; height: 50px;">
                            Records
                        </h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shift Name</th>
                                    <th>Shift Schedule</th>
                                    <th>SS</th>
                                    <th>LS</th>
                                    <th>LE</th>
                                    <th>SE</th>
                                    <th>HR</th>
                                    <th>Late (SS)</th>
                                    <th>Late (EL)</th>
                                    <th>OT</th>
                                </tr>
                            </thead>
                            <tbody id="recordsTableBody">
                                <!-- Records table data -->
                                @if($records)
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{ $record->shift_date }}</td>
                                            <td>{{ $record->shiftName }}</td>
                                            <td>{{ $record->shiftSchedule }}</td>
                                            <td>{{ $record->start_shift }}</td>
                                            <td>{{ $record->start_lunch }}</td>
                                            <td>{{ $record->end_lunch }}</td>
                                            <td>{{ $record->end_shift }}</td>
                                            <td>{{ $record->hours_rendered }}</td>
                                            <td>{{ $record->tardiness->hours_late_start_shift?? '-' }}</td>
                                            <td>{{ $record->tardiness->hours_late_end_lunch?? '-' }}</td>
                                            <td>{{ $record->overtime_hours }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="row records-summary-spacing">
            <div class="col-md-12">
                <div class="card mx-1">
                    <div class="card-body">
                        <h4 class="mb-3">
                            <img src="{{ asset('media/images/icons/timesheet/summary.png') }}" alt="Summary Icon" class="img-fluid" style="width: 50px; height: 50px;">
                            Summary
                        </h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Summary table data -->
                                <tr>
                                    <td>Total Worked Hours (Regular):</td>
                                    <td id="totalWorkedHours">0 Hour/s</td>
                                </tr>
                                <tr>
                                    <td>Tardiness/Undertime:</td>
                                    <td id="totalTardinessHours">0 Hour/s</td>
                                </tr>
                                <tr>
                                    <td>Overtime:</td>
                                    <td id="totalOvertimeHours">0 Hour/s</td>
                                </tr>                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
       .card {
            border: none;
            border-radius: 20px;
        }

       .card-body {
            border-radius: 20px;
        }

       .mx-1 {
            margin-left: 0.5rem!important;
            margin-right: 0.5rem!important;
        }

       .mb-2-adjusted {
            margin-bottom: 1.5rem!important; /* Adjusted margin-bottom for the "View Records" and "View Format" sections */
        }

       .records-summary-spacing {
            margin-bottom: 2rem!important; /* Ensure equal spacing between "Records" and "Summary" */
        }

       .legend-view-card {
            min-height: 400px; /* Adjust this value as needed */
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('js/timesheet.js') }}"></script>
@endsection
