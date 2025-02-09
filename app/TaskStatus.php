<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{

    public $table = "task_status";

    public $primaryKey = 'status_id';
    
    public function task(){
        return $this->belongsTo('App\Task');
    }
}
