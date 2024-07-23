@extends('user.layouts.layout')
@include('user.layouts.header')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Welcome to your profile, {{ Auth::user()->username }}</h1>
            @include('user.profile.sidebar')

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">My News</div>
                        <div class="card-body">
                            @if ($my_news->isEmpty())
                                <p>You haven't added any news yet.</p>
                            @else
                                <div class="list-group">
                                    @foreach ($my_news as $item)
                                        <a href="/news/{{ $item->slug }}" class="list-group-item list-group-item-action">
                                            <h5 class="mb-1">{{ $item->title }}</h5>
                                            <p class="mb-1">{{ $item->description }}</p>
                                            <small>Author: {{ $item->author }}</small>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
