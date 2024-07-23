@extends('user.layouts.layout')
@include('admin.header')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Admin users</div>

                <div class="card-body">
                    <a href="{{ route('admins.create') }}" class="btn btn-primary float-end mb-3">Create admin users</a>

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
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->role->name }}</td>
                                    <td>{{ $admin->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- {{ $admins->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
