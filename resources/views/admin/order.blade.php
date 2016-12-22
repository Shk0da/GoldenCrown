@extends('admin.panel')

@section('innerContent')

    <h4>Список заказов:</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>id</td>
            <td>Имя клиента</td>
            <td>Заказы</td>
            <td>Итого</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->getId() }}</td>
                <td>{{ $item->getName() }}</td>
                <td>
                    @foreach($item->getOrders()->groupBy('datetime') as $datetime => $orders)
                        <h5>Дата записи: {{ $datetime }}</h5>
                        <?php $total = 0; ?>
                        @foreach($orders as $order)
                            <p>
                                Услуга: {{ $order->getService() ? $order->getService()->getName() : '' }}
                                ({{ $order->getService() ? $order->getService()->getCost() : 0 }}) <br>
                                Мастер: {{ $order->getEmployee() }} <br>
                            </p>
                            <?php $total += ($order->getService() ? $order->getService()->getCost() : 0); ?>
                        @endforeach
                        Стоимость: {{$total }} <br>
                        <hr>
                    @endforeach
                </td>
                <td>{{ $item->getCost() }}</td>
                <td>
                    <a class="btn btn-small btn-warning"
                       onclick="event.preventDefault();document.getElementById('destroy_{{ $item->getId() }}').submit();"
                       href="{{ route('orders.destroy', ['id' => $item->getId()]) }}">
                        Удалить
                    </a>
                    <form id="destroy_{{ $item->getId() }}"
                          action="{{ route('orders.destroy', ['id' => $item->getId()]) }}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
