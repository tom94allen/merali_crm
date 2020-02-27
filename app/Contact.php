<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    public $primaryKey = 'contact_id';

    public $table = 'contacts';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function contactType(){
        return $this->hasOne('App\ContactType', 'type_id');
    }
}
