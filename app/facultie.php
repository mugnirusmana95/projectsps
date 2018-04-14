<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facultie extends Model
{
  public function study()
  {
      return $this->hasMany('App\studie');
  }
}
