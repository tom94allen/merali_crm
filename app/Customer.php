<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public $fillable = ['name', 'address_line1', 'town', 'postcode', 'email', 'telephone', 'owner', 'status', 'contact_name', 'contact_role'];

    public $primaryKey = 'customer_id';

    public $table = 'customers';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function contact(){
        return $this->hasMany('App\Contact', 'contact_id');
    }

    public function task(){
        return $this->hasMany('App\Task', 'task_id');
    }

    public function customerStatus(){
        return $this->hasOne('App\CustomerStatus', 'status_id');
    }
}
