@extends('layouts.auth')

@section('title','Verfiy Email')

@section('css')
    
@endsection

@section('content')
    <p class="login-box-msg">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="login-box-msg text-success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Resend Verification Email</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    {{-- <form method="POST" action="{{ route('logout') }}">
        @csrf

        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Log Out') }}</button>
            </div>
            <!-- /.col -->
        </div>

        
    </form> --}}
@endsection


@section('javascript')
    
@endsection
