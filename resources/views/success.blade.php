@extends('layouts.app')

@section('content')
    <div class="alert alert-success" role="alert">
        <strong>Поздравляем!</strong> Вы записались в наш чудесный салон.
    </div>
    <h4>Ваши заказы:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Заказы</td>
            <td>Итого</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>
                    @foreach($item->getOrders()->groupBy('datetime') as $datetime => $orders)
                        <h5>Дата записи: {{ $datetime }}</h5>
                        <?php $total = 0; ?>
                        @foreach($orders as $order)
                            <p>
                                Услуга: {{ $order->getService()->getName() }} ({{ $order->getService()->getCost() }}) <br>
                                Мастер: {{ $order->getEmployee() }} <br>
                            </p>
                            <?php $total += $order->getService()->getCost(); ?>
                        @endforeach
                        Стоимость: {{$total }} <br>
                        <hr>
                    @endforeach
                </td>
                <td>{{ $item->getCost() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection