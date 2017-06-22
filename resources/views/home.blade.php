@extends('layouts.app')




@section('content')
    <div class="b-container">
        <div class="b-events">

        @foreach ($posts as $post)
            <div class="b-event">
                <div class="b-wraper">
                    <div class="b-img"><a href="{{ url('/posts') }}/{{$post->slug}}"><img src="/img/{{ $post->image }}?w=400" alt="{{ $post->title }}"/></a></div>
                    <div class="b-title"><a href="{{ url('/posts') }}/{{$post->slug}}">{{ $post->title }}</a></div>
                    <div class="b-text">
                        <p>{{ $post->excerpt }}</p>
                    </div>
                    <div class="b-type">
                        @if ($post->category_id == 1)
                            <span class="b-blog">{{ $post->category->name }}</span><span class="b-date">{{ $post->created_at->format('j F Y') }}</span>
                        @else
                            <span class="b-curse">{{ $post->category->name }}</span>
                        @endif


                    </div>
                    <div class="b-data">
                        <span class="b-coment">25</span><span class="b-views">16</span><span class="b-like">3</span>
                    </div>
                </div>
            </div>
        @endforeach


{{--
        <div class="b-event b-main">
            <div class="b-wraper">
                <div class="b-img"><a href="#"><img src="images/img1.png" alt=""/></a></div>
                <div class="b-title"><a href="#">День программиста, поздравляем!</a></div>
                <div class="b-text">
                    <p>Друзья! Наконец-то настал тот день! Мы с поздравляем вас с этим замечательным праздником. А так же с большой радостью и гордостью представляем наш новый конкурс для IT-шников!
                        Учавствуйте! Выигравайте призы, получайте опыт!</p>
                </div>
                <div class="b-type">
                    <span class="b-blog">Блог</span><span class="b-date">13 сентября</span>
                </div>
                <div class="b-data">
                    <span class="b-coment">25</span><span class="b-views">16</span><span class="b-like">3</span>
                </div>
            </div>
        </div>

        --}}
    </div>
    </div>
@endsection
