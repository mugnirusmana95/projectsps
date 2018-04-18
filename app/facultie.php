<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facultie extends Model
{

  protected $table = "tbl_fakultas";
  protected $primaryKey = "fak_id";
  public  $incrementing = false;

  public function study()
  {
      return $this->hasMany('App\studie');
  }
}
