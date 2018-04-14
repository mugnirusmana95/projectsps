<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class termin extends Model
{
  public function account_receivable()
  {
      return $this->hasMany('App\account_receivable');
  }

  public function scholarship()
  {
      return $this->belongsTo('App\scholarship','id_scholarship');
  }
}
