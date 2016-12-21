@extends('admin.panel')

@section('innerContent')
    <h4>Создание нового типа</h4>
    <form action="{{ route('serviceTypes.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="serviceTypesName">Название</label>
                    <input type="text" class="form-control" id="serviceTypesName" name="name" value="{{ old('name') }}"
                           autocomplete="false" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Создать</button>
        <a href="{{ route('service.types') }}" class="btn btn-default">Отмена</a>
    </form>
@endsection
