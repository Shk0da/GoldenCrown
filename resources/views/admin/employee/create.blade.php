@extends('admin.panel')

@section('innerContent')
    <h4>Создание нового сотрудника</h4>
    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="employeeName">Имя</label>
                    <input type="text" class="form-control" id="employeeName" name="name" value="{{ old('name') }}"
                           autocomplete="false" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="employeePhoto">Фото</label>
                    <input type="file" id="employeePhoto" name="photo" value="{{ old('photo') }}"
                           autocomplete="false">
                    @if ($errors->has('photo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="employeeTime">Рабочее время</label>
                </div>
                <div class="form-group">
                    @foreach(['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'] as $day)

                        <input type="checkbox" name="times[{{ $day }}][day]" value="{{ $day }}"> {{ $day }}

                        <div class="form-inline">
                            <div class="form-group clockpicker">
                                с <input type="text" name="times[{{ $day }}][start]" value="09:30">
                            </div>
                            <div class="form-group clockpicker">
                                по <input type="text" name="times[{{ $day }}][end]" value="18:00">
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Создать</button>
        <a href="{{ route('employee') }}" class="btn btn-default">Отмена</a>
    </form>
@endsection
