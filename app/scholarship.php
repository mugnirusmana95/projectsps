<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarship extends Model
{
  public function scholarship_detail()
  {
      return $this->hasMany('App\scholarships_detail');
  }

  public function termin()
  {
      return $this->hasMany('App\termin');
  }

  public function account_receivable()
  {
      return $this->hasMany('App\account_receivable','id_scholarship');
  }
}
