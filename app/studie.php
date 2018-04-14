<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studie extends Model
{
  public function faculty()
  {
      return $this->belongsTo('App\facultie','id_faculty');
  }
}
