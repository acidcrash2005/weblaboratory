@extends('layouts.app')

@section('content')
    <div class="b-content">
        <div class="b-container">
            <div class="b-news-full">
                <div class="b-wraper">
                    <h1>{{ $post->title }}</h1>
                    <div class="b-data">
                        <span class="b-date">{{ $post->created_at->format('j F Y') }}</span>
                        <span class="b-coment">25</span><span class="b-views">16</span><span class="b-like">3</span>
                    </div>
                    {!! $post->body !!}
                </div>
                <div class="b-comments">
                    <img src="{{ url('/') }}/images/comments.png" alt="">
                </div>
            </div>

        </div>
    </div>
@endsection
