@extends('admin.panel')

@section('innerContent')
    <a href="{{ route('services.create') }}" class="btn btn-default" role="button">Добавить услугу</a>
    <hr>

    <h4>Список услуг:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>id</td>
            <td>Название</td>
            <td>Тип</td>
            <td>Время</td>
            <td>Стоимость</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->getId() }}</td>
                <td><a href="{{ route('services.edit', ['id' => $item->getId()]) }}">{{ $item->getName() }}</a></td>
                <td>{{ $item->getType() }}</td>
                <td>{{ $item->getTime() }}</td>
                <td>{{ $item->getCost() }}</td>
                <td>
                    <a class="btn btn-small btn-warning"
                       onclick="event.preventDefault();document.getElementById('destroy_{{ $item->getId() }}').submit();"
                       href="{{ route('services.destroy', ['id' => $item->getId()]) }}">
                        Удалить
                    </a>
                    <form id="destroy_{{ $item->getId() }}" action="{{ route('services.destroy', ['id' => $item->getId()]) }}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
