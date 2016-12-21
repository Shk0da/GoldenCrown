@extends('admin.panel')

@section('innerContent')

    <h4>Список заказов:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>id</td>
            <td>Имя клиента</td>
            <td>Услуги</td>
            <td>Мастер</td>
            <td>Время</td>
            <td>Стоимость</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->getId() }}</td>
                <td>{{ $item->getName() }}</td>
                <td>{{ $item->getServices() }}</td>
                <td>{{ $item->getEmployee() }}</td>
                <td>{{ $item->getTime() }}</td>
                <td>{{ $item->getCost() }}</td>
                <td>
                    <a class="btn btn-small btn-warning"
                       onclick="event.preventDefault();document.getElementById('destroy_{{ $item->getId() }}').submit();"
                       href="{{ route('orders.destroy', ['id' => $item->getId()]) }}">
                        Удалить
                    </a>
                    <form id="destroy_{{ $item->getId() }}" action="{{ route('orders.destroy', ['id' => $item->getId()]) }}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
