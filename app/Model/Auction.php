<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $guarded = ['id'];
    protected $table  = 'auctions';
    protected $fillable = [
        'name_ar'       ,
        'name_en'       ,
        'price'         ,
        'hights_price'  ,
        'description_ar',
        'description_en',
        'start_auction_at',
        'end_auction_at',
        'user_id'       ,
        'product_id'    ,
        'status'        ,    
    ];

    public function bids() {
        return $this->hasMany(Bid::class);
    }
    public function user_id(){
        return $this->hasOne('App\User','id','user_id');
    }
    
    
}
