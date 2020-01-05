<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{ 
	protected $table = 'event';
	 public function wisata()
     {
     return $this->belongsTo('App\Wisata','id_wisata');
     }
     public function user()
     {
     return $this->belongsTo('App\user','id_user');
     }
    
}
