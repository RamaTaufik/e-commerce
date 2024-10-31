<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Elqouent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $guarded = [];
    
    public function customerAddress(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
