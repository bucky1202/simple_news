@extends('user.layouts.layout')
@include('user.layouts.header')
@include('user.layouts.footer')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($news as $item)
                <li class="list-group-item">
                    <div class="d-flex align-items-center">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="News Image" class="rounded-start" style="width: 150px; height: 100px; object-fit: cover;">
                        @else
                            <span class="rounded-start" style="width: 150px; height: 100px; object-fit: cover;">No Image</span>
                        @endif
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
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
     //pagination
    $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      let page = $(this).attr('href').split('page=')[1]
      record(page)
    })

    function record(page){
        $.ajax({
            url:"/ajax-paginate?page="+page,
            success:function(res){
                $('.row').html(res);
            }
        })
    }

</script>

@endsection
