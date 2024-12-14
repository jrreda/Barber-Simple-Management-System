<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['type', 'price', 'barber_id'];


    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }
}
