@extends('user.layouts.layout')
@include('admin.header')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Editors</div>

                <div class="card-body">
                    <a href="{{ route('editors.create') }}" class="btn btn-primary float-end mb-3">Create Editor</a>

                    @if (session('success'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($editors as $editor)
                                <tr>
                                    <td>{{ $editor->username }}</td>
                                    <td>{{ $editor->role->name }}</td>
                                    <td>{{ $editor->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('editors.edit', $editor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('editors.destroy', $editor->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{ $editor->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
