@extends('layouts.app', [
    'title' => 'Список групп'
])

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('message'))
            <div class="message-info with-icon rounded-block with-shadow">
                {{ svg('icon-information') }}
                {{ session('message') }}
            </div>
            @endif
            <div class="add-record-btn_box">
                <a href="{{ route('groups.create') }}" class="btn btn-add with-icon">
                    {{ svg('icon-add-circle') }}
                    Добавить группу
                </a>
            </div>
            <div class="responsive-table rounded-block with-shadow">
                <table class="users-list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            Название группы
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>
                                <div class="label label-iteration">
                                    {{ loop_index_by_pagination($loop->iteration) }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('groups.edit', $group) }}" class="task-name">{{ $group->name }}</a>
                            </td>
                            <td>
                                <div class="actions">
                                    <div class="btn-update with-icon">
                                        <a href="{{ route('groups.edit', $group) }}">
                                            {{ svg('icon-edit') }}
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('groups.destroy', $group) }}">
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
            </div>
        </div>
    </div>
@endsection
