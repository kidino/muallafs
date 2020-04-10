<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
