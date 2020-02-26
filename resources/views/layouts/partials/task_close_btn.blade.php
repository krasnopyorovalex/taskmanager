<div id="request-to-action" class="btn btn-complete with-icon">
    {{ svg('icon-lock') }}
    Закрыть
    <form action="{{ route('tasks.close', $task) }}" method="post" class="hidden">
        @csrf
    </form>
</div>
