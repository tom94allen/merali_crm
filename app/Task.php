<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function taskStatus(){
        return $this->hasone('App\TaskStatus', 'status_id');
    }

}
