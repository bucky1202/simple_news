@extends('user.layouts.layout')
@include('editor.header')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit News</div>

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
                    <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $news->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="current_image" class="form-label">Current Image</label><br>
                            @if ($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" alt="Current Image" style="max-width: 200px;">
                            @else
                                No Image
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">New Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Update News</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
