@extends('layouts.user')

@section('content')
    <div class="inner-container__main">
        <header class="inner-container__header"><h2 class="inner-container__main-title">
                <a href="{{ url('/vebinars') }}"><i class="fa fa-arrow-circle-o-left"
                                                                               aria-hidden="true"></i></a>{{ $post->title }}
            </h2></header>

        <div class="inner-container__main-container">
            <div class="lessone__video">


                @if($post->acess != 2)
                    <iframe width="100%" height="500"
                            src="https://www.youtube.com/embed/{{ $post->video }}?rel=0&amp;showinfo=0" frameborder="0"
                            allowfullscreen></iframe>
                @else
                    <iframe width="100%" height="500"
                            src="https://www.youtube.com/embed/{{ $post->video }}?rel=0&amp;showinfo=0;autoplay=1" frameborder="0"
                            allowfullscreen></iframe>
                @endif


            </div>


        @if($post->acess != 2)
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#text" aria-controls="text" role="tab" data-toggle="tab">Заметки к трансляции</a></li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="text" class="lessone__content tab-pane active">
                        <div class="lessone__text">
                            {!!  $post->text !!}
                        </div>
                    </div>
                </div>
        @else
                {!! \Voyager::setting('comments') !!}
        @endif

        </div>

    </div>
@endsection

