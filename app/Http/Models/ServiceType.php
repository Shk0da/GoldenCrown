<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceType
 * @package App\Http\Models
 * @property integer $id
 * @property string $name
 */
class ServiceType extends Model
{
    protected $table = 'service_types';

    public function getName()
    {
        return (string)$this->name;
    }

    public function getId()
    {
        return (int)$this->id;
    }
}