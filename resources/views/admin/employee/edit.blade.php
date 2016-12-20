@extends('admin.panel')

@section('innerContent')
    <h4>Редактирование сотрудника: {{ $employee->getName() }}</h4>
    <form action="{{ route('employee.update', ['id' => $employee->getId()]) }}" method="post"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="employeeName">Имя</label>
                    <input type="text" class="form-control" id="employeeName" name="name"
                           value="{{ $employee->getName() }}" autocomplete="false" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="employeePhoto">Фото</label>
                    <input type="file" class="form-control" id="employeePhoto" name="photo" value="{{ old('photo') }}"
                           autocomplete="false">
                </div>
            </div>
        </div>

        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Сохранить</button>
        <a href="{{ route('employee') }}" class="btn btn-default">Отмена</a>
    </form>
@endsection
