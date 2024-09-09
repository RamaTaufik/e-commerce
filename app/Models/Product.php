<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = [];

    public function productPicture(): HasMany
    {
        return $this->hasMany(ProductPicture::class);
    }

    public function productVariant(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
