@extends('admin.panel')

@section('innerContent')
    <a href="{{ route('serviceTypes.create') }}" class="btn btn-default" role="button">Добавить тип</a>
    <hr>

    <h4>Список типов услуг:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>id</td>
            <td>Название</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->getId() }}</td>
                <td><a href="{{ route('serviceTypes.edit', ['id' => $item->getId()]) }}">{{ $item->getName() }}</a></td>
                <td>
                    <a class="btn btn-small btn-warning"
                       onclick="event.preventDefault();document.getElementById('destroy_{{ $item->getId() }}').submit();"
                       href="{{ route('serviceTypes.destroy', ['id' => $item->getId()]) }}">
                        Удалить
                    </a>
                    <form id="destroy_{{ $item->getId() }}" action="{{ route('serviceTypes.destroy', ['id' => $item->getId()]) }}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
