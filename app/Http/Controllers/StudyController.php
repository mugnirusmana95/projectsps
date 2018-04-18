<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facultie;
use App\studie;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;

class StudyController extends Controller
{
    public function index()
    {
      $data['study'] = DB::select(DB::raw("SELECT a.*, b.* FROM tbl_prodi a LEFT JOIN tbl_fakultas b ON a.fak_id=b.fak_id"));

      return view('study.index',$data);
    }
}
