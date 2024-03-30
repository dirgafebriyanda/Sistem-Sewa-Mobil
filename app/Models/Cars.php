<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

     public function rentals()
    {
        return $this->hasMany(Rentals::class);
    }
}
