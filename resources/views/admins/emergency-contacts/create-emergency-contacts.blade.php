<!-- resources/views/admins/emergency-contacts/create.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Create Emergency Contact')

@section('content')
    <div class="container mt-5">
        <h2>Create Emergency Contact</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.emergency-contacts.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="contact_first_name" class="form-label">First Name</label>
                <input id="contact_first_name" type="text" class="form-control" name="contact_first_name" required>
            </div>

            <div class="mb-3">
                <label for="contact_last_name" class="form-label">Last Name</label>
                <input id="contact_last_name" type="text" class="form-control" name="contact_last_name" required>
            </div>

            <div class="mb-3">
                <label for="contact_relationship" class="form-label">Relationship</label>
                <input id="contact_relationship" type="text" class="form-control" name="contact_relationship" required>
            </div>

            <div class="mb-3">
                <label for="contact_phone_number" class="form-label">Phone Number</label>
                <input id="contact_phone_number" type="text" class="form-control" name="contact_phone_number" required>
            </div>

            <div class="mb-3">
                <label for="contact_street" class="form-label">Street</label>
                <input id="contact_street" type="text" class="form-control" name="contact_street" required>
            </div>

            <div class="mb-3">
                <label for="contact_city" class="form-label">City</label>
                <input id="contact_city" type="text" class="form-control" name="contact_city" required>
            </div>

            <div class="mb-3">
                <label for="contact_country" class="form-label">Country</label>
                <input id="contact_country" type="text" class="form-control" name="contact_country" required>
            </div>

            <div class="mb-3">
                <label for="contact_postal_code" class="form-label">Postal Code</label>
                <input id="contact_postal_code" type="text" class="form-control" name="contact_postal_code" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Emergency Contact</button>
        </form>
    </div>
@endsection