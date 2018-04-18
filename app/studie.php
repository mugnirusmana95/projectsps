<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studie extends Model
{
  protected $table = "tbl_prodi";
  protected $primaryKey = 'prodi_id';
  public $incrementing = false;

  public function faculty()
  {
      return $this->belongsTo('App\facultie','fak_id');
  }

  public function bppProdi()
  {
    return $this->hasMany('App\bpp_prodi');
  }
}
