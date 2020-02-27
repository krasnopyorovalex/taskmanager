<div class="row">
    <div class="col-12">
        <form action="{{ route('report.index') }}" method="get" class="filter-form with-shadow rounded-block">
            <div class="box m-auto">
                <div class="title">Фильтр задач для отчёта</div>
            </div>
            <div class="box">
                <label for="f-started-at">Задачи от:</label>
                <input type="text" name="started-at" id="f-started-at" value="{{ request('started-at') ?: $firstDayOfCurrentMonth }}">
            </div>
            <div class="box">
                <label for="f-stop-at">Задачи до:</label>
                <input type="text" name="stop-at" id="f-stop-at" value="{{ request('stop-at') ?: date('Y-m-d') }}">
            </div>
            <div class="box">
                <label for="f-user">Исполнитель</label>
                <select name="performer" id="f-user">
                    <option value="">Не выбрано</option>
                    @foreach($performers as $performer)
                        <option value="{{ $performer->id }}" {{ (int) request('performer') === $performer->id ? 'selected' : '' }}>{{ $performer->name }}</option>
                    @endforeach
                </select>
                <span class="icon-cheveron-down"></span>
            </div>
            <div class="box">
                <button class="btn with-icon btn-small" type="submit">
                    {{ svg('icon-order-horizontal') }}
                    Применить
                </button>
            </div>
        </form>
    </div>
</div>
