@extends('user.layouts.layout')
@section('content')
<div class="card">
    <div class="card-header text-center">
        <h3>Register</h3>

    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('register.post') }}" autocomplete="off">
        @csrf
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="form-floating mb-3">
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="floatingInput" placeholder="Username" >
            <label for="floatingInput">Your username</label>
            <div class="invalid-feedback">
                Please enter your username.
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" >
            <label for="floatingPassword">Password</label>
            <div class="invalid-feedback">
                Please enter your password.
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password_confirmation" class="form-control" id="floatingPassword" placeholder="Password" >
            <label for="floatingPassword">Confirm the password</label>
            <div class="invalid-feedback">
                Please confirm your password.
            </div>
        </div>
        <span><a  href="{{ route('auth.login') }}">Already have an account!? Log in!</a></span>
        <p><a  href="{{ route('home') }}">Back to home page </a> </p>

        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>
@endsection
@push('styles')
    <link href="{{ asset('assets/custom.css') }}" rel="stylesheet">
@endpush
