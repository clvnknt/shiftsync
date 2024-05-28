<!-- resources/views/admins/shift-schedules/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Shift Schedules')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Shift Schedules</h2>
            <a href="{{ route('admins.shift-schedules.create') }}" class="btn btn-primary btn-sm">Add Shift Schedule</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Start Shift</th>
                    <th>Grace Period</th>
                    <th>Lunch Start</th>
                    <th>End Lunch</th>
                    <th>End Shift</th>
                    <th>Timezone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shiftSchedules as $shiftSchedule)
                    <tr>
                        <td>{{ $shiftSchedule->id }}</td>
                        <td>{{ $shiftSchedule->shift_name }}</td>
                        <td>{{ $shiftSchedule->start_shift_time }}</td>
                        <td>{{ $shiftSchedule->shift_start_grace_period }}</td>
                        <td>{{ $shiftSchedule->lunch_start_time }}</td>
                        <td>{{ $shiftSchedule->end_lunch_time }}</td>
                        <td>{{ $shiftSchedule->end_shift_time }}</td>
                        <td>{{ $shiftSchedule->shift_timezone }}</td>
                        <td>
                            <a href="{{ route('admins.shift-schedules.edit', $shiftSchedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.shift-schedules.destroy', $shiftSchedule->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.shift-schedules.show', $shiftSchedule->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection