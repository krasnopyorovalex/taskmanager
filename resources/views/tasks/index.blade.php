@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="responsive-table rounded-block with-shadow" xmlns:xlink="">
                <table class="tasks-list">
                    <thead>
                    <tr>
                        <th>
                            Название
                        </th>
                        <th class="align-right">
                            Время
                        </th>
                        <th>
                            Статус
                        </th>
                        <th>
                            Исполнитель
                        </th>
                        <th>
                            Дата сдачи
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="task-name">{{ $task->name }}</a>
                                <div class="author">{{ $task->author->name }}</div>
                            </td>
                            <td class="align-right">
                                <div class="with-icon">
                                    <div class="time">
                                        {{ svg('icon-time') }}
                                        <div class="time-value">
                                            {!! $task->timer->formatTotal !!}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="status status_{{ Illuminate\Support\Str::slug($task->status, '_') }} with-icon">
                                    {{ svg($task->icon) }}
                                    <div class="status-value">
                                        {{ $task->labelStatus }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="with-icon">
                                    <div class="user">
                                        {{ $task->performer->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date with-icon">
                                    {{ svg('icon-calendar-date') }}
                                    <div class="date-value">
                                        {{ $task->deadline->formatLocalized('%d %b %Y') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $tasks->links('vendor/pagination/paginate') }}
            </div>
        </div>
    </div>
@endsection
