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
use Session;
use Crypt;
use DB;
use Excel;
use Response;
use Illuminate\Contracts\Encryption\DecryptException;

class RekapanController extends Controller
{
    public function index()
    {
      $data['data'] = DB::select(
        DB::raw(
          "SELECT a.id as id,
            a.spk as spk,
            a.source as source,
            a.year as year,
            b.id as id_invoice,
            b.invoice as invoice,
            b.termin as termin,
            c.id as id_no_payment,
            c.no_payment as no_payment,
            d.id as id_no_pay,
            d.no_pay as no_pay
          From scholarships a
          LEFT OUTER JOIN account_receivables b
          ON a.id=b.id_scholarship
          LEFT OUTER JOIN account_receivable_payments c
          ON b.id=c.id_ar
          LEFT OUTER JOIN account_payables d
          ON c.id=d.id_arp"
        ));

      return view('rekap.index',$data);
    }

    public function downloadExcel($id, $id_invoice)
    {
      $id1 = crypt::decrypt($id);
      $id2 = crypt::decrypt($id_invoice);

      $beasiswa = DB::select(
        DB::raw(
          "SELECT a.*, b.id as id_invoice,
            b.invoice as invoice,
            b.termin as termin,
            b.date as date,
            b.date_end as date_end,
            c.id as id_no_payment,
            c.no_payment as no_payment,
            c.date_sp2d as date_sp2d,
            d.id as id_no_pay,
            d.no_pay as no_pay,
            d.date_payable as date_pay
          From scholarships a
          LEFT OUTER JOIN account_receivables b
          ON a.id=b.id_scholarship
          LEFT OUTER JOIN account_receivable_payments c
          ON b.id=c.id_ar
          LEFT OUTER JOIN account_payables d
          ON c.id=d.id_arp
          where a.id = $id1"
        ));

      if($id2==null) {
        $data['mahasiswa'] = scholarships_detail::where('id_scholarship',$id1)->get();
      } else {
        $data['mahasiswa'] = account_receivable_detail::where('id_ar',$id2)->get();
      }

      foreach ($beasiswa as $key) {
        $data['beasiswa'] = $key;
      }

      Excel::create('rekapan_beasiswa_'.$data['beasiswa']->source.'-'.$data['beasiswa']->year.'-'.$data['beasiswa']->termin, function($excel) use ($data) {
        $excel->sheet('invoice', function($sheet) use ($data) {
          $sheet->loadView('rekap.excel_satuan',$data);
        });
      })->export('xls');

    }
}
