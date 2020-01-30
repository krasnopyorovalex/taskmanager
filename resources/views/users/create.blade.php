@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form_add-task with-shadow">
                <div class="form-header">
                    <div class="title">Форма добавления пользователя</div>
                </div>
                @include('layouts.partials.errors')
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="box">
                        <label for="f_name">Пользователь</label>
                        <input type="text" id="f_name" name="name" value="{{ old('name') }}" autocomplete="off" required>
                    </div>
                    <div class="box">
                        <label for="f_email">Email</label>
                        <input type="email" id="f_email" name="email" value="{{ old('email') }}" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="box">
                                <label for="f_password">Пароль</label>
                                <input id="f_password" type="password" class="form-control" name="password" autocomplete="off" minlength="8">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box">
                                <label for="f_password-confirm">Повторите пароль</label>
                                <input id="f_password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off" minlength="8">
                            </div>
                        </div>
                    </div>
                    @if($groups)
                        <div class="box">
                            Выберите группы для пользователя
                            <div class="groups-list">
                                @foreach($groups as $group)
                                    <div class="groups-list-item">
                                        <input type="checkbox" name="groups[]" value="{{ $group->id }}" id="f_groups-{{ $group->id }}">
                                        <label for="f_groups-{{ $group->id }}">{{ $group->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="box">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" name="is_admin" value="1" id="f-is_admin">
                        <label for="f-is_admin">Админ?</label>
                    </div>
                    <div class="box">
                        <button type="submit" class="btn btn-add with-icon">
                            {{ svg('icon-add-circle') }}
                            Добавить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
