@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Edit Shift Schedule')

@section('content')
    <div class="container mt-5">
        <h2>Edit Shift Schedule</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.shift-schedules.update', $shiftSchedule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="shift_name" class="form-label">Shift Name</label>
                <input id="shift_name" type="text" class="form-control" name="shift_name" value="{{ $shiftSchedule->shift_name }}" required>
            </div>

            <div class="mb-3">
                <label for="start_shift_time" class="form-label">Start Shift Time</label>
                <input id="start_shift_time" type="time" class="form-control" name="start_shift_time" value="{{ $shiftSchedule->start_shift_time }}" required>
            </div>

            <div class="mb-3">
                <label for="shift_start_grace_period" class="form-label">Shift Start Grace Period</label>
                <input id="shift_start_grace_period" type="time" class="form-control" name="shift_start_grace_period" value="{{ $shiftSchedule->shift_start_grace_period }}">
            </div>

            <div class="mb-3">
                <label for="lunch_start_time" class="form-label">Lunch Start Time</label>
                <input id="lunch_start_time" type="time" class="form-control" name="lunch_start_time" value="{{ $shiftSchedule->lunch_start_time }}" required>
            </div>

            <div class="mb-3">
                <label for="end_lunch_time" class="form-label">End Lunch Time</label>
                <input id="end_lunch_time" type="time" class="form-control" name="end_lunch_time" value="{{ $shiftSchedule->end_lunch_time }}" required>
            </div>

            <div class="mb-3">
                <label for="end_shift_time" class="form-label">End Shift Time</label>
                <input id="end_shift_time" type="time" class="form-control" name="end_shift_time" value="{{ $shiftSchedule->end_shift_time }}" required>
            </div>

            <div class="mb-3">
                <label for="shift_timezone" class="form-label">Timezone</label>
                <input id="shift_timezone" type="text" class="form-control" name="shift_timezone" value="{{ $shiftSchedule->shift_timezone }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Shift Schedule</button>
        </form>
    </div>
@endsection