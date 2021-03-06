<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class colleger extends Model
{
  protected $table = 'tbl_mahasiswa';
  protected $primaryKey = 'nim';
  public $incrementing = false;

  public function scholarship_detail()
  {
      return $this->hasMany('App\scholarships_detail');
  }

  public function account_receivable_detail()
  {
      return $this->hasMany('App\account_receivable_detail');
  }

  public function account_receivable_payment_detail()
  {
      return $this->hasMany('App\account_receivable_payment_detail');
  }

  public function prody()
  {
      return $this->belongsTo('App\studie','prodi_id');
  }

  public function faculty()
  {
      return $this->belongsTo('App\facultie','fak_id');
  }
}
