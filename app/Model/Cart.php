<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table  = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',  
    ];
    public function product_id() {
        return $this->hasOne('App\Model\Country','id','product_id');
    }
    public function user_id() {
        return $this->hasOne('App\Model\Country','id','user_id');
    }
}
