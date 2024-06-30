<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BuyedProduct;
use App\Models\SellerAmount;
use App\Models\SuperAdmin;

class Seller extends Model
{
    use HasFactory;
    public function buyedProducts()
    {
        return $this->hasMany(BuyedProduct::class);
    }

    public function sellerAmount(){
        return $this->hasMany(SellerAmount::class);
    }
    public function sale(){
        return $this->hasMany(Sale::class);
    }
    public function superAdmin(){
        return $this->hasMany(SuperAdmin::class);
    }

    public function sellerPayment(){
        return $this->hasMany(SellerPayment::class);
    }
}
