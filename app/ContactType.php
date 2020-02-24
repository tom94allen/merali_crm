<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{

    public $primaryKey = 'type_id';

    public $table = 'contact_type';

    public function contact(){
        return $this->belongsTo('App\Contact');
    }
}
