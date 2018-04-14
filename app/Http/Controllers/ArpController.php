<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\account_receivable_payments;
use App\account_receivable_payment_detail;
use App\account_receivable;
use App\account_receivable_detail;
use App\scholarship;
use Session;
use Crypt;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ArpController extends Controller
{
    public function index()
    {
      $data['arp'] = DB::select(DB::raw(
        "SELECT a.*, c.invoice as invoice,
          (SELECT count(b.id_arp) FROM account_payables b where b.id_arp=a.id) as id_ap
        FROM account_receivable_payments a
        JOIN account_receivables c
        ON c.id=a.id_ar
        ORDER BY a.created_at DESC"
      ));

      return view('arp.index',$data);
    }

    public function create()
    {
      $data['ar'] = DB::select(DB::raw("SELECT * FROM account_receivables WHERE id NOT IN (SELECT id_ar FROM account_receivable_payments)"));

      return view('arp.create',$data);
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'invoice' => 'required',
        'sp2d' => 'required',
        'tgl' => 'required'
      ],[
        'invoice.required' => 'Field wajib dipilih.',
        'sp2d.required' => 'Field wajib diisi.',
        'tgl.required' => 'Field wajib diisi.'
      ]);

      $arp = new account_receivable_payments();
      $invoice = account_receivable::find($request->invoice);
      $scholarship = scholarship::find($invoice->id_scholarship);

      $id_sp2d = account_receivable_payments::find($request->sp2d);

      if(count($id_sp2d)>0) {
        $today = date('Y');

        $query = DB::table('account_receivable_payments')
          ->where('no_payment', 'LIKE', '%'.$today.'%')
          ->max('no_payment');
        $nourut = (int) substr($query, 0, 3);
        $nourut++;
        $pay = sprintf('%03s', $nourut).'/RCP/SPs/'.$scholarship->source.'/'.$today;
      } else {
        $pay = $request->sp2d;
      }

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);
      $tagihan = explode(".",$request->tagihan);
      $tagihan1 = implode("",$tagihan);

      $arp->no_payment = $pay;
      $arp->ref_sp2d = $request->ref_sp2d;
      $arp->date_sp2d = $request->tgl;
      $arp->termin = $request->termin;
      $arp->date = $request->tgl_tagihan;
      $arp->date_end = $request->tgl_tempo;
      $arp->bpp = $bpp1;
      $arp->tagihan = $tagihan1;
      $arp->pengelolaan = $pengelolaan1;
      $arp->id_ar = $request->invoice;
      $arp->save();

      $id = crypt::encrypt($arp->id);

      $details = account_receivable_detail::where('id_ar',$request->invoice)->get();
      if (count($details) > 0) {
        foreach ($details as $key) {
          $detail = new account_receivable_payment_detail();
          $detail->chapter1 = $key->chapter1;
          $detail->year1 = $key->year1;
          $detail->chapter2 = $key->chapter2;
          $detail->year2 = $key->year2;
          $detail->total_sks = $key->total_sks;
          $detail->total_chapter = $key->total_chapter;
          $detail->pengelolaan = $key->pengelolaan;
          $detail->bpp = $key->bpp;
          $detail->nim_colleger = $key->nim_colleger;
          $detail->id_arp = $arp->id;
          $detail->save();
        }
      }

      Session::flash('success','Data Berhasil Disimpan.');

      return redirect('pembayaran/lihat/'.$id);
    }

    public function detail($id)
    {
      try {
        $key = crypt::decrypt($id);
        $arp = DB::select(DB::raw(
          "SELECT a.*,
            c.invoice as invoice,
            c.bpp as ar_bpp,
            c.pengelolaan as ar_pengelolaan,
            c.tagihan as ar_tagihan,
            c.date as ar_date,
            c.date_end as ar_date_end,
            d.spk as spk,
            d.source as source,
            d.year as year,
            d.type as type,
            d.value as value,
            (
              SELECT count(b.id_arp)
              FROM account_payables b
              where b.id_arp=a.id
            ) as id_ap
          FROM account_receivable_payments a
          JOIN account_receivables c
          ON c.id=a.id_ar
          JOIN scholarships d
          ON d.id=c.id_scholarship
          WHERE a.id=$key"
          ));
        $data['arp_detail'] = account_receivable_payment_detail::where('id_arp',$key)->get();
        $data['id'] = $id;

        foreach ($arp as $key) {
          $data['arp'] = $key;
        }

        //dd($data['arp']);

        return view('arp.detail',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }
    }

    public function edit($id)
    {
        $key = crypt::decrypt($id);
        $data['arp'] = account_receivable_payments::find($key);
        $id_ar = $data['arp']->id_ar;
        $data['ar'] = DB::select(DB::raw(
          "SELECT * FROM account_receivables
          WHERE id NOT IN (
            SELECT id_ar FROM account_receivable_payments WHERE id_ar!='$id_ar')"
        ));
        $data['id'] = $id;

        return view('arp.edit',$data);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'ref_sp2d' => 'required',
        'tgl' => 'required',
        'termin' => 'required',
      ],[
        'ref_sp2d.required' => 'Field wajib diisi.',
        'tgl.required' => 'Field wajib diisi.',
        'termin.required' => 'Field wajib diisi.',
      ]);
      $key = crypt::decrypt($id);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);
      $tagihan = explode(".",$request->tagihan);
      $tagihan1 = implode("",$tagihan);

      $arp = account_receivable_payments::find($key);

      $arp->id_ar = $request->invoice;
      $arp->ref_sp2d = $request->ref_sp2d;
      $arp->date_sp2d = $request->tgl;
      $arp->termin = $request->termin;
      $arp->date = $request->tgl_tagihan;
      $arp->date_end = $request->tgl_tempo;
      $arp->bpp = $bpp1;
      $arp->pengelolaan = $pengelolaan1;
      $arp->tagihan = $tagihan1;
      $arp->save();

      Session::flash('success','Data Berhasil Diubah.');

      return redirect('/pembayaran/lihat/'.$id);
    }

    public function destroy($id)
    {
      $key = crypt::decrypt($id);
      $arp = account_receivable_payments::find($key);
      $arp->delete();

      $colleger = DB::select(DB::raw("DELETE FROM account_receivable_payment_details WHERE id_arp=$key"));

      Session::flash('success','Data berhasil dihapus');

      return redirect('/pembayaran');
    }

    public function searchTagihan($id)
    {
      $data['tagihan'] = account_receivable::find($id);
      $data['bpp'] = DB::table('account_receivable_details')->select(DB::raw('sum(bpp) as bpp'))->where('id_ar', $data['tagihan']->id)->first();

      return $data;
    }

    public function searchId($id)
    {
      $ar = account_receivable::find($id);
      $scholarship = scholarship::find($ar->id_scholarship);

      $today = date('Y');

      $query = DB::table('account_receivable_payments')
        ->where('no_payment', 'LIKE', '%'.$today.'%')
        ->max('no_payment');
      $nourut = (int) substr($query, 0, 3);
      $nourut++;
      $pay = sprintf('%03s', $nourut).'/RCP/SPs/'.$scholarship->source.'/'.$today;

      return $pay;
    }

}
