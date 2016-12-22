<?php

namespace App\Http\Controllers;


use App\Http\Models\Customer;
use App\Http\Models\Order;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->method();

        if ($type == 'POST') {
            return $this->saveOrder($request);
        }

        $view = view('main');
        return $view;
    }

    private function saveOrder($request)
    {
        $data = $request->all();

        $employee_id = (int)$data['employee'];
        $time = (string)$data['time'];
        $services = (array)$data['services'];
        $customer_name = (string)$data['customer'];
        $session = (string)$data['_token'];

        if ($employee_id && $time && $services && $customer_name && $session)
        {
            $customer = null;
            $customer = Customer::whereSession($session)->first() ?: new Customer();
            $customer->name = $customer_name;
            $customer->session = $session;
            $customer->save();

            $order = null;
            foreach ($services as $service) {

                $datetime = date('Y-m-d H:i:s', strtotime($time));

                $order = Order::where('customer_id', $customer->getId())
                    ->where('service_id', $service)
                    ->where('employee_id', $employee_id)
                    ->where('datetime', $datetime)
                    ->first();

                if ($order) continue;

                $newOrder = new Order();
                $newOrder->customer_id = $customer->getId();
                $newOrder->service_id = $service;
                $newOrder->employee_id = $employee_id;
                $newOrder->datetime = $datetime;
                $newOrder->save();
            }
        }

        $list = Customer::orderBy('id')->whereSession($session)->get();
        $view = view('success');
        $view->with('list', $list);

        return $view;
    }

}