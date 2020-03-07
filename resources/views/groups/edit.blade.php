@extends('layouts.app', [
    'title' => 'Редактирование группы'
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form_add-task with-shadow">
                <div class="form-header">
                    <div class="title">Форма редактирования группы</div>
                </div>
                @include('layouts.partials.errors')
                <form action="{{ route('groups.update', $group) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="box">
                        <label for="f_name">Навзание группы</label>
                        <input type="text" id="f_name" value="{{ old('name', $group->name) }}" name="name" required>
                    </div>
                    <div class="box">
                        <button type="submit" class="btn btn-add with-icon">
                            {{ svg('icon-edit') }}
                            Обновить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
