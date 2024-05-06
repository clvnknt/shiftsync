@extends('layouts.app')

@section('title', 'Email Verified')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email Verified') }}</div>

                <div class="card-body">
                    <p>{{ __('Your email address has been successfully verified.') }}</p>
                    <p>{{ __('You can now continue to use our services.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
