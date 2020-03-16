<div class="row">
    <div class="col-12">
        <form action="{{ route('search.index') }}" method="get" class="search-form with-shadow rounded-block">
            <div class="box">
                <label for="f-started-at">Поиск задачи:</label>
                <input type="text" name="keyword" id="f-search" value="{{ request('keyword') }}" minlength="3" required>
            </div>
            <div class="box">
                <button class="btn with-icon btn-small" type="submit">
                    {{ svg('icon-search') }}
                    Найти
                </button>
            </div>
        </form>
    </div>
</div>
