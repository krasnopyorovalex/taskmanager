@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash-message')
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
                            Исполнитель
                        </th>
                        <th>
                            Дата сдачи
                        </th>
                        <th>
                            Дата закрытия
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="task-name">{{ $task->name }}</a>
                                <div class="author{{ $task->author->deleted_at ? ' deleted-record' : '' }}">{{ $task->author->name }}</div>
                            </td>
                            <td class="align-right">
                                <div class="with-icon">
                                    <div class="time">
                                        {{ svg('icon-time') }}
                                        <div class="time-value">
                                            {{ format_seconds($task->timer->total) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="with-icon">
                                    <div class="user">
                                        {{ $task->performer ? $task->performer->name : '' }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date with-icon">
                                    {{ svg('icon-calendar-date') }}
                                    <div class="date-value">
                                        {{ format_deadline($task->deadline) }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date with-icon">
                                    {{ svg('icon-calendar-date') }}
                                    <div class="date-value">
                                        {{ format_deadline($task->closed_at) }}
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
