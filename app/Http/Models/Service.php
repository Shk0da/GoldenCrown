<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * @package App\Http\Models
 * @property integer $id
 * @property integer $type
 * @property integer $time
 * @property float $cost
 * @property string $name
 */
class Service extends Model
{
    protected $table = 'services';

    public function type()
    {
        return $this->hasOne('App\Http\Models\ServiceType', 'id', 'type');
    }

    public function getName()
    {
        return (string)$this->name;
    }

    public function getId()
    {
        return (int)$this->id;
    }

    public function getType()
    {
        $type = $this->type()->first();
        return (string)$type ? $type->getName() : null;
    }

    public function getTime()
    {
        return (string)$this->time;
    }

    public function getCost()
    {
        return (float)$this->cost;
    }

}