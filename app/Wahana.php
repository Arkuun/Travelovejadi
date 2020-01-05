<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wahana extends Model
{
    protected $table = 'wahana';
     public function wisata()
     {
     return $this->belongsTo('App\Wisata','id_wisata');
     }
     public function kategoriwahana()
     {
     return $this->belongsTo('App\KategoriWahana','id_kat_wahana');
     }
     public function user()
     {
     return $this->belongsTo('App\User','id_user');
     }
}
