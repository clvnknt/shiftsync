<!-- resources/views/admins/addresses/edit.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Edit Address')

@section('content')
    <div class="container mt-5">
        <h2>Edit Address</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.addresses.update', $address->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_street" class="form-label">Street</label>
                <input id="employee_street" type="text" class="form-control" name="employee_street" value="{{ $address->employee_street }}" required>
            </div>

            <div class="mb-3">
                <label for="employee_city" class="form-label">City</label>
                <input id="employee_city" type="text" class="form-control" name="employee_city" value="{{ $address->employee_city }}" required>
            </div>

            <div class="mb-3">
                <label for="employee_country" class="form-label">Country</label>
                <input id="employee_country" type="text" class="form-control" name="employee_country" value="{{ $address->employee_country }}" required>
            </div>

            <div class="mb-3">
                <label for="employee_postal_code" class="form-label">Postal Code</label>
                <input id="employee_postal_code" type="text" class="form-control" name="employee_postal_code" value="{{ $address->employee_postal_code }}" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select id="type" class="form-control" name="type" required>
                    <option value="primary" {{ $address->type == 'primary' ? 'selected' : '' }}>Primary</option>
                    <option value="temporary" {{ $address->type == 'temporary' ? 'selected' : '' }}>Temporary</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Address</button>
        </form>
    </div>
@endsection