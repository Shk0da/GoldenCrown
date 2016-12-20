@extends('admin.panel')

@section('innerContent')

    <a href="{{ route('employee.create') }}" class="btn btn-default" role="button">Добавить сотрудника</a>
    <hr>

    <h4>Список сотрудников:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>id</td>
            <td>Фото</td>
            <td>Имя</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->getId() }}</td>
                <td><img src="{{ $item->getPhoto() }}" alt="{{ $item->getName() }}" height="50"></td>
                <td><a href="{{ route('employee.edit', ['id' => $item->getId()]) }}">{{ $item->getName() }}</a></td>
                <td>
                    <a class="btn btn-small btn-success" href="{{ route('workingTime.show', ['id' => $item->getId()]) }}">
                        Рабочие часы
                    </a>
                    <a class="btn btn-small btn-warning"
                       onclick="event.preventDefault();document.getElementById('destroy_{{ $item->getId() }}').submit();"
                       href="{{ route('employee.destroy', ['id' => $item->getId()]) }}">
                        Удалить
                    </a>
                    <form id="destroy_{{ $item->getId() }}" action="{{ route('employee.destroy', ['id' => $item->getId()]) }}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
