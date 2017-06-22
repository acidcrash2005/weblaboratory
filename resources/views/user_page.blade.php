@extends('layouts.user')

@section('content')
    <div class="inner-container__main">
        <header><h2 class="inner-container__main-title">Главная</h2></header>

        <div class="main-container">

            <div class="new-mesages-block">
                <h2 class="lesson-description__title">Ответы по Домашним Заданиям</h2>
                <table class="table table-striped new-mesages__list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Курс</th>
                        <th>Название урока</th>
                    </tr>
                    </thead>
                    @foreach($HomeworkDialog as $dialog)
                        @if($dialog->new_answer !=0)
                        <tr>
                            <td>
                                <a href="{{ url('/courses') }}/{{$dialog->lesson->cours->slug}}/{{$dialog->lesson->id}}#dz" class="msg-ico">

                                   {{ Widget::run('NewMassage',['db' => 'HomeworkAnswer', 'dialog' => $dialog->id]) }} <i class="fa fa-envelope-o" aria-hidden="true"></i>

                                </a>
                            </td>
                            <td>
                                <a href="{{ url('/courses') }}/{{$dialog->lesson->cours->slug}}">
                                    {{ $dialog->lesson->cours->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('/courses') }}/{{$dialog->lesson->cours->slug}}/{{$dialog->lesson->id}}#dz">
                                    {{ $dialog->lesson->title }}
                                </a>
                            </td>

                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>

            <div class="cours-list-main">
                <h2 class="lesson-description__title">Трансляции и вебинары</h2>
                <div class="b-events">
                    @include('layouts.courses.vebinars',$onAir)
                </div>
            </div>

            <div class="cours-list-main">
                <h2 class="lesson-description__title">Ваши курсы</h2>
                <div class="b-events">
                    @if(Auth::user()->role_id != 1 && Auth::user()->role_id != 6)
                        @include('layouts.courses.course_list_user')
                    @else
                        @include('layouts.courses.course_list_admin')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

