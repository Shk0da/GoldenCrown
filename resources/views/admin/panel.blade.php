@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ route('panel') }}">Панель управления салоном</a></div>
                <div class="panel-body">
                    @section('innerContent')
                        <div class="row text-center">
                            <h3>Добро пожаловать в панель управления Салона "{{ config('app.name', 'Золотая корона') }}"</h3>
                            <hr>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h3>Сотрудники ({{ App\Http\Models\Employee::count() }})</h3>
                                        <p>
                                            В этом раздеде вы можете управлять своими сотрудниками
                                        </p>
                                        <p>
                                            <a href="{{ route('employee') }}" class="btn btn-default" role="button">Перейти</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h3>Типы услуг ({{ App\Http\Models\ServiceType::count() }})</h3>
                                        <p>
                                            В этом раздеде вы можете категоризировать услуги
                                        </p>
                                        <p>
                                            <a href="{{ route('service.types') }}" class="btn btn-default" role="button">Перейти</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h3>Услуги ({{ App\Http\Models\Service::count() }})</h3>
                                        <p>
                                            В этом раздеде вы можете управлять услугами салона
                                        </p>
                                        <p>
                                            <a href="{{ route('services') }}" class="btn btn-default" role="button">Перейти</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h3>Заказы ({{ count(App\Http\Models\Order::select('customer_id')->groupBy('customer_id')->get()) }})</h3>
                                        <p>
                                            В этом раздеде вы можете посмотреть заказы
                                        </p>
                                        <p>
                                            <a href="{{ route('orders') }}" class="btn btn-default" role="button">Перейти</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @show
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
