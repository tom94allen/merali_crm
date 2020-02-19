<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    public $table = 'customer_status';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
