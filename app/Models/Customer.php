<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illumiante\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $guarded = [];
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
