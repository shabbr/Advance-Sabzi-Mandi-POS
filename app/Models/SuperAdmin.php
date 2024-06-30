<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;

class SuperAdmin extends Model
{
    use HasFactory;
    public function seller(){
        return $this->belongsTo(Seller::class);
    }

}
