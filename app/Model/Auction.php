<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $guarded = ['id'];

    public function bids() {
        return $this->hasMany(Bid::class);
    }
    public function user_id(){
        return $this->hasOne('App\User','id','user_id');
    }
    
    
}
