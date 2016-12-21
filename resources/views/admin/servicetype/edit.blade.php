@extends('admin.panel')

@section('innerContent')
    <h4>Редактирование типа: {{ $serviceType->getName() }}</h4>
    <form action="{{ route('serviceTypes.update', ['id' => $serviceType->getId()]) }}" method="post"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="serviceTypeName">Название</label>
                    <input type="text" class="form-control" id="serviceTypeName" name="name"
                           value="{{ $serviceType->getName() }}" autocomplete="false" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Сохранить</button>
        <a href="{{ route('service.types') }}" class="btn btn-default">Отмена</a>
    </form>
@endsection
