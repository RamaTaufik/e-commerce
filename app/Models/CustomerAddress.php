<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Elqouent\Relations\HasMany;
use Illuminate\Database\Elqouent\Relations\BelongsTo;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $table = 'customer_addresses';

    protected $guarded = [];
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
