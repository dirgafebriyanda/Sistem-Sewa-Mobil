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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function($query) use ($search){
                $query->where('brand', 'like', '%' . $search . '%')
                ->orWhere('model', 'like', '%' . $search . '%');
            });
        });
    }
}
