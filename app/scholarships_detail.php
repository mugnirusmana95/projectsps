<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarships_detail extends Model
{
  public function colleger()
  {
      return $this->belongsTo('App\colleger','nim_colleger');
  }

  public function scholarship()
  {
      return $this->belongsTo('App\scholarship','id_scholarship');
  }
}
