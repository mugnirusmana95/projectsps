<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\account_receivable;
use App\account_receivable_detail;
use App\scholarship;
use App\colleger;
use App\termin;
use App\scholarships_detail;
use Session;
use Crypt;
use DB;
use Excel;
use Illuminate\Contracts\Encryption\DecryptException;

class ArController extends Controller
{
    public function index()
    {
      //Cara data aacount_receivable
      $data['ar'] = DB::select(DB::raw(
        "SELECT a.*, c.spk as spk, c.source as source, c.year as year,
          (SELECT count(b.id_ar) FROM account_receivable_payments b where b.id_ar=a.id) as id_ar
        FROM account_receivables a
        JOIN scholarships c
        ON c.id=a.id_scholarship
        ORDER BY a.created_at DESC"
      ));
      //Cara data aacount_receivable

      return view('ar.index',$data);
    }

    public function create()
    {
      $data['scholarship'] = scholarship::orderBy('spk','ASC')->get();

      return view('ar.create',$data);
    }

    public function store(Request $request)
    {
      //Validasi data dari form
      $this->validate($request,[
        'spk' => 'required',
        'invoice' => 'required',
        'termin' => 'required',
        'tgl' => 'required',
        'tempo' => 'required'
      ],[
        'spk.required' => 'Field wajib dipilih.',
        'invoice.required' => 'Field wajib diisi.',
        'termin.required' => 'Field wajib dipilih.',
        'tgl.required' => 'Field wajib diisi.',
        'tempo.required' => 'Field wajib diisi.'
      ]);
      //Validasi data dari form

      //Inisialisasi account_receivable
      $ar = new account_receivable();
      //Inisialisasi account_receivable

      //Mencari no invoice dari table account_receivable
      $id = account_receivable::find($request->invoice);
      //Mencari no invoice dari table account_receivable

      if (count($id) > 0) { //Jika no invoice belum digunakan maka gunakan
        $inv = $request->invoice;
      } //Jika no invoice belum digunakan maka gunakan
      else { //Jika no invoice sudah digunakan maka buat no invoice baru
        $scholarship = scholarship::find($request->spk);

        $today = date("Y");

        $query = DB::table('account_receivables')
          ->where('invoice', 'LIKE', '%'.$today.'%')
          ->max('invoice');
        $nourut = (int) substr($query, 0, 3);
        $nourut++;
        $inv = sprintf('%03s', $nourut).'/KWT/SPs/'.$scholarship->source.'/'.$today;
      } //Jika no invoice sudah digunakan maka buat no invoice baru,

      //Implode & Explode inputan Rupiah
      $bpp = explode(".",$request->bpp);
      $bpp1 = implode('',$bpp);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode('',$pengelolaan);
      $tagihan = explode(".",$request->tagihan);
      $tagihan1 = implode('',$tagihan);
      //Implode & Explode inputan Rupiah

      //Simpan data ke table account_payable
      $ar->invoice = $inv;
      $ar->termin = $request->termin2;
      $ar->bpp = $bpp1;
      $ar->pengelolaan = $pengelolaan1;
      $ar->tagihan = $tagihan1;
      $ar->date = $request->tgl;
      $ar->date_end = $request->tempo;
      $ar->id_scholarship = $request->spk;
      $ar->id_termin = $request->termin3;
      $ar->save();
      //Simpan data ke table account_payable

      //Mengenkrip id
      $key2 = crypt::encrypt($ar->id);
      //Mengenkrip id

      //Mencari data mahasiswa dari table scholarships_detail
      $details = scholarships_detail::where('id_scholarship',$ar->id_scholarship)->get();
      //Mencari data mahasiswa dari table scholarships_detail

      if (count($details) > 0) { //Jika di table scholarships_detail ada lebih dari 0 mahasiswa
        foreach ($details as $key) { //Maka looping data tersebut
          $detail = new account_receivable_detail(); //Simpan data tersebut ke table account_receivable_detail
          $detail->chapter1 = $key->chapter1;
          $detail->year1 = $key->year1;
          $detail->chapter2 = $key->chapter2;
          $detail->year2 = $key->year2;
          $detail->total_sks = $key->total_sks;
          $detail->total_chapter = $key->total_chapter;
          $detail->pengelolaan = $key->pengelolaan;
          $detail->bpp = $key->bpp;
          $detail->nim_colleger = $key->nim_colleger;
          $detail->id_ar = $ar->id;
          $detail->save();//Simpan data tersebut ke table account_receivable_detail
        } //Maka looping data tersebut
      } //Jika di table scholarships_detail ada lebih dari 0 mahasiswa

      Session::flash('success','Data berhasil disimpan.');

      return redirect('tagihan/lihat/'.$key2);
    }

    public function detail($id)
    {
      try {
        $key = crypt::decrypt($id);
        $ar = DB::select(DB::raw(
          "SELECT a.*, c.spk as spk, c.source as source, c.year as year, c.type as type, c.value as value,
            (SELECT count(b.id_ar) FROM account_receivable_payments b where b.id_ar=a.id) as id_ar
          FROM account_receivables a
          JOIN scholarships c
          ON c.id=a.id_scholarship
          WHERE a.id=$key
          ORDER BY a.created_at DESC"
        ));
        $data['ard'] = account_receivable_detail::where('id_ar',$key)->get();
        $data['id'] = crypt::encrypt($key);

        foreach ($ar as $key) {
          $data['ar'] = $key;
        }

        return view('ar.detail',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function edit($id)
    {
      try {
        $data['ar'] = account_receivable::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['ar']->id);
        $id_termin = $data['ar']->id_termin;
        $scholarship = scholarship::find($data['ar']->id_scholarship);
        $data['termin'] = DB::select(
          DB::raw(
            "SELECT * FROM termins
            WHERE id_scholarship='$scholarship->id'
            AND id NOT IN
            ( SELECT id_termin
              FROM account_receivables
              WHERE id_termin!='$id_termin')"
          ));

        return view('ar.edit',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'date' => 'required',
        'date_end' => 'required'
      ],[
        'date.required' => 'Field wajib diisi.',
        'date_end.required' => 'Field wajib diisi.'
      ]);

      $key= crypt::decrypt($id);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);
      $tagihan = explode(".",$request->tagihan);
      $tagihan1 = implode("",$tagihan);

      $ar = account_receivable::find($key);
      $ar->id_termin = $request->termin3;
      $ar->termin = $request->termin2;
      $ar->date = $request->date;
      $ar->date_end = $request->date_end;
      $ar->bpp = $bpp1;
      $ar->pengelolaan = $pengelolaan1;
      $ar->tagihan = $tagihan1;
      $ar->save();

      Session::flash('success','Data berhasil diubah.');

      return redirect('/tagihan/lihat/'.$id);
    }

    public function destroy($id)
    {
      $key = crypt::decrypt($id);
      $ar = account_receivable::find($key);
      $ar->delete();

      $colleger = DB::select(DB::raw("DELETE FROM account_receivable_details where id_ar='$key'"));

      Session::flash('success','Data berhasil dihapus.');

      return redirect('/tagihan');

    }

    public function createMahasiswa($id)
    {
      $data['ar'] = account_receivable::find(crypt::decrypt($id));
      $data['ard'] = account_receivable_detail::where('id_ar',$data['ar']->id)->get();
      $data['id'] = crypt::encrypt($data['ar']->id);
      $data['colleger'] = colleger::orderBy('nim','ASC')->get();
      $data['scholarship'] = scholarship::find($data['ar']->id_scholarship);

      return view('ar.create_mahasiswa',$data);
    }

    public function storeMahasiswa(Request $request, $id)
    {
      $ars = count($request->nim);
      if ($ars > 0) {
        $ar = account_receivable::find(crypt::decrypt($id));

        foreach ($request->nim as $name => $value) {
          $pengelolaan = explode(".",$request->pengelolaan[$name]);
          $pengelolaan1 = implode("",$pengelolaan);
          $bpp = explode(".",$request->bpp[$name]);
          $bpp1 = implode("",$bpp);

          $detail = new account_receivable_detail();
          $detail->chapter1 = $request->semester1[$name];
          $detail->year1 = $request->tahun1[$name];
          $detail->chapter2 = $request->semester2[$name];
          $detail->year2 = $request->tahun2[$name];
          $detail->total_sks = $request->jmlsks[$name];
          $detail->total_chapter = $request->jmlsemester[$name];
          $detail->pengelolaan = $pengelolaan1;
          $detail->bpp = $bpp1;
          $detail->nim_colleger = $request->nim[$name];
          $detail->id_ar = $ar->id;
          $detail->save();
        }

        Session::flash('success','Data berhasil disimpan.');

        return back();
      } else {
        Session::flash('error','Tidak ada field.');

        return back();
      }
    }

    public function editMahasiswa($id)
    {
      $key = crypt::decrypt($id);
      $data['colleger'] = account_receivable_detail::find($key);
      $data['id'] = crypt::encrypt($data['colleger']->id_ar);

      return view('ar.edit_mahasiswa',$data);
    }

    public function updateMahasiswa(Request $request, $id)
    {
      $this->validate($request,[
        'nim' => 'required',
        'chapter1' => 'required',
        'year1' => 'required',
        'chapter2' => 'required',
        'year2' => 'required',
      ],[
        'nim.required' => 'Field wajib diisi.',
        'chapter1.required' => 'Field wajib dipilih.',
        'year1.required' => 'Field wajib diisi.',
        'chapter2.required' => 'Field wajib dipilih.',
        'year2.required' => 'Field wajib diisi.',
      ]);

      $key = crypt::decrypt($id);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);

      $colleger = account_receivable_detail::find($key);
      $colleger->chapter1 = $request->chapter1;
      $colleger->year1 = $request->year1;
      $colleger->chapter2 = $request->chapter2;
      $colleger->year2 = $request->year2;
      $colleger->total_sks = $request->total_sks;
      $colleger->total_chapter = $request->total_chapter;
      $colleger->bpp = $bpp1;
      $colleger->pengelolaan = $pengelolaan1;
      $colleger->save();
      $id = crypt::encrypt($colleger->id_ar);

      Session::flash('success','Data berhasil diupdate.');

      return redirect('/tagihan/lihat/'.$id);
    }

    public function destroyMahasiswa($id)
    {
      $detail = account_receivable_detail::find(crypt::decrypt($id));
      $detail->delete();

      Session::flash('success','Data berhasil dihapus.');

      return back();
    }

    public function printInvoice($id)
    {
      $data['invoice'] = account_receivable::find(crypt::decrypt($id));

      return view('ar.print',$data);
    }

    public function downloadExcel($id)
    {
      $key = crypt::decrypt($id);
      $data['data1'] = account_receivable::find($key);
      $data['data2'] = scholarship::find($data['data1']->id_scholarship);
      $data['data3'] = account_receivable_detail::with('account_receivable')->where('id_ar',$key)->get();
      $total = DB::table('account_receivable_details')->select(DB::raw('sum((bpp + pengelolaan) * total_chapter) as total'))->where('id_ar', $key)->first();
      $data['total_colleger'] = (int)$total->total;

      return Excel::create('tagihan(invoie)_'.$data['data1']->invoice, function($excel) use ($data) {
        $excel->sheet('invoice2', function($sheet) use ($data) {
          $sheet->loadView('ar.excel',$data);
        });
      })->export('xls');

    }

    public function searchTermin($id)
    {
      $scholarship = scholarship::find($id);
      $termin = DB::select(DB::raw("SELECT * FROM termins WHERE id_scholarship='$scholarship->id' AND id NOT IN (select id_termin from account_receivables)"));

      return $termin;
    }

    public function searchTagihan($id)
    {
      $data['tagihan'] = termin::find($id);
      $data['scholarship'] = scholarship::find($data['tagihan']->id_scholarship);
      $data['bpp'] = $data['bpp'] = DB::table('scholarships_details')->select(DB::raw('sum(bpp) as bpp'))->where('id_scholarship', $data['scholarship']->id)->first();

      return $data;
    }

    public function searchInvoice($id)
    {
      $scholarship = scholarship::find($id);

      $today = date("Y");

      $query = DB::table('account_receivables')
        ->where('invoice', 'LIKE', '%'.$today.'%')
        ->max('invoice');
      $nourut = (int) substr($query, 0, 3);
      $nourut++;
      $inv = sprintf('%03s', $nourut).'/KWT/SPs/'.$scholarship->source.'/'.$today;

      return $inv;
    }

    public function findStudent(Request $req)
    {
      $term = trim($req->q);

      $student = Colleger::where('name','LIKE', '%'.$term.'%')
                          ->orWhere('nim','LIKE', '%'.$term.'%')
                          ->get()
                          ->take(20);
      $colleger = [];

      foreach ($student as $item) {
          $colleger[] = ['id' => $item->nim, 'text' => $item->name];
      }


      return response()->json($colleger);
    }
}
