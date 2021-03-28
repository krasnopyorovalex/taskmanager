@extends('layouts.app', [
    'title' => 'Отчёт по закрытым задачам'
])

@section('content')
    @include('layouts.partials.task_filter')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash-message')
            <div class="responsive-table rounded-block with-shadow" xmlns:xlink="">
                <table class="tasks-list">
                    <thead>
                    <tr>
                        <th>#</th>
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
                            <td>{{ $loop->index + 1 }}</td>
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
                    @if($timeCalculator->total($tasks))
                    <tfoot>
                    <tr>
                        <td class="align-right" colspan="6">
                            <div>
                                <div class="time-label">
                                    Всего:
                                </div>
                                <div class="time with-icon">
                                    {{ svg('icon-time') }}
                                    <div class="time-value">
                                        {{ format_seconds($timeCalculator->total($tasks)) }}
                                        @if(auth()->check() && auth()->user()->isAdmin())
                                            ({{ $timeCalculator->cost($tasks)  }})
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('report.pdf', [request()->getQueryString()]) }}" class="btn with-icon btn-small" target="_blank">
                                    {{ svg('icon-cloud-download') }}
                                    <div>
                                        Скачать pdf
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
