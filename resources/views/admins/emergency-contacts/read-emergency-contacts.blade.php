<!-- resources/views/admins/emergency-contacts/show.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - View Emergency Contact')

@section('content')
    <div class="container mt-5">
        <h2>View Emergency Contact</h2>

        <div class="mb-3">
            <label for="contact_first_name" class="form-label">First Name</label>
            <input id="contact_first_name" type="text" class="form-control" value="{{ $emergencyContact->contact_first_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_last_name" class="form-label">Last Name</label>
            <input id="contact_last_name" type="text" class="form-control" value="{{ $emergencyContact->contact_last_name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_relationship" class="form-label">Relationship</label>
            <input id="contact_relationship" type="text" class="form-control" value="{{ $emergencyContact->contact_relationship }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_phone_number" class="form-label">Phone Number</label>
            <input id="contact_phone_number" type="text" class="form-control" value="{{ $emergencyContact->contact_phone_number }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_street" class="form-label">Street</label>
            <input id="contact_street" type="text" class="form-control" value="{{ $emergencyContact->contact_street }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_city" class="form-label">City</label>
            <input id="contact_city" type="text" class="form-control" value="{{ $emergencyContact->contact_city }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_country" class="form-label">Country</label>
            <input id="contact_country" type="text" class="form-control" value="{{ $emergencyContact->contact_country }}" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_postal_code" class="form-label">Postal Code</label>
            <input id="contact_postal_code" type="text" class="form-control" value="{{ $emergencyContact->contact_postal_code }}" readonly>
        </div>

        <a href="{{ route('admins.emergency-contacts.index') }}" class="btn btn-secondary">Back to Emergency Contacts</a>
    </div>
@endsection