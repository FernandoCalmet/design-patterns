<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'date',
        'amount',
        'car_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
