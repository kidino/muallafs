<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Muallaf extends Model
{

    public function notes() {
        return $this->hasMany('App\Note', 'muallaf_id', 'id');
    }
    
}
