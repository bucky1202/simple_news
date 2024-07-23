@extends('user.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 >Sign in</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
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
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="floatingInput" placeholder="username">
                <label for="floatingInput">Your username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <a href="{{ route('auth.register') }}">Doesn't have account yet? Register!</a>
            <p><a  href="{{ route('home') }}">Back to home page </a> </p>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('assets/custom.css') }}" rel="stylesheet">
@endpush
