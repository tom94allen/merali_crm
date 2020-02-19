<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function contactType(){
        return $this->hasOne('App\ContactType', 'type_id');
    }
}
