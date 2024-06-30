<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Seller;

class BuyedProduct extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function sack()
    {
        return $this->belongsTo(CustomSack::class);
    }

}
