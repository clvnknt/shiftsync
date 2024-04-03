@extends('layouts.app')

@section('title', 'Company In/Out System')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h1 class="text-center">Welcome to StaffCentral</h1>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Our system simplifies employee attendance tracking, making it easier for you to manage your workforce.</p>
                        <div class="d-grid gap-2 col-md-6 mx-auto">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
