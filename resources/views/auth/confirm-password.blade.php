@extends('layouts.auth')

@section('title','Confirm Password')

@section('css')
    
@endsection

@section('content')
    <p class="login-box-msg">This is a secure area of the application. Please confirm your password to proceeed</p>

    <form action="{{ route('password.confirm') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Confirm</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
@endsection


@section('javascript')
    
@endsection
