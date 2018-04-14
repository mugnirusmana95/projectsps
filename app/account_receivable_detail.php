<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_receivable_detail extends Model
{
  public function colleger()
  {
      return $this->belongsTo('App\colleger','nim_colleger');
  }

  public function account_receivable()
  {
      return $this->belongsTo('App\account_receivable','id_ar');
  }
}
