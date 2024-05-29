@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Shift Schedule')

@section('content')
    <div class="container mt-5">
        <h2>View Shift Schedule</h2>

        <div class="mb-3">
            <label for="shift_name" class="form-label">Shift Name</label>
            <input id="shift_name" type="text" class="form-control" value="{{ $shiftSchedule->shift_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="start_shift_time" class="form-label">Start Shift Time</label>
            <input id="start_shift_time" type="time" class="form-control" value="{{ $shiftSchedule->start_shift_time }}" readonly>
        </div>

        <div class="mb-3">
            <label for="shift_start_grace_period" class="form-label">Shift Start Grace Period</label>
            <input id="shift_start_grace_period" type="time" class="form-control" value="{{ $shiftSchedule->shift_start_grace_period }}" readonly>
        </div>

        <div class="mb-3">
            <label for="lunch_start_time" class="form-label">Lunch Start Time</label>
            <input id="lunch_start_time" type="time" class="form-control" value="{{ $shiftSchedule->lunch_start_time }}" readonly>
        </div>

        <div class="mb-3">
            <label for="end_lunch_time" class="form-label">End Lunch Time</label>
            <input id="end_lunch_time" type="time" class="form-control" value="{{ $shiftSchedule->end_lunch_time }}" readonly>
        </div>

        <div class="mb-3">
            <label for="end_shift_time" class="form-label">End Shift Time</label>
            <input id="end_shift_time" type="time" class="form-control" value="{{ $shiftSchedule->end_shift_time }}" readonly>
        </div>

        <div class="mb-3">
            <label for="shift_timezone" class="form-label">Timezone</label>
            <input id="shift_timezone" type="text" class="form-control" value="{{ $shiftSchedule->shift_timezone }}" readonly>
        </div>

        <a href="{{ route('admins.shift-schedules.index') }}" class="btn btn-secondary">Back to Shift Schedules</a>
    </div>
@endsection