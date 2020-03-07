@extends('layouts.app', [
    'title' => 'Добавление нового заказчика'
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form_add-task with-shadow">
                <div class="form-header">
                    <div class="title">Форма добавления заказчика</div>
                </div>
                @include('layouts.partials.errors')
                <form action="{{ route('customers.store') }}" method="post" class="customer-add">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="box">
                                <label for="f_name">Заказчик</label>
                                <input type="text" id="f_name" name="name" value="{{ old('name') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="box">
                                <label for="f_managers">Менеджер</label>
                                <select name="user_id" id="f_managers">
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}" {{ (int)old('user_id') === $manager->id ? 'selected' : '' }}>
                                            {{ $manager->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="box">
                                <label for="f_services">Услуги</label>
                                <input type="text" id="f_services" name="services" value="{{ old('services') }}" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="box">
                                <label for="f_site">Сайт</label>
                                <input type="text" id="f_site" name="site" value="{{ old('site') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="box">
                                <label for="contacts">Контакты</label>
                                <textarea id="contacts" class="simple-editor" name="contacts" required>{{ old('contacts') }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box">
                                <label for="description">Описание</label>
                                <textarea id="description" class="simple-editor" name="description">{{ old('description') }}</textarea>
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
