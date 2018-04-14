<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_payable_detail extends Model
{
  public function ap()
  {
    return $this->belongsTo('App\account_payable','id_ap');
  }

  public function colleger()
  {
    return $this->belongsTo('App\colleger','nim_colleger');
  }
}
