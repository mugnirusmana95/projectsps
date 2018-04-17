<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\account_payable;
use App\account_payable_detail;
use App\account_receivable_payments;
use App\account_receivable_payment_detail;
use App\account_receivable;
use App\account_receivable_detail;
use App\scholarship;
use App\scholarships_detail;
use App\colleger;
use App\termin;
use Session;
use Crypt;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ApController extends Controller
{
    public function index()
    {
      $data['ap'] = DB::select(DB::raw(
        "SELECT a.*, b.no_payment as no_payment
        FROM account_payables a
        JOIN account_receivable_payments b
        ON a.id_arp=b.id
        ORDER BY a.created_at DESC"
      ));

      return view('ap.index',$data);
    }

    public function create()
    {
      $data['ap'] = DB::select(DB::raw("SELECT * FROM account_receivable_payments WHERE id NOT IN (SELECT id_arp FROM account_payables)"));

      return view('ap.create',$data);
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'id' => 'required',
        'payment' => 'required',
        'tgl' => 'required'
      ],[
        'id.required' => 'Field wajib diisi.',
        'payment.required' => 'Field wajib dipilih.',
        'tgl.required' => 'Field wajib diisi.'
      ]);

      $ap = new account_payable();

      $arp = account_receivable_payments::find($request->payment);
      $ar = account_receivable::find($arp->id_ar);
      $scholarship = scholarship::find($ar->id_scholarship);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $tagihan = explode(".",$request->tagihan);
      $tagihan1 = implode("",$tagihan);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);

      $ap->no_pay = $request->id;
      $ap->date_payable = $request->tgl;
      $ap->invoice = $request->invoice;
      $ap->termin = $request->termin;
      $ap->date = $request->tgl_tagihan;
      $ap->date_end = $request->tgl_tempo;
      $ap->bpp = $bpp1;
      $ap->pengelolaan = $pengelolaan1;
      $ap->tagihan = $tagihan1;
      $ap->id_arp = $request->payment;
      $ap->save();

      $id = crypt::encrypt($ap->id);

      $details = account_receivable_payment_detail::where('id_arp',$request->payment)->get();
      if (count($details) > 0) {
        foreach ($details as $key) {
          $detail = new account_payable_detail();
          $detail->chapter1 = $key->chapter1;
          $detail->year1 = $key->year1;
          $detail->chapter2 = $key->chapter2;
          $detail->year2 = $key->year2;
          $detail->total_sks = $key->total_sks;
          $detail->total_chapter = $key->total_chapter;
          $detail->pengelolaan = $key->pengelolaan;
          $detail->bpp = $key->bpp;
          $detail->biaya_hidup = $key->biaya_hidup;
          $detail->biaya_buku = $key->biaya_buku;
          $detail->biaya_penelitian = $key->biaya_penelitian;
          $detail->nim_colleger = $key->nim_colleger;
          $detail->id_ap = $ap->id;
          $detail->save();
        }
      }

      Session::flash('success','Data Berhasil Disimpan.');

      return redirect('/penagihan/lihat/'.$id);
    }

    public function detail($id)
    {
      try {
        $data['ap'] = account_payable::find(crypt::decrypt($id));
        $data['colleger'] = account_payable_detail::where('id_ap',$data['ap']->id)->get();
        $data['id'] = $id;

        return view('ap.detail',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }
    }

    public function edit($id)
    {
      $key = crypt::decrypt($id);
      $data['ap'] = account_payable::find($key);
      $id_arp = $data['ap']->id_arp;
      $data['arp'] = DB::select(DB::raw(
        "SELECT * FROM account_receivable_payments WHERE id NOT IN (SELECT id_arp FROM account_payables WHERE id_arp!='$id_arp')"
      ));
      $data['id'] = $id;

      return view('ap.edit',$data);
    }

    public function update(Request $request, $id)
    {
      $key = crypt::decrypt($id);
      $ap = account_payable::find($key);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $tagihan = explode(".",$request->tagihan);
      $tagihan1 = implode("",$tagihan);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);

      $ap->no_pay = $request->id;
      $ap->date_payable = $request->tgl;
      $ap->invoice = $request->invoice;
      $ap->termin = $request->termin;
      $ap->date = $request->tgl_tagihan;
      $ap->date_end = $request->tgl_tempo;
      $ap->bpp = $bpp1;
      $ap->pengelolaan = $pengelolaan1;
      $ap->tagihan = $tagihan1;
      $ap->id_arp = $request->sp2d;
      $ap->save();

      Session::flash('success','Data berhasil diubah.');

      return redirect('/penagihan/lihat/'.$id);
    }

    public function destroy($id)
    {
      $key = crypt::decrypt($id);
      $ap = account_payable::find($key);
      $ap->delete();

      $colleger = DB::select(DB::raw("DELETE FROM account_payable_details WHERE id_ap = $key"));

      Session::flash('success','Data berhasil dihapus.');

      return redirect('/penagihan');
    }

    public function searchNopay($id)
    {
      $data['arp'] = account_receivable_payments::find($id);
      $data['tagihan'] = account_receivable::find($data['arp']->id_ar);
      $data['bpp'] = DB::table('account_receivable_payment_details')->select(DB::raw('sum(bpp) as bpp'))->where('id_arp', $data['arp']->id)->first();

      return $data;
    }

}
