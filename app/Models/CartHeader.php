<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartHeader extends Model
{
    use HasFactory;
    protected $table='cart_headers';
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function cartDetail(){
        return $this->hasMany(CartDetail::class,'cart_id');
    }
}
