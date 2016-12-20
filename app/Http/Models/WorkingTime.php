<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkingTime
 * @package App\Http\Models
 * @property integer $id
 * @property integer $employee_id
 * @property string $data
 */
class WorkingTime extends Model
{
    protected $table = 'working_time';

    public function getId()
    {
        return $this->id;
    }

}