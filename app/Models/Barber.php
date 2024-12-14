<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }
}
