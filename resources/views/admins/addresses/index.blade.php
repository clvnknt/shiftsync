<!-- resources/views/admins/addresses/index.blade.php -->

@extends('admins.admin-layouts.admin-app')

@section('title', 'Admin - Addresses')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Addresses</h2>
            <a href="{{ route('admins.addresses.create') }}" class="btn btn-primary btn-sm">Add Address</a>
        </div>

        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                    <tr>
                        <td>{{ $address->id }}</td>
                        <td>{{ $address->employee_street }}</td>
                        <td>{{ $address->employee_city }}</td>
                        <td>{{ $address->employee_country }}</td>
                        <td>{{ $address->employee_postal_code }}</td>
                        <td>{{ ucfirst($address->type) }}</td>
                        <td>
                            <a href="{{ route('admins.addresses.edit', $address->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.addresses.destroy', $address->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a href="{{ route('admins.addresses.show', $address->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection