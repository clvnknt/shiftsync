<!-- resources/views/admins/emergency-contacts/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Emergency Contacts')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Emergency Contacts</h2>
            <a href="{{ route('admins.emergency-contacts.create') }}" class="btn btn-primary btn-sm">Add Emergency Contact</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Relationship</th>
                    <th>Phone Number</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emergencyContacts as $emergencyContact)
                    <tr>
                        <td>{{ $emergencyContact->id }}</td>
                        <td>{{ $emergencyContact->contact_first_name }}</td>
                        <td>{{ $emergencyContact->contact_last_name }}</td>
                        <td>{{ $emergencyContact->contact_relationship }}</td>
                        <td>{{ $emergencyContact->contact_phone_number }}</td>
                        <td>{{ $emergencyContact->contact_street }}</td>
                        <td>{{ $emergencyContact->contact_city }}</td>
                        <td>{{ $emergencyContact->contact_country }}</td>
                        <td>{{ $emergencyContact->contact_postal_code }}</td>
                        <td>
                            <a href="{{ route('admins.emergency-contacts.edit', $emergencyContact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.emergency-contacts.destroy', $emergencyContact->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.emergency-contacts.show', $emergencyContact->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection