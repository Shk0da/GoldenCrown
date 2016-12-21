@extends('admin.panel')

@section('innerContent')
    <h4>Создание новой услуги</h4>
    <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="serviceName">Название</label>
                    <input type="text" class="form-control" id="serviceName" name="name" value="{{ old('name') }}"
                           autocomplete="false" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="serviceType">Тип</label>

                    <select class="form-control" id="serviceType" name="type" required>
                        <option disabled selected>Выбрать</option>
                        @foreach(\App\Http\Models\ServiceType::all() as $type)
                            <option value="{{ $type->getId() }}" @if(old('type') == $type->getId()) selected @endif>
                                {{ $type->getName() }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="serviceTime">Время в мин.</label>
                    <input type="text" class="form-control" id="serviceTime" name="time" value="{{ old('time') }}"
                           autocomplete="false" required>
                    @if ($errors->has('time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('time') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="serviceCost">Стоимость</label>
                    <input type="text" class="form-control" id="serviceCost" name="cost" value="{{ old('cost') }}"
                           autocomplete="false" required>
                    @if ($errors->has('cost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cost') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Создать</button>
        <a href="{{ route('services') }}" class="btn btn-default">Отмена</a>
    </form>
@endsection
