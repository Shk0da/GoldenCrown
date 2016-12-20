<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Employee
 * @package App\Http\Models
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property array $time
 */
class Employee extends Model
{
    protected $table = 'employees';

    public function getName()
    {
        return (string)$this->name;
    }

    public function getId()
    {
        return (int)$this->id;
    }

    public function getPhoto()
    {
        $photo = $this->photo;
        $photo = $photo ? Storage::disk('public')->url($this->photo) : '/img/profile.jpg';

        return (string)$photo;
    }

   public function getTimes()
   {
       return (array)($this->time ? json_decode($this->time) : []);
   }

}
