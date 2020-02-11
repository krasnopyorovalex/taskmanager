<div id="request-to-complete" class="btn btn-complete with-icon">
    {{ svg('icon-check') }}
    Выполнено
    <form action="{{ route('tasks.complete', $task) }}" method="post" class="hidden">
        @csrf
    </form>
</div>
