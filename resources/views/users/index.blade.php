@extends('layouts.app', [
    'title' => 'Список пользователей'
])

@section('content')
    <div class="row">
        <div class="col-12">
           @include('layouts.partials.flash-message')
            <div class="add-record-btn_box">
                <a href="{{ route('users.create') }}" class="btn btn-add with-icon">
                    {{ svg('icon-add-circle') }}
                    Добавить пользователя
                </a>
            </div>
            <div class="responsive-table rounded-block with-shadow">
                <table class="users-list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            Пользователь
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Админ
                        </th>
                        <th>
                            Группы
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="label label-iteration">
                                    {{ loop_index_by_pagination($loop->iteration) }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('users.update', $user) }}" class="task-name">{{ $user->name }}</a>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <div class="label label-info">
                                    {{ $user->isAdmin() ? 'Да' : 'Нет' }}
                                </div>
                            </td>
                            <td>
                                @if(count($user->groups))
                                <div class="label label-info">
                                    {{ $user->groups->implode('name', ', ') }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <div class="btn-update with-icon">
                                        <a href="{{ route('users.edit', $user) }}">
                                            {{ svg('icon-edit') }}
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn-destroy with-icon">
                                            {{ svg('icon-close') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links('vendor/pagination/paginate') }}
            </div>
        </div>
    </div>
@endsection
