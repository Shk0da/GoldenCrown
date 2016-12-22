<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Http\Models
 * @property integer $id
 * @property integer $customer_id
 * @property integer $service_id
 * @property integer $employee_id
 * @property string $datetime
 */
class Order extends Model
{
    protected $table = 'orders';

    public function customer()
    {
        return $this->hasOne('App\Http\Models\Customer', 'id', 'customer_id');
    }

    public function service()
    {
        return $this->hasOne('App\Http\Models\Service', 'id', 'service_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Http\Models\Employee', 'id', 'employee_id');
    }

    public function getEmployee()
    {
        $employee = $this->employee()->first();
        return (string)$employee ? $employee->getName() : null;
    }

    public function getService()
    {
        return $this->service()->first();
    }

    public function getId()
    {
        return (int)$this->id;
    }

    public function getCustomerId()
    {
        return (int)$this->customer_id;
    }

    public function getServiceId()
    {
        return (int)$this->service_id;
    }

    public function getEmployeeId()
    {
        return (int)$this->employee_id;
    }

    public function getDatetime()
    {
        return (string)$this->datetime;
    }

}
