@extends('layouts.app')

@section('title', 'Update Profile')

@section('content_header')
    <h1>Edit Profile</h1>
@stop

@section('content')

    @php
        $pageTitle = 'Update Profile';
        $breadcrumbs = [['text' => 'Home', 'url' => route('dashboard')], ['text' => 'Update Profile']];
    @endphp

    <x-page-layout :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile Information</h3>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>

                            @if ($user->profile_picture)
                                <div class="form-group">
                                    <label>Current Profile</label>
                                    <img src="{{asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="New password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-page-layout>
@stop
