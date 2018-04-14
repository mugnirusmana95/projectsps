<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_payable extends Model
{
  public function arp()
  {
    return $this->belongsTo('App\account_receivable_payments','id_arp');
  }

  public function ap_detail()
  {
    return $this->hasMany('App\account_payable_detail');
  }
}
