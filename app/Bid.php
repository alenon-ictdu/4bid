<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function product() {
    	return $this->belongsTo('App\Product');
    }
}
