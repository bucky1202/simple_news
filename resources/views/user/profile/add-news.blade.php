@extends('user.layouts.layout')
@include('user.layouts.header')
@section('content')
<div class="container">
    <div class="row">
        @include('user.profile.sidebar')
        <div class="col-md-9">
            <div class="card-header">Add News</div>
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
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.add_news') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" value="{{ old('title') }}" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" value="{{ old('description') }}" id="description" name="description" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Add News</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
