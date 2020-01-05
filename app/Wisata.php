<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    
    public function user()
    {
    	return $this->belongsTo('App\user','id_user');
    }
}

