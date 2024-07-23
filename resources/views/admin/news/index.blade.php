@extends('user.layouts.layout')
@include('admin.header')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">News Articles</div>

                <div class="card-body">
                    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Create News</a>

                    @if (session('success'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{  Str::limit($item->title, 50) }} </td>
                                    <td>{{  Str::limit($item->description, 100) }}</td>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Image" style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{ $news->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
