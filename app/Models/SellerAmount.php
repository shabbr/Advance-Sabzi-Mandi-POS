<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\BuyedProduct;


class SellerAmount extends Model
{
    use HasFactory;
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function product(){
        return $this->belongsTo(BuyedProduct::class);
    }
}
