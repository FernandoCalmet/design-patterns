<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'patent',
        'user_id'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
