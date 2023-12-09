@extends(theme('dashboard.layout'))

@section('content')

    @php
    $reviews = $auth_user->reviews()->with('course')->orderBy('created_at', 'desc')->get();
    @endphp

    @if($reviews->count())
        @foreach($reviews as $review)
            <div class="my-review p-4 mb-3 bg-white border rounded">
                <a href="{{route('review', $review->id)}}" class="text-muted mb-3 d-block" >{{$review->created_at->diffForHumans()}}</a>

                <a href="{{route('course', $review->course->id)}}" class="mb-3 d-block">{{$review->course->title}}</a>

                {!! star_rating_generator($review->rating) !!}

                @if($review->review)
                    <div class="review-desc mt-3">
                        {!! nl2br($review->review) !!}
                    </div>
                @endif
            </div>
        @endforeach
    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-5' ) !!}
    @endif

@endsection
