<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    public $table = 'customer_status';

    public $primaryKey = 'status_id';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
