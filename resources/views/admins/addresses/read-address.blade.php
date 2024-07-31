<!-- resources/views/admins/addresses/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Address')

@section('content')
    <div class="container mt-5">
        <h2>View Address</h2>

        <div class="mb-3">
            <label for="employee_street" class="form-label">Street</label>
            <input id="employee_street" type="text" class="form-control" value="{{ $address->employee_street }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_city" class="form-label">City</label>
            <input id="employee_city" type="text" class="form-control" value="{{ $address->employee_city }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_country" class="form-label">Country</label>
            <input id="employee_country" type="text" class="form-control" value="{{ $address->employee_country }}" readonly>
        </div>

        <div class="mb-3">
            <label for="employee_postal_code" class="form-label">Postal Code</label>
            <input id="employee_postal_code" type="text" class="form-control" value="{{ $address->employee_postal_code }}" readonly>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input id="type" type="text" class="form-control" value="{{ ucfirst($address->type) }}" readonly>
        </div>

        <a href="{{ route('admins.addresses.index') }}" class="btn btn-secondary">Back to Addresses</a>
    </div>
@endsection