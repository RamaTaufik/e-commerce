<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipments';

    protected $guarded = [];
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
