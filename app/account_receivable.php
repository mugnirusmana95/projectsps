<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_receivable extends Model
{
  public function scholarship()
  {
      return $this->belongsTo('App\scholarship','id_scholarship');
  }

  public function account_receivable_detail()
  {
      return $this->hasMany('App\account_receivable_detail');
  }

  public function termins()
  {
      return $this->belongsTo('App\termin','id_termin');
  }

  public function account_receivable_payment()
  {
     return $this->hasMany('App\account_receivable_payments');
  }
}
