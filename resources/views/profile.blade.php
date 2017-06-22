@extends('layouts.user')

@section('content')
    <div class="inner-container__main">
        <header><h2 class="inner-container__main-title">Курсы</h2></header>

        <div class="course-list">
            <form action="/profile" method="POST" class="b-registration-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <p class="title-form">Профиль</p>
                <p>Вы: {{ $user->role->name }}</p>

                <div class="form-group">
                    <label for="exampleInputAvatar" class="profile-avatar"><img src="/img/{{ $user->avatar }}?w=150" alt=""></label>
                    <input type="file" name="avatar" value="{{ $user->avatar }}" class="form-control form-control1" id="exampleInputAvatar">
                </div>

                @if ($errors->get('name'))
                    @foreach ($errors->get('name') as $error)
                        <div class="form-group has-error">
                            <label for="exampleInputCountry" class="control-label">Имя</label>
                            <input type="text" name="name"  value="{{ $request->name }}" class="form-control form-control1" id="exampleInputCountry">
                        </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <label for="exampleInputCountry">Имя</label>
                        <input type="text" name="name"  value="{{ $user->name }}" class="form-control form-control1" id="exampleInputCountry">
                    </div>
                @endif

                @if ($errors->get('email'))
                    @foreach ($errors->get('email') as $error)
                        <div class="form-group has-error">
                            <label for="exampleInputEmail" class="control-label">Email</label>
                            <input type="text" name="email"  value="{{ $request->email }}" class="form-control form-control1" id="exampleInputEmail">
                        </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input type="text" name="email"  value="{{ $user->email }}" class="form-control form-control1" id="exampleInputEmail">
                    </div>
                @endif

                @if ($errors->get('phone'))
                    @foreach ($errors->get('phone') as $error)
                        <div class="form-group has-error">
                            <label for="exampleInputEmail" class="control-label">Телефон</label>
                            <input type="text" name="phone"  value="{{ $request->phone }}" class="form-control form-control1" id="exampleInputEmail">
                        </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <label for="exampleInputEmail">Телефон</label>
                        <input type="text" name="phone"  value="{{ $user->phone }}" class="form-control form-control1" id="exampleInputEmail">
                    </div>
                    @endif



                </br>

                @if ($errors->get('password') || $errors->get('re_password'))
                    <div class="form-group has-error">
                        <label for="exampleInputPass" class="control-label">Изменить пароль</label>
                        <input type="password" name="password" placeholder="Введите новый пароль" class="form-control form-control1" id="exampleInputPass"></br>
                        <input type="password" name="re_password" placeholder="Повторите пароль" class="form-control form-control1">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @else
                    <div class="form-group">
                        <label for="exampleInputPass">Изменить пароль</label>
                        <input type="password" name="password" placeholder="Введите новый пароль" class="form-control form-control1" id="exampleInputPass"></br>
                        <input type="password" name="re_password" placeholder="Повторите пароль" class="form-control form-control1">

                    </div>
                @endif

                @if ($errors->get('notification'))
                    @foreach ($errors->get('notification') as $error)
                        <div class="form-group has-error">
                            <label>Оповещения на Email<br>
                                <input style="height: auto;    width: auto; display: inline-block" type="checkbox" name="notification"
                                       @if(!empty($user->notification))
                                               checked
                                       @endif

                                       value="1" class="form-control" >
                                Включить
                            </label>
                        </div>
                    @endforeach
                @else
                    <div class="form-group">
                        <label>Оповещения на Email<br>
                        <input style="height: auto;    width: auto; display: inline-block" type="checkbox" name="notification"
                               @if(!empty($user->notification))
                               checked
                               @endif
                               value="1" class="form-control" >
                            Включить
                        </label>
                    </div>
                @endif

                <div class="b-button-block">
                    <button type="submit" class="btn btn-success btn-lg">Сохранить</button>
                </div>
                <p class="b-note">Нажимая "Сохранить", вы подтверждаете изменение своих данных</p>
            </form>
        </div>

    </div>
@endsection
