@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
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
                            Дата добавления
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
                                <div class="date with-icon">
                                    {{ svg('icon-calendar-date') }}
                                    <div class="date-value">
                                        {{ $user->created_at }}
                                    </div>
                                </div>
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
