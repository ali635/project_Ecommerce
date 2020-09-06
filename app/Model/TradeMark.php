<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model {
	protected $table    = 'trade_marks';
	protected $fillable = [
		'name_ar',
		'name_en',
		'logo',
    ];

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
