<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorType extends Model
{
    public $primaryKey = 'sector_id';

    public $table = 'sector_type';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
