@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form_add-task with-shadow">
                <div class="form-header">
                    <div class="title">Форма добавления группы</div>
                </div>
                @include('layouts.partials.errors')
                <form action="{{ route('groups.store') }}" method="post">
                    @csrf
                    <div class="box">
                        <label for="f_name">Название группы</label>
                        <input type="text" id="f_name" name="name" value="{{ old('name') }}" autocomplete="off" required>
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
