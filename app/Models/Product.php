<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BuyedProduct;
use App\Models\Sale;
use App\Models\ReceivedProductCart;

class Product extends Model
{
    use HasFactory;

    public function buyedProducts()
    {
        return $this->hasMany(BuyedProduct::class);
    }
    public function receivedProducts()
    {
        return $this->hasMany(ReceivedProductCart::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function sellerAmount(){
        return $this->hasMany(SellerAmount::class);
    }
}
