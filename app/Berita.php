<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    public function user(){
    	return $this->belongsTo('App\user','id_user');
    }

    public function kategori(){
    	return $this->belongsTo('App\kategori','id_kat');
    }

    
}
