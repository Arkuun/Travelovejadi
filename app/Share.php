<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    //
    protected $table = 'share_moment';
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }
}
