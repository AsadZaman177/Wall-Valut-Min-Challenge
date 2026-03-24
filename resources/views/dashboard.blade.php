@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @php
        $pageTitle = 'Dashboard';
        $breadcrumbs = [
            ['text' => 'Home', 'url' => route('dashboard')],
        ];
    @endphp

    <x-page-layout :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs">
            <div class="row">
                <div class="col-md-12">
                    <h3>Welcome, {{ auth()->user()->name }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $data['users'] }}</h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $data['clients'] }}</h3>

                            <p>Clients</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $data['service_logs'] }}</h3>

                            <p>Service Logs</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $data['audit_logs'] }}</h3>

                            <p>Audit Logs</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

    </x-page-layout>

@endsection

