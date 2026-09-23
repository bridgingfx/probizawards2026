@extends('dashboard.layouts.master')

@section('title', __('backend.dashboard'))

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>{{ __('backend.dashboard') }}</h2>
            </div>
            <div class="box-body">
                <p class="text-muted m-b-0">{{ __('backend.welcome') }}</p>
            </div>
        </div>
    </div>
@endsection
