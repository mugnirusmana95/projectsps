<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_receivable_payment_detail extends Model
{
    public function arp()
    {
      return $this->belongsTo('App\account_receivable_payments','id_arp');
    }

    public function colleger()
    {
      return $this->belongsTo('App\colleger','nim_colleger');
    }
}
