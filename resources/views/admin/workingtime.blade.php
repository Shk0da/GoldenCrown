@extends('admin.panel')

@section('innerContent')
    <h4>Рабочее время сотрудников:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Имя</td>
            <td>Время</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td><a href="{{ route('employee.edit', ['id' => $item->employee->getId()]) }}">{{ $item->employee->getName() }}</a></td>
                <td>
                    <a class="btn btn-small btn-success" href="{{ route('workingTime.edit', ['id' => $item->getId()]) }}">
                        Редактировать
                    </a>
                    <a class="btn btn-small btn-warning"
                       onclick="event.preventDefault();document.getElementById('destroy_{{ $item->getId() }}').submit();"
                       href="{{ route('employee.destroy', ['id' => $item->getId()]) }}">
                        Удалить
                    </a>
                    <form id="destroy_{{ $item->getId() }}" action="{{ route('workingTime.destroy', ['id' => $item->getId()]) }}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
