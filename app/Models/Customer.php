<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Payment;


class Customer extends Model
{
    use HasFactory;
    public function sale(){
        return $this->hasMany(Sale::class);
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
