<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/times', function (Request $request) {

    $employee_id = (int)$request->get('employee');

    $employee = \App\Http\Models\Employee::find($employee_id);
    $times = $employee ? $employee->getTimes() : [];

    $orders = \App\Http\Models\Order::whereEmployeeId($employee_id)->get();

    $booking_times = [];
    $starts = [];
    $ends = [];
    $employeeTimeBooking = 0;
    foreach ($orders as $order) {
        $start = date('d.m.Y H:i', strtotime($order->getDatetime()));
        $end = date('d.m.Y H:i', strtotime($order->getDatetime() . "+{$order->getService()->getTime()} minutes"));

        foreach ($starts as $id => $row) {
            if ($row == $start) {
                $currtime = strtotime($end) - strtotime($start);
                $end = date('Y-m-d H:i', strtotime($end) + $currtime);
            }
        }

        $employeeTimeBooking += $order->getService()->getTime();
        $starts[] = $start;
        $ends[] = $end;
        $booking_times[] = [
            'start' => $start,
            'end' => $end,
        ];
    }

    $result = [
        'times' => $times,
        'bookingTimes' => $booking_times,
    ];

    echo json_encode($result);
    exit;
});
