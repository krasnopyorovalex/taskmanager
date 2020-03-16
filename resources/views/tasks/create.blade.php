@extends('layouts.app', [
    'title' => 'Создание новой задачи'
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form_add-task with-shadow">
                <div class="form-header">
                    <div class="title">Форма добавления задачи</div>
                </div>
                @include('layouts.partials.errors')
                <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="box">
                                <label for="f_name">Название задачи</label>
                                <input type="text" id="f_name" name="name" value="{{ old('name') }}" required />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="box">
                                <label for="f_group">Группа для задачи</label>
                                <select name="group_id" id="f_group">
                                    @foreach($groups as $group)
                                        <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <label for="editor">Описание задачи</label>
                        <textarea id="editor" class="simple-editor" name="body" required>{{ old('body') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="box">
                                <label for="datepicker">Дата сдачи</label>
                                <input type="text" id="datepicker" name="deadline" value="{{ old('deadline') }}" autocomplete="off" />
                            </div>

                        </div>
                        <div class="col-9">
                            <div class="box">
                                <label for="f_files">Файлы</label>
                                <input type="file" id="f_files" name="files[]" multiple />
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <button type="submit" class="btn btn-add with-icon">
                            {{ svg('icon-add-circle') }}
                            Добавить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
