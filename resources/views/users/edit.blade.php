@extends('layouts.app')

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
                        <input type="text" id="f_name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="box">
                        <label for="f_email">Email</label>
                        <input type="email" id="f_email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="box">
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
