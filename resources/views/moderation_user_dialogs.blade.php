@extends('layouts.user')

@section('content')
   <div class="inner-container__main">
      <header><h2 class="inner-container__main-title"><a href="{{ url('moderation') }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> Модерация</h2></header>

      <div class="main-container">
         <a href="{{ url('moderation') }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Венруться назад</a><br><br>
         @if (!empty($HomeworkDialog[0]))
            <img src="/img/{{$HomeworkDialog[0]->user->avatar}}?w=40" alt=""> {{$HomeworkDialog[0]->user->name}}
         @else
            <img src="/img/{{$HomeworkDialogNew[0]->user->avatar}}?w=40" alt=""> {{$HomeworkDialogNew[0]->user->name}}
         @endif

         <div class="new-mesages-block">
            <h2 class="lesson-description__title">Новые сообщения</h2>
            <table class="table table-striped new-mesages__list">
               <thead>
               <tr>
                  <th>#</th>
                  <th>Ползователь</th>
                  <th>Действие</th>
                  <th>Курс</th>
                  <th>Название урока</th>

               </tr>
               </thead>
               @foreach($HomeworkDialogNew as $dialog)

                  @if($dialog->new_question !=0)
                     <tr class="new-tr">
                        <td>
                           @if ($dialog->status == 0)
                              <i style="color: #ffbe00;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                           @elseif($dialog->status == 1)
                              <i style="color: #cc001a;" class="fa fa-times-circle" aria-hidden="true"></i>
                           @else
                              <i style="color: #107100;" class="fa fa-check-circle" aria-hidden="true"></i>
                           @endif
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="msg-ico">

                              {{ Widget::run('NewMassage',['db' => 'Homework', 'dialog' => $dialog->id]) }} <i class="fa fa-envelope-o" aria-hidden="true"></i>

                           </a>
                        </td>
                        <td>
                           {{ $dialog->user->name }}
                        </td>
                        <td>
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="btn btn-success ">
                              ответить
                           </a>
                        </td>

                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}">
                              {{ $dialog->lesson->cours->title }}
                           </a>
                        </td>
                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}/{{$dialog->lesson->id}}#dz">
                              {{ $dialog->lesson->title }}
                           </a>
                        </td>

                     </tr>
                  @else
                     <tr>
                        <td>
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="msg-ico">
                              {{ Widget::run('NewMassage',['db' => 'Homework', 'dialog' => $dialog->id]) }} <i class="fa fa-envelope-o" aria-hidden="true"></i>
                           </a>
                        </td>
                        <td>
                           {{ $dialog->user->name }}
                        </td>
                        <td>
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="btn btn-info ">
                              просмотреть
                           </a>
                        </td>

                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}">
                              {{ $dialog->lesson->cours->title }}
                           </a>
                        </td>
                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}/{{$dialog->lesson->id}}#dz">
                              {{ $dialog->lesson->title }}
                           </a>
                        </td>

                     </tr>
                  @endif
               @endforeach
            </table>
            {{--{{ $HomeworkDialog->links() }}--}}
         </div>

         <div class="new-mesages-block">
            <h2 class="lesson-description__title">Все сообщения</h2>
            <table class="table table-striped new-mesages__list">
               <thead>
               <tr>
                  <th>#</th>
                  <th>Ползователь</th>
                  <th>Действие</th>
                  <th>Курс</th>
                  <th>Название урока</th>

               </tr>
               </thead>
               @foreach($HomeworkDialog as $dialog)

                  @if($dialog->new_question !=0)
                     <tr class="new-tr">
                        <td>
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="msg-ico">

                              {{ Widget::run('NewMassage',['db' => 'Homework', 'dialog' => $dialog->id]) }} <i class="fa fa-envelope-o" aria-hidden="true"></i>

                           </a>
                        </td>
                        <td>
                           <img src="/img/{{$dialog->user->avatar}}?w=40" alt=""> {{ $dialog->user->name }}
                        </td>
                        <td>
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="btn btn-success ">
                              ответить
                           </a>
                        </td>

                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}">
                              {{ $dialog->lesson->cours->title }}
                           </a>
                        </td>
                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}/{{$dialog->lesson->id}}#dz">
                              {{ $dialog->lesson->title }}
                           </a>
                        </td>

                     </tr>
                  @else
                     <tr>
                        <td>
                           @if ($dialog->status == 0)
                              <i style="color: #ffbe00;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                           @elseif($dialog->status == 1)
                              <i style="color: #cc001a;" class="fa fa-times-circle" aria-hidden="true"></i>
                           @else
                              <i style="color: #107100;" class="fa fa-check-circle" aria-hidden="true"></i>
                           @endif
                        </td>
                        <td>
                           {{ $dialog->user->name }}
                        </td>
                        <td>
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="btn btn-info ">
                              просмотреть
                           </a>
                        </td>

                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}">
                              {{ $dialog->lesson->cours->title }}
                           </a>
                        </td>
                        <td>
                           <a href="{{ url('/courses/') }}/{{$dialog->lesson->cours->slug}}/{{$dialog->lesson->id}}#dz">
                              {{ $dialog->lesson->title }}
                           </a>
                        </td>

                     </tr>
                  @endif
               @endforeach
            </table>
         </div>
      </div>

   </div>
@endsection

