@extends('layouts.app')

@section('content')
    <h2>Онлайн-запись</h2>
    <div class="row">
        <div class="col-md-12">
            <div id="masterPanel" class="panel panel-default">
                <div class="panel-heading">Выбор мастера</div>
                <div class="panel-body">
                    <ul class="list-group col-md-4 col-md-offset-4">
                        @foreach(\App\Http\Models\Employee::all() as $employee)
                            <a data-employee="{{ $employee->getId() }}" href="#"
                               class="list-group-item text-center checkMaster">
                                <h4 class="list-group-item-heading">{{ $employee->getName() }}</h4>
                                <p class="list-group-item-text">
                                    <img height="60" src="{{ $employee->getPhoto() }}"
                                         alt="{{ $employee->getName() }}"/>
                                </p>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="servicePanel" class="panel panel-default" style="display: none">
                <div class="panel-heading">Выбор услуги</div>
                <div class="panel-body">
                    <ul class="list-group col-md-4 col-md-offset-4">
                        @foreach(\App\Http\Models\Service::all() as $service)
                            <div class="list-group-item text-center">
                                <h4 class="list-group-item-heading">
                                    {{ $service->getName() }}
                                    <input type="checkbox" name="service[]" value="{{ $service->getId() }}" data-service="{{ $service->getId() }}">
                                </h4>
                                <p class="list-group-item-text">
                                    {{ $service->getCost() }} <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
                                    <br>
                                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $service->getTime() }}
                                </p>
                            </div>
                        @endforeach
                    </ul>
                    <button class="btn btn-default checkService">Далее</button>
                </div>
            </div>
            <div id="timePanel" class="panel panel-default" style="display: none">
                <div class="panel-heading">Выбор времени</div>
                <div class="panel-body text-center">
                    <div id="datepicker" class="col-md-offset-4"></div>
                </div>
            </div>
            <div id="payPanel" class="panel panel-default" style="display: none">
                <div class="panel-heading">Оплата</div>
                <div class="panel-body">

                    <button class="btn btn-default">Записаться</button>
                </div>
            </div>
        </div>
    </div>
@endsection