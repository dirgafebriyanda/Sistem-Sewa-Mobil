<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id', 'id');
    }

     public function returns()
    {
        return $this->hasOne(Returns::class);
    }
}
