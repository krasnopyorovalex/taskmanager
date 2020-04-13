<div class="row">
    <div class="col-12">
        <form action="{{ route('report.index') }}" method="get" class="filter-form with-shadow rounded-block">
            <div class="box">
                <label for="f-started-at">Задачи от:</label>
                <input type="text" name="start" id="f-started-at" value="{{ $datePeriod->getDateStart() }}">
            </div>
            <div class="box">
                <label for="f-stop-at">Задачи до:</label>
                <input type="text" name="stop" id="f-stop-at" value="{{ $datePeriod->getDateStop() }}">
            </div>
            <div class="box">
                <label for="f-user">Группа</label>
                <select name="group" id="f-group">
                    <option value="">Не выбрано</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ (int) request('group') === $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="box">
                <label for="f-user">Исполнитель</label>
                <select name="performer" id="f-user">
                    <option value="">Не выбрано</option>
                    @foreach($performers as $performer)
                        <option value="{{ $performer->id }}" {{ (int) request('performer') === $performer->id ? 'selected' : '' }}>{{ $performer->name }}</option>
                    @endforeach
                </select>
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
