<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRecord extends Model
{
    use HasFactory;

    protected $table = 'service_records';

    protected $fillable = [
        'service_date',
        'extra_fees',
        'notes',
        'barber_id',
        'service_id',
    ];

    protected $casts = [
        'service_date' => 'datetime',
    ];

    // Relationship with Barber
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
