<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_receivable_payments extends Model
{
  public function ar()
  {
    return $this->belongsTo('App\account_receivable','id_ar');
  }

  public function arp_detail()
  {
    return $this->hasMany('App\account_receivable_payment_detail');
  }

  public function ap()
  {
    return $this->hasMany('App\account_payable');
  }
}
