@extends('user.layouts.layout')
@include('user.layouts.header')


@section('content')
<div class="container mt-4">
    <div class="row">
      <div class="col-lg-8">
        <!-- Article content -->
        <article>
            <img src="{{ asset('/storage/'.$news_item->image) }}" height="400" width="800" class="img-fluid rounded mb-4" alt="Article Image">
            <h1 class="mb-4">{{ $news_item->title }}</h1>
            <span class="text-muted"> Author:{{ $news_item->author }}</span><hr>
            <p>{{ $news_item->description }}</p>
            <p class="lead" style="float: right !important">Published on: <span class="text-muted">{{ $news_item->created_at->formatLocalized('%d %B %Y') }}</span></p>
        </article>
      </div>
    </div>
</div>
@endsection
