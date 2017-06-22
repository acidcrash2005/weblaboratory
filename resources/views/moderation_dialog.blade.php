@extends('layouts.user')

@section('content')
   <div class="inner-container__main">
      <header><h2 class="inner-container__main-title"><a href="{{ url('moderation/user_dialogs', $HomeworkDialog->user_id) }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> Модерация Диалога - {{ $HomeworkDialog->lesson->title }}</h2></header>

      <div class="course-list">
         <div class="container">
             <a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Венруться назад</a><br><br>

             @if ($HomeworkDialog->status == 0)
                 <div class="alert alert-warning" role="alert">Домашнее задание на проверке!</div>
             @elseif($HomeworkDialog->status == 1)
                 <div class="alert alert-danger" role="alert">Необходимо внести исправления!</div>
             @else
                 <div class="alert alert-success" role="alert">Все Ок, домашнее задание принято!</div>
             @endif

             <div class="dialog-link full">
                        <span class="img-user">
                           <img src="/img/{{$HomeworkDialog->user->avatar}}?w=80" alt="">
                        </span>
                 <span class="dialog-link__links">
                           <span><i class="fa fa-address-book" aria-hidden="true"></i> {{$HomeworkDialog->user->name}}</span>
                           <span><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$HomeworkDialog->user->email}}</span>
                        </span>

                 <div class="buttons-accet">
                     <form id="statusForm" action="" method="post">
                         <input type="hidden" name="redirect" value="{{ url('/moderation/dialog', $HomeworkDialog->id) }}">
                         <input type="hidden" name="status" value="1">
                         <input type="hidden" name="dialog_id" value="{{$HomeworkDialog->id}}">
                         {{ csrf_field() }}
                         <a href="#" class="btn btn-success" onclick="statusSend(2); return false;">Принять</a>
                         <a href="#" class="btn btn-danger" onclick="statusSend(1); return false;">Отклонить</a>

                         <script>
                             function statusSend(status) {
                                 $('#statusForm input[name="status"]').val(status);
                                 $('#statusForm').trigger('submit');
                             }
                         </script>
                     </form>

                 </div>
             </div>

             <form id="homework" class="homework-form" action="{{ url('/dz_post_answer') }}" method="POST" enctype="multipart/form-data">
                 <h2 class="homework-form__title">Отправить сообщение</h2>

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
                     <input type="text" class="form-control" name="link" placeholder="Ссылка на файл dropbox"
                            aria-describedby="helpBlock2">
                     <span id="helpBlock2" class="help-block">Если вы отправляете файлы то, они должны быть запакованы в архив и загружены на <a
                                 href="https://db.tt/Q1aJZJLHW9" target="_blank">DropBox</a></span>
                 </div>
                 {{ csrf_field() }}
                 <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                 <input type="hidden" name="new" value="1">
                 <input type="hidden" name="dialog_id" value="{{ $HomeworkDialog->id }}">


                 <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Загрузка">Отправить</button>
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
                                   <div class="lessone_question-ava"><img src="/img/{{$homework->user->avatar }}?w=42" alt=""></div>
                                   @if ( Carbon\Carbon::now()->format('Y-m-d') == $homework->created_at->format('Y-m-d'))
                                       <div class="lessone_question-time">{{ $homework->created_at->format('h:m') }}</div>
                                   @else
                                       <div class="lessone_question-time">{{ $homework->created_at->format('Y-m-d') }}</div>
                                   @endif

                                   @if ($homework->new == 1)
                                       <div class="new-msg"><a href="{{url('readmessage')}}/{{ $homework->id }}/{{$HomeworkDialog->id}}"><span class="label label-success">Новое</span></a></div>
                                   @endif


                               </div>
                               <div class="right">
                                   <div class="lessone_question-title">Ползователь</div>
                                   <div class="lessone_question-login">{{ $homework->user->name }}</div>
                                   <div class="lessone_question-text">
                                       {!! $homework->text !!}

                                       @if ($homework->link)
                                           <p><a href="{{$homework->link}}" target="_blank"><i class="fa fa-paperclip" aria-hidden="true"></i> {{$homework->link}}</a></p>
                                       @endif

                                   </div>
                               </div>
                           </div>
                       @else
                           <div class="dialog-item lessone_answer">
                               <div class="left">
                                   <div class="lessone_question-ava"><img src="/img/{{$homework->user->avatar }}?w=42" alt=""></div>
                                   @if ( Carbon\Carbon::now()->format('Y-m-d') == $homework->created_at->format('Y-m-d'))
                                       <div class="lessone_question-time">{{ $homework->created_at->format('h:m') }}</div>
                                   @else
                                       <div class="lessone_question-time">{{ $homework->created_at->format('Y-m-d') }}</div>
                                   @endif



                               </div>
                               <div class="right">
                                   <div class="lessone_question-title">{{ $homework->user->name }}</div>
                                   <div class="lessone_question-login">Служба технической поддержки</div>
                                   <div class="lessone_question-text">
                                       {!! $homework->text !!}

                                       @if ($homework->link)
                                           <p><a href="{{$homework->link}}" target="_blank"><i class="fa fa-paperclip" aria-hidden="true"></i> {{$homework->link}}</a></p>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       @endif




                   @endforeach
            </div>
         @endif


         </div>
      </div>


   </div>
@endsection

