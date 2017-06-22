@extends('layouts.user')

@section('content')
    <div class="inner-container__main">
        <header class="inner-container__header"><h2 class="inner-container__main-title"
                                                    style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">
                <a href="{{ url('/courses') }}/{{ $course->slug }}"><i class="fa fa-arrow-circle-o-left"
                                                                               aria-hidden="true"></i></a> {{ $lessone->title }}
            </h2></header>
        <div class="lesson__navigation-lessone">
            <style>
                .lesson__navigation-lessone .active_menu{
                    background-color: {{ $course->color }};
                    color: @if ($course->text_color == 0) #000 @else #fff @endif;
                }
            </style>
            @foreach($lessons as $indexKey => $lesson)
                @if($lesson->acess != 0)
                    <a href="{{ url('/courses') }}/{{ $course->slug }}/{{$lesson->id}}" class="{{ Request::segment(3) == $lesson->id ? 'active_menu' : null }}">Урок {{$indexKey + 1}}</a>
                @endif
            @endforeach
        </div>
        <div class="inner-container__main-container">
            <div class="lessone__video">

                @if($lessone->acess != 2)
                    @foreach($lessone->video as $video)
                        <iframe width="100%" height="500"
                                src="https://www.youtube.com/embed/{{ $video }}?rel=0&amp;showinfo=0" frameborder="0"
                                allowfullscreen></iframe>
                    @endforeach
                @else
                    @foreach($lessone->video as $video)
                        <iframe width="100%" height="500"
                                src="https://www.youtube.com/embed/{{ $video }}?rel=0&amp;showinfo=0;autoplay=1" frameborder="0"
                                allowfullscreen></iframe>
                    @endforeach
                @endif

            </div>
            <div class="lessone__nav">
                <a href="{{ url('/courses') }}/{{ $course->slug }}/{{$previous}}"><i class="fa fa-chevron-left"
                                                                                             aria-hidden="true"></i></a>
                <a href="{{ url('/courses') }}/{{ $course->slug }}/{{$next}}"><i class="fa fa-chevron-right"
                                                                                         aria-hidden="true"></i></a>
            </div>

            @if($lessone->acess != 2)
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#text" aria-controls="text" role="tab" data-toggle="tab">Заметки для урока</a></li>
                    <li role="presentation"><a href="#dz" aria-controls="dz" role="tab" data-toggle="tab">Домашнее задание @if (count($dialog_new) != 0)
                                <span class="label-mail label label-primary"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ count($dialog_new) }}</span>@endif</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="text" class="lessone__content tab-pane active">
                        <div class="lessone__text">
                            {!!  $lessone->text !!}
                        </div>
                    </div>
                    <div id="dz" class="lessone__dz tab-pane">

                        <div class="lessone__dz-text" id="dalog">
                            {!! $lessone->homework !!}
                            {!! $lessone->tests !!}
                        </div>

                        @if(Auth::user()->isBase() && $lessone->acess != 3 || $course->nopay != 1)
                            <form id="homework" class="homework-form" action="{{ url('/dz_post') }}#dz" method="POST"
                                  enctype="multipart/form-data">
                                <h2 class="homework-form__title">Отправить домашнее задание</h2>

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <textarea name="text" class="form-control" placeholder="Текст сообщения"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="link" placeholder="Ссылка на архив файла GitHub, BitBucket или Dropbox"
                                           aria-describedby="helpBlock2">
                                    <span id="helpBlock2" class="help-block">Если вы отправляете файлы то, они должны быть запакованы в архив и загружены на GitHub, BitBucket или Dropbox</span>
                                </div>
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="new" value="1">
                                <input type="hidden" name="lesson_id" value="{{ $lessone->id }}">
                                <input type="hidden" name="course_slug" value="{{ $course->slug }}">

                                <button type="submit" class="btn btn-primary"
                                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Загрузка">Отправить
                                </button>
                            </form>

                            @if($dialog)
                                <div class="lessone_dialog">
                                    @if (Session::has('flash_message'))
                                        <div class="alert alert-success">{{ session('flash_message') }}</div>
                                    @endif


                                    @foreach($dialog as $homework)
                                        @if ($homework->answer == 0)
                                            <div class="dialog-item lessone_question">
                                                <div class="left">
                                                    <div class="lessone_question-ava"><img
                                                                src="/img/{{$homework->user->avatar }}?w=42" alt=""></div>
                                                    @if ( Carbon\Carbon::now()->format('Y-m-d') == $homework->created_at->format('Y-m-d'))
                                                        <div class="lessone_question-time">{{ $homework->created_at->format('h:m') }}</div>
                                                    @else
                                                        <div class="lessone_question-time">{{ $homework->created_at->format('Y-m-d') }}</div>
                                                    @endif


                                                </div>
                                                <div class="right">
                                                    <div class="lessone_question-title">Вы</div>
                                                    <div class="lessone_question-login">{{ $homework->user->name }}</div>
                                                    <div class="lessone_question-text">
                                                        {!! $homework->text !!}

                                                        @if ($homework->link)
                                                            <p><a href="{{$homework->link}}" target="_blank"><i
                                                                            class="fa fa-paperclip"
                                                                            aria-hidden="true"></i> {{$homework->link}}</a></p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="dialog-item lessone_answer" @if ($homework->new == 1)id="new_msg"@endif>
                                                <div class="left">
                                                    <div class="lessone_question-ava"><img
                                                                src="/img/{{$homework->user->avatar }}?w=42" alt=""></div>
                                                    @if ( Carbon\Carbon::now()->format('Y-m-d') == $homework->created_at->format('Y-m-d'))
                                                        <div class="lessone_question-time">{{ $homework->created_at->format('h:m') }}</div>
                                                    @else
                                                        <div class="lessone_question-time">{{ $homework->created_at->format('Y-m-d') }}</div>
                                                    @endif
                                                    @if ($homework->new == 1)
                                                        <div class="new-msg">
                                                            <a href="{{url('readanswer')}}/{{ $homework->id }}/{{$homework->dialog_id}}">
                                                            <span class="label label-success">Новое</span>
                                                            </a>
                                                        </div>
                                                    @endif


                                                </div>
                                                <div class="right">
                                                    <div class="lessone_question-title">{{ $homework->user->name }}</div>
                                                    <div class="lessone_question-login">Служба технической поддержки</div>
                                                    <div class="lessone_question-text">
                                                        {!! $homework->text !!}

                                                        @if ($homework->link)
                                                            <p><a href="{{$homework->link}}" target="_blank"><i
                                                                            class="fa fa-paperclip"
                                                                            aria-hidden="true"></i> {{$homework->link}}</a></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif




                                    @endforeach
                                </div>
                            @endif
                        @else
                            @if($lessone->acess == 3)
                                <p class="message bg-danger">Это Демо версия урока! <br> Вы не можете отаправить домашнее задание на проверку. Для возможности отправлять ДЗ на првоверку вашему куратору, вам необходимо купить продукт, с доступом не ниже <strong>premium</strong>.</p>                                @include('layouts.payments.price_select')
                            @else
                                <p class="message bg-danger">Ваша учетная запись <strong>{{ Auth::user()->role->name }}</strong>, вы не можете отправлять домашние задания на проверку, эта возможность открыта только для <strong>premium</strong> аккаунтов.</p>
                            @endif
                        @endif

                    </div>
                </div>
            @else
                    @if(Auth::user()->isPremium())
                        {!! \Voyager::setting('comments') !!}
                    @else
                        <p class="message bg-danger">Ваша учетная запись <strong>{{ Auth::user()->role->name }}</strong>, вы можете только учавствовать в онлайн трансляции, оставлять и видеть комментарии во время трансляции могут только владельцы <strong>premium</strong> аккаунтов.</p>
                    @endif
            @endif

        </div>

    </div>

    <script>

        if ($('.alert').length != 0) {
            $('body,html').scrollTop($('.alert').offset().top);
        }

        $('.label-mail').click(function () {
            $('html, body').animate({scrollTop: $('.lessone_dialog .new-msg').offset().top})
        });



        //        var form = $('#homework');
        //
        //        $(form).submit(function (e) {
        //            $('.form-group').removeClass('has-error');
        //            $('.form-group i').remove();
        //            $(form).find('*[type="submit"]').button('loading');
        //
        //            $.ajax({
        //                url: $(this).attr('action'),
        //                type: $(this).attr('method'),
        //                data: $(this).serialize(),
        //                dataType: 'JSON',
        //                success: function (data) {
        //                    setTimeout(function() {
        //                        $(form).submit();
        //                    }, 1000);
        //                },
        //                error :function( data ) {
        //                    $(form).find('*[type="submit"]').button('reset');
        //                    var errors = data.responseJSON;
        //
        //                    $.each(errors,function (index, value) {
        //                        $('[name="'+index+'"]').closest('.form-group').addClass('has-error has-feedback').append('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
        //                    });
        //                }
        //            });
        //
        //            e.preventDefault();
        //        });


    </script>
@endsection

