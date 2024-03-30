<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

     public function rentals()
    {
        return $this->belongsTo(Rentals::class, 'rental_id','id');
    }

}
