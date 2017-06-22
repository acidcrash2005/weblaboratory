@extends('layouts.user')

@section('content')
   <div class="inner-container__main">
      <header><h2 class="inner-container__main-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> Модерация</h2></header>

      <div class="main-container">
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
                           <a href="{{ url('/moderation/dialog') }}/{{$dialog->id}}" class="msg-ico">

                              {{ Widget::run('NewMassage',['db' => 'Homework', 'dialog' => $dialog->id]) }} <i class="fa fa-envelope-o" aria-hidden="true"></i>

                           </a>
                        </td>
                        <td>
                           <img src="/img/{{$dialog->user->avatar}}?w=40" alt=""> <a href="{{ url('/moderation/user_dialogs/') }}/{{$dialog->user->id}}" >{{ $dialog->user->name }}</a>
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
            <h2 class="lesson-description__title">Все диалоги</h2>

            <div class="users-list-moderator row">
               @foreach( $HomeworkDialog as $dialod)
                  <div class="col-md-4">
                     <a href="{{url('moderation/user_dialogs',$dialod->user->id)}}" class="dialog-link">
                        <span class="img-user">
                           <img src="/img/{{$dialod->user->avatar}}?w=80" alt="">
                        </span>
                        <span class="dialog-link__links">
                           <span><i class="fa fa-address-book" aria-hidden="true"></i> {{$dialod->user->name}}</span>
                           <span><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$dialod->user->email}}</span>
                           <span class="flags-product">
                              @foreach ($dialod->user->products as $item)
                                 <b class="label-curse" style="color:@if ($item->course->text_color == 0) #000 @else #fff @endif">
                                          <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                               viewBox="0 0 483.013 483.013" style="enable-background:new 0 0 483.013 483.013;" xml:space="preserve">
                                          <path fill="{{$item->course->color}}" d="M477.043,219.205L378.575,48.677c-7.974-13.802-22.683-22.292-38.607-22.292H143.041c-15.923,0-30.628,8.49-38.608,22.292
                                              L5.971,219.205c-7.961,13.801-7.961,30.785,0,44.588l98.462,170.543c7.98,13.802,22.685,22.293,38.608,22.293h196.926
                                              c15.925,0,30.634-8.491,38.607-22.293l98.469-170.543C485.003,249.99,485.003,233.006,477.043,219.205z"/>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          <g>
                                          </g>
                                          </svg>

                                    <i class="{{ $item->course->icon }}" aria-hidden="true"></i>
                                 </b>
                              @endforeach
                           </span>
                        </span>

                     </a>
                  </div>
               @endforeach
            </div>
         </div>
      </div>

   </div>
@endsection

