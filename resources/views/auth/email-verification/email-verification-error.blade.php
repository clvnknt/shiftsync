@extends('layouts.app')

@section('title', 'Email Verification Error')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email Verification Error') }}</div>

                <div class="card-body">
                    <p>{{ __('There was an error verifying your email address.') }}</p>
                    <p>{{ __('Please make sure you have the correct verification link.') }}</p>
                    <p>{{ __('If you continue to experience issues, please contact support.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
