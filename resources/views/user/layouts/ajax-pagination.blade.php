<div class="row">
    @foreach($news as $item)
        <li class="list-group-item">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/' . $item->image) }}" alt="News Image" class="rounded-start" style="width: 150px; height: 100px; object-fit: cover;">
                <div class="flex-fill ms-3">
                    <h5 class="card-title mb-2">{{ Str::limit($item->title, 50) }}</h5>
                    <p class="card-text mb-2">{{ Str::limit($item->description, 150) }}</p>
                    <a href="{{ route('news.show', $item->slug) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </li>
    @endforeach
    {{ $news->links() }}
</div>
