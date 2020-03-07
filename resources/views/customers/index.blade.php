@extends('layouts.app', [
    'title' => 'Список заказчиков'
])

@section('content')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash-message')
            <div class="add-record-btn_box">
                <a href="{{ route('customers.create') }}" class="btn btn-add with-icon">
                    {{ svg('icon-add-circle') }}
                    Добавить заказчика
                </a>
            </div>
            <div class="responsive-table rounded-block with-shadow">
                <table class="tasks-list">
                    <thead>
                    <tr>
                        <th>
                            Название
                        </th>
                        <th>
                            Услуги
                        </th>
                        <th>
                            Контакты
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr class="task-row">
                            <td>
                                <a href="{{ route('customers.edit', $customer) }}" class="task-name">{{ $customer->name }}</a>
                                <div class="author{{ $customer->manager->deleted_at ? ' deleted-record' : '' }}">{{ $customer->manager->name }}</div>
                            </td>
                            <td>
                                {{ $customer->services }}
                            </td>
                            <td>
                                {!! $customer->contacts !!}
                            </td>
                            <td>
                                <div class="actions">
                                    <div class="btn-update with-icon">
                                        <a href="{{ route('customers.edit', $customer) }}">
                                            {{ svg('icon-edit') }}
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn-destroy with-icon">
                                            {{ svg('icon-close') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $customers->links('vendor/pagination/paginate') }}
            </div>
        </div>
    </div>
@endsection
