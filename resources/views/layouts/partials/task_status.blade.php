<div class="status status_{{ words_to_lower_case($task->status) }} with-icon" data-uuid="{{ $task->uuid }}">
    {!! $taskStatus->isCompleted($task) ? svg('icon-cheveron-down-circle') : $taskStatus->icon($task) !!}
    <div class="status-value">
        {{ $taskStatus->getLabelStatus($task) }}
    </div>
</div>
