@extends('layouts.app', [
    'title' => 'Форма редактирования пользователя'
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form_add-task with-shadow">
                <div class="form-header">
                    <div class="title">Форма редактирования пользователя</div>
                </div>
                @include('layouts.partials.errors')
                <form action="{{ route('users.update', $user) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="box">
                        <label for="f_name">Пользователь</label>
                        <input type="text" id="f_name" value="{{ old('name', $user->name) }}" name="name" required>
                    </div>
                    <div class="box">
                        <label for="f_email">Email</label>
                        <input type="email" id="f_email" name="email" value="{{ old('email', $user->email) }}" required>
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
                                        <input type="checkbox" name="groups[{{ $group->id }}]" value="1" id="f_groups-{{ $group->id }}"{{ $user->hasGroup($group) ? ' checked' : '' }}>
                                        <label for="f_groups-{{ $group->id }}">{{ $group->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="box">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" name="is_admin" value="1" id="f-is_admin" {{ $user->isAdmin() ? 'checked' : '' }}>
                        <label for="f-is_admin">Админ?</label>
                    </div>
                    <div class="box">
                        <button type="submit" class="btn btn-add with-icon">
                            {{ svg('icon-edit') }}
                            Обновить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
