@extends('user.layouts.layout')
@include('user.layouts.header')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.profile.sidebar')
            <div class="col-md-9">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Change Password</div>

                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('profile.change_password') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input id="current_password" type="password" class="form-control" name="current_password">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
