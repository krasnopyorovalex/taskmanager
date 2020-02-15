@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="task-description box-white rounded-block with-shadow">
                <div class="task-name">#{{ $task->name }}</div>
                <p><b>Описание задачи</b></p>
                {!! $task->body !!}
            </div>
            @includeWhen(count(only_images_files($task->files)), 'layouts.partials.task_images')
            <div class="comments box-white with-shadow rounded-block">
                <div class="comments-header">
                    <div class="title with-icon">
                        {{ svg('icon-chat-group-alt') }}
                        Комментарии
                    </div>
                </div>
                <div class="comments-box" id="comments" data-task="{{ $task->uuid }}"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="aside-box box-white rounded-block with-shadow">
                <div class="with-icon text-right time-box">
                    <div class="time">
                        {{ svg('icon-time') }}
                        <div class="time-value" data-seconds="{{ $task->timer->total }}">
                            {{ format_seconds($task->timer->total) }}
                        </div>
                    </div>
                </div>

                @unless($taskStatus->isClosed($task))
                    @include('layouts.partials.task_status')
                @endunless

                @unless($taskStatus->isCompleted($task) || $taskStatus->isClosed($task))
                    @include('layouts.partials.task_complete_btn')
                @endunless
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
                    <div class="task_tech-info-item-value{{ $task->performer->deleted_at ? ' deleted-record' : '' }}">{{ $task->performer->name }}</div>
                </div>
                @endif
                <div class="task_tech-info-item">
                    <div class="task_tech-info-item-label">Инициатор</div>
                    <div class="task_tech-info-item-value{{ $task->author->deleted_at ? ' deleted-record' : '' }}">{{ $task->author->name }}</div>
                </div>
            </div>
            <div class="files-box box-white rounded-block with-shadow">
                @if(count(only_images_files($task->files, false)))
                <ul class="files-list">
                    @foreach(only_images_files($task->files, false) as $file)
                    <li><a href="{{ route('files.download', ['uuid' => $task->uuid, 'id' => $file->id]) }}">{{ $loop->index + 1 }}. {{ $file->name }}</a></li>
                    @endforeach
                </ul>
                @endif
                <div class="add-files">
                    <form action="{{ route('files.upload', ['uuid' => $task->uuid]) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="file" name="files[]" class="hidden" multiple>
                        <div class="btn add-files-btn with-icon">
                            {{ svg('icon-cloud-upload') }}
                            Добавить файлы
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
