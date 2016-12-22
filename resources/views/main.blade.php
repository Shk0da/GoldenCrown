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
                            <a data-employee="{{ $employee->getId() }}"
                               data-employee-name="{{ $employee->getName() }}"
                               href="#"
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
                <div class="panel-heading">
                    <button class="btn btn-default backService">Назад</button>
                    Выбор услуги
                </div>
                <div class="panel-body">
                    <ul class="list-group col-md-4 col-md-offset-4">
                        @foreach(\App\Http\Models\Service::all() as $service)
                            <div class="list-group-item text-center service"
                                 data-service="{{ $service->getId() }}"
                                 data-service-name="{{ $service->getName() }}"
                                 data-service-cost="{{ $service->getCost() }}"
                            >
                                <h4 class="list-group-item-heading">
                                    {{ $service->getName() }}
                                </h4>
                                <p class="list-group-item-text">
                                    {{ $service->getCost() }}
                                    <span class="glyphicon glyphicon-euro" aria-hidden="true">
                                    </span>
                                    <br>
                                    <span class="glyphicon glyphicon-time" aria-hidden="true">
                                    </span> {{ $service->getTime() }}
                                </p>
                            </div>
                        @endforeach
                    </ul>
                    <button class="btn btn-default checkService">Далее</button>
                </div>
            </div>
            <div id="timePanel" class="panel panel-default" style="display: none">
                <div class="panel-heading">
                    <button class="btn btn-default backTime">Назад</button>
                    Выбор времени
                </div>
                <div class="panel-body text-center">
                    <div id="datepicker" class="col-md-offset-4"></div>
                    <div id="datapicker-time"></div>
                    <div class="h-pull-right" style="display: none">
                        <button class="btn btn-default checkTime">Далее</button>
                    </div>
                </div>
            </div>
            <div id="payPanel" class="panel panel-default" style="display: none">
                <div class="panel-heading">
                    <button class="btn btn-default backPay">Назад</button>
                    Оплата
                </div>
                <div class="panel-body">
                    <div class="panel panel-default credit-card-box col-md-offset-3 col-md-5">
                        <div class="panel-body">
                            <form role="form" id="payment-form" method="POST" action="">

                                <div class="row">
                                    <div id="total"></div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="cardNumber">Ваше имя</label>
                                            <div class="input-group">
                                                <input
                                                        class="form-control"
                                                        name="customer"
                                                        placeholder="Иван Иванов"
                                                        required autofocus
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="cardNumber">Номер карты</label>
                                            <div class="input-group">
                                                <input
                                                        type="tel"
                                                        class="form-control"
                                                        name="cardNumber"
                                                        placeholder="0000 0000 0000 0000"
                                                        autocomplete="cc-number"
                                                        required autofocus
                                                />
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label for="cardExpiry">
                                                <span class="hidden-xs">Срок действия</span>
                                            </label>
                                            <input
                                                    type="tel"
                                                    class="form-control"
                                                    name="cardExpiry"
                                                    placeholder="MM / YY"
                                                    autocomplete="cc-exp"
                                                    required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label for="cardCVC">CVС</label>
                                            <input
                                                    type="tel"
                                                    class="form-control"
                                                    name="cardCVC"
                                                    placeholder="123"
                                                    autocomplete="cc-csc"
                                                    required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="subscribe btn btn-success btn-lg btn-block" type="submit">
                                            Оплатить и записаться
                                        </button>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection