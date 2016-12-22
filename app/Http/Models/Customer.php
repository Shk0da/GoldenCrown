<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\Http\Models
 * @property integer $id
 * @property string $name
 * @property string $session
 */
class Customer extends Model
{
    protected $table = 'customers';

    public function getId()
    {
        return (int)$this->id;
    }

    public function getName()
    {
        return (string)$this->name;
    }

    public function getSession()
    {
        return (string)$this->session;
    }

    public function getOrders()
    {
        return Order::where('customer_id', '=', $this->id)->get();
    }

    public function getCost()
    {
        $cost = 0;
        $orders = $this->getOrders();

        foreach ($orders as $order) {
            $cost += $order->getService()->getCost();
        }

        return (float)$cost;
    }

}
