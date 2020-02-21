<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $primaryKey = 'task_id';

    protected $dates = ['due_date'];

    protected $casts = ['due_date'  => 'datetime',];

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
