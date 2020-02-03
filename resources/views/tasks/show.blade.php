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
                <div class="comments-box">
                    <ul>
                        <li>
                            <div class="comment-header with-icon">
                                <div class="comment-header-user">
                                    <div class="comment-header-user-img">
                                        {{ svg('icon-user') }}
                                    </div>
                                    <div class="comment-header-user-name">
                                        Краснопёров
                                    </div>
                                </div>
                                <div class="comment-header-date">
                                    10 минут назад
                                </div>
                            </div>
                            <div class="comment-body">
                                <p>Имеется спорная точка зрения, гласящая примерно следующее: независимые государства ограничены исключительно образом мышления.</p>
                            </div>
                            <div class="comment-footer">
                                <div class="btn-reply">
                                    Ответить
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <div class="comment-header with-icon">
                                        <div class="comment-header-user">
                                            <div class="comment-header-user-img">
                                                <svg>
                                                    <use xlink:href="../img/sprites/sprite.svg#icon-user"></use>
                                                </svg>
                                            </div>
                                            <div class="comment-header-user-name">
                                                Наташа
                                            </div>
                                        </div>
                                        <div class="comment-header-date">
                                            Только что
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <p>Ясность нашей позиции очевидна: базовый вектор развития способствует повышению качества форм воздействия.</p>
                                    </div>
                                    <div class="comment-footer">
                                        <div class="btn-reply">
                                            Ответить
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                        <li>
                                            <div class="comment-header with-icon">
                                                <div class="comment-header-user">
                                                    <div class="comment-header-user-img">
                                                        <svg>
                                                            <use xlink:href="../img/sprites/sprite.svg#icon-user"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="comment-header-user-name">
                                                        Наташа
                                                    </div>
                                                </div>
                                                <div class="comment-header-date">
                                                    Только что
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                <p>В своём стремлении улучшить пользовательский опыт мы упускаем, что интерактивные прототипы призваны к ответу.</p>
                                            </div>
                                            <div class="comment-footer">
                                                <div class="btn-reply">
                                                    Ответить
                                                </div>
                                            </div>
                                        </li>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="comment-header with-icon">
                                <div class="comment-header-user">
                                    <div class="comment-header-user-img">
                                        <svg>
                                            <use xlink:href="../img/sprites/sprite.svg#icon-user"></use>
                                        </svg>
                                    </div>
                                    <div class="comment-header-user-name">
                                        Наташа
                                    </div>
                                </div>
                                <div class="comment-header-date">
                                    Только что
                                </div>
                            </div>
                            <div class="comment-body">
                                <p>Как уже неоднократно упомянуто, базовые сценарии поведения пользователей превращены в посмешище, хотя само их существование приносит несомненную пользу обществу. Лишь сделанные на базе интернет-аналитики выводы объективно рассмотрены соответствующими инстанциями.</p>
                            </div>
                            <div class="comment-footer">
                                <div class="btn-reply">
                                    Ответить
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-header with-icon">
                                <div class="comment-header-user">
                                    <div class="comment-header-user-img">
                                        <svg>
                                            <use xlink:href="../img/sprites/sprite.svg#icon-user"></use>
                                        </svg>
                                    </div>
                                    <div class="comment-header-user-name">
                                        Краснопёров
                                    </div>
                                </div>
                                <div class="comment-header-date">
                                    1 час назад
                                </div>
                            </div>
                            <div class="comment-body">
                                <p>Прежде всего, внедрение современных методик влечет за собой процесс внедрения и модернизации системы массового участия. Базовые сценарии поведения пользователей набирают популярность среди определенных слоев населения, а значит, должны быть подвергнуты целой серии независимых исследований.</p>
                            </div>
                            <div class="comment-footer">
                                <div class="btn-reply">
                                    Ответить
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
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
