<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bpp_prodi extends Model
{
    public function prody()
    {
      return $this->belongsTo('App\studie','prodi_id');
    }
}
