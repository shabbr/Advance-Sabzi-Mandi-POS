<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Product;
use App\Models\CustomSack;
use App\Models\Seller;

class Sale extends Model
{
    use HasFactory;
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function sack(){
        return $this->belongsTo(CustomSack::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }


}
