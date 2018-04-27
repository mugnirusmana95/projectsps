<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\scholarship;
use App\scholarships_detail;
use App\account_receivable;
use App\account_receivable_detail;
use App\account_receivable_payments;
use App\account_receivable_payment_detail;
use App\account_payable;
use App\account_payable_detail;
use App\termin;
use Session;
use Crypt;
use DB;
use Excel;
use Response;
use Illuminate\Contracts\Encryption\DecryptException;

class RekapanController extends Controller
{
    public function indexKeuangan()
    {
      $data['scholarship'] = scholarship::orderBy('year','DESC')->orderBy('spk')->get();

      return view('rekap.indexkeuangan',$data);
    }

    public function downloadKeuangan(Request $request)
    {
      $data['s'] = scholarship::find($request->spk);
      $id_scholarship = $data['s']->id;
      $data['ar'] = account_receivable::with('scholarship')->where('id_termin',$request->termin)->where('id_scholarship',$id_scholarship)->first();
      $id_ar = $data['ar']->id;
      $data['ard'] = account_receivable_detail::with('colleger')->where('id_ar',$id_ar)->get();

      Excel::create('Laporan Keuangan - '.$data['s']->source.' - '.$data['s']->year, function($excel) use ($data) {
        $excel->sheet('Keuangan', function($sheet) use ($data) {
          $sheet->loadView('rekap.excelKeuangan',$data);
        });
      })->export('xls');
    }

    public function findTermin($val)
    {
      $scholarship = scholarship::find($val);
      $termin = termin::where('id_scholarship',$scholarship->id)->get();

      return $termin;
    }
}
