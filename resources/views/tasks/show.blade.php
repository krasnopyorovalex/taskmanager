@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="task-description box-white rounded-block with-shadow">
                <div class="task-name">{{ $task->name }}</div>
                {!! $task->body !!}
            </div>
            <div class="comments box-white with-shadow rounded-block">
                <div class="comments-header">
                    <div class="title">Комментарии</div>
                </div>
                <div class="comments-box" id="comments" data-task="{{ $task->uuid }}"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="aside-box box-white rounded-block with-shadow">
                <div class="with-icon text-right time-box">
                    <span>Время:</span>
                    <div class="time">
                        {{ svg('icon-time') }}
                        <div class="time-value">
                            {{ format_seconds($task->timer->total) }}
                        </div>
                    </div>
                </div>
                @include('layouts.partials.task_status')
                <div class="btn btn-complete with-icon">
                    {{ svg('icon-check') }}
                    Выполнено
                </div>
            </div>
            <div class="aside-box box-white rounded-block with-shadow">
                <div class="task_tech-info-item">
                    <div class="task_tech-info-item-label">Создана</div>
                    <div class="task_tech-info-item-value">{{ $task->created_at->formatLocalized('%d %b %Y %H:%M') }}</div>
                </div>
                <div class="task_tech-info-item">
                    <div class="task_tech-info-item-label">Дата сдачи</div>
                    <div class="task_tech-info-item-value">{{ format_deadline($task->deadline) }}</div>
                </div>
                @if($task->performer)
                <div class="task_tech-info-item">
                    <div class="task_tech-info-item-label">Исполнитель</div>
                    <div class="task_tech-info-item-value">{{ $task->performer->name }}</div>
                </div>
                @endif
                <div class="task_tech-info-item">
                    <div class="task_tech-info-item-label">Инициатор</div>
                    <div class="task_tech-info-item-value">{{ $task->author->name }}</div>
                </div>
            </div>
            @if(count($task->files))
            <div class="files-box box-white rounded-block with-shadow">
                <div class="title with-icon">
                    {{ svg('icon-attach') }}
                    Прикрепленные файлы
                </div>
                <ul class="files-list">
                    @foreach($task->files as $file)
                    <li><a href="{{ $file->path }}" target="_blank">{{ $file->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
@endsection
