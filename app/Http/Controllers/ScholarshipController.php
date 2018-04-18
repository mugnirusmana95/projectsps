<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\scholarship;
use App\scholarships_detail;
use App\source_of_scholarship;
use App\type_of_scholarship;
use App\colleger;
use App\termin;
use App\bpp_prodi;
use Session;
use Crypt;
use DB;
use Excel;
use Illuminate\Contracts\Encryption\DecryptException;

class ScholarshipController extends Controller
{
    public function index()
    {
      $data['scholarship'] = DB::select(DB::raw(
        "SELECT a.*,
          (SELECT count(b.id_scholarship) FROM termins b where b.id_scholarship=a.id) as termin
        FROM scholarships a
        ORDER BY a.created_at DESC"
      ));

      return view('scholarship.index',$data);
    }

    public function create()
    {
      $data['source'] = source_of_scholarship::orderBy('name')->get();
      $data['type'] = type_of_scholarship::orderBy('name')->get();
      $data['year'] = date('Y'); //Year now
      $data['year2'] = $data['year']-10; //Year now, min 10 years

      return view('scholarship.create',$data);
    }

    public function store(Request $request)
    {
      $scholarship = new scholarship();
      $scholarship2 = source_of_scholarship::where('name',$request->source)->first();

      $nilai1 = explode(".",$request->nilai);
      $nilai2 = implode('',$nilai1);

      $this->validate($request,[
        'spk' => 'required|unique:scholarships',
        'year' => 'required',
        'source'  => 'required',
        'nilai'  => 'required'
      ],[
        'spk.required' => 'Field wajib diisi.',
        'spk.unique' => 'No. SPK sudah digunakan.',
        'year.required' => 'Field wajib dipilih.',
        'source.required' => 'Field wajib dipilih.',
        'nilai.required' => 'Field wajib diisi.'
      ]);

      $scholarship->spk = $request->spk;
      $scholarship->year = $request->year;
      $scholarship->source = $request->source;
      $scholarship->bpp = $scholarship2->bpp;
      $scholarship->type = $request->type;
      $scholarship->value = $nilai2;
      $scholarship->save();

      Session::flash('success','Beasiswa berhasil disimpan');

      return redirect('/beasiswa/lihat/'.crypt::encrypt($scholarship->id));
    }

    public function detail($id)
    {
      try {
        $key = crypt::decrypt($id);
        $beasiswa = DB::select(DB::raw(
          "SELECT a.*,
            (SELECT count(b.id_scholarship) FROM termins b where b.id_scholarship=a.id) as termin
          FROM scholarships a
          where a.id=$key"
        ));
        $data['scholarship'] = scholarship::find($key);
        $data['detail'] = scholarships_detail::where('id_scholarship',$key)->get();
        $data['termin'] = DB::select(DB::raw(
          "SELECT a.*, b.id as id_ar FROM termins a
          LEFT OUTER JOIN account_receivables b
          ON a.id=b.id_termin
          WHERE a.id_scholarship=$key"
        ));;
        $data['total_pemegang'] = DB::table('scholarships_details')->select(DB::raw('sum((bpp + pengelolaan + biaya_hidup + biaya_buku + biaya_penelitian) * total_chapter) as total'))->where('id_scholarship', $key)->first();
        $data['total_termin'] = DB::table('termins')->select(DB::raw('sum(bpp + pengelolaan) as total'))->where('id_scholarship', $key)->first();
        $data['id'] = $id;

        foreach ($beasiswa as $key) {
          $data['scholarship'] = $key;
        }

        return view('scholarship.detail',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function edit($id)
    {
      try {
        $data['scholarship'] = scholarship::find(crypt::decrypt($id));
        $data['source'] = source_of_scholarship::orderBy('name')->get();
        $data['type'] = type_of_scholarship::orderBy('name')->get();
        $data['year'] = date('Y'); //Year now
        $data['year2'] = $data['year']-10; //Year now, min 10 years
        $data['id'] = crypt::encrypt($data['scholarship']->id);

        return view('scholarship.edit',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function update(Request $request, $id)
    {
      $scholarship = scholarship::find(crypt::decrypt($id));

      if($scholarship->spk  == $request->spk) {
        $this->validate($request,[
          'year' => 'required',
          'source'  => 'required',
          'nilai'  => 'required'
        ],[
          'year.required' => 'Field wajib dipilih.',
          'source.required' => 'Field wajib dipilih.',
          'nilai.required' => 'Field wajib diiisi.'
        ]);
      } else {
        $this->validate($request,[
          'spk' => 'unique:scholarships',
          'year' => 'required',
          'source'  => 'required',
          'nilai'  => 'required'
        ],[
          'spk.unique' => 'No. SPK sudah digunakan.',
          'year.required' => 'Field wajib dipilih.',
          'source.required' => 'Field wajib dipilih.',
          'nilai.required' => 'Field wajib diiisi.'
        ]);
      }
      $nilai = explode(".",$request->nilai);
      $nilai1 = implode('',$nilai);

      $scholarship->spk = $request->spk;
      $scholarship->year = $request->year;
      $scholarship->source = $request->source;
      $scholarship->type = $request->type;
      $scholarship->value = $nilai1;
      $scholarship->save();

      Session::flash('success','Beasiswa berhasil diubah');

      return redirect('/beasiswa/lihat/'.$id);
    }

    public function destroy($id)
    {
      $key = crypt::decrypt($id);

      $scholarship = scholarship::find($key);
      $scholarship->delete();

      $colleger = DB::select(DB::raw("DELETE FROM scholarships_details where id_scholarship='$key'"));

      Session::flash('success','Data berhasil dihapus.');

      return redirect('/beasiswa');
    }

    public function createMahasiswa($id)
    {
      try {
        $data['scholarship'] = scholarship::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['scholarship']->id);
//        $data['colleger'] = colleger::orderBy('nama_lengkap','ASC')->get();
        $data['colleger2'] = scholarships_detail::where('id_scholarship',$data['scholarship']->id)->get();
        $data['total'] = DB::table('scholarships_details')->select(DB::raw('sum((bpp + pengelolaan + biaya_hidup + biaya_buku + biaya_penelitian) * total_chapter) as total'))->where('id_scholarship', $data['scholarship']->id)->first();

        return view('scholarship.create_mahasiswa',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function storeMahasiswa(Request $request, $id)
    {
      $collegers = count($request->nim);

      if($collegers > 0) {
        $scholarship = scholarship::find(crypt::decrypt($id));

        foreach ($request->nim as $name => $value) {
          $bpp = explode(".",$request->bpp[$name]);
          $bpp1 = implode("",$bpp);
          $pengelolaan = explode(".",$request->pengelolaan[$name]);
          $pengelolaan1 = implode("",$pengelolaan);
          $hidup = explode(".",$request->hidup[$name]);
          $hidup1 = implode("",$hidup);
          $buku = explode(".",$request->buku[$name]);
          $buku1 = implode("",$buku);
          $penelitian = explode(".",$request->penelitian[$name]);
          $penelitian1 = implode("",$penelitian);

          $detail = new scholarships_detail();
          $detail->chapter1 = $request->semester1[$name];
          $detail->year1 = $request->tahun1[$name];
          $detail->chapter2 = $request->semester2[$name];
          $detail->year2 = $request->tahun2[$name];
          $detail->total_sks = $request->jmlsks[$name];
          $detail->total_chapter = $request->jmlsemester[$name];
          $detail->bpp = $bpp1;
          $detail->pengelolaan = $pengelolaan1;
          $detail->biaya_hidup = $hidup1;
          $detail->biaya_buku = $buku1;
          $detail->biaya_penelitian = $penelitian1;
          $detail->nim_colleger = $request->nim[$name];
          $detail->id_scholarship = $scholarship->id;
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
      try {
        $key = crypt::decrypt($id);
        $data['colleger'] = scholarships_detail::find($key);
        $data['id'] = crypt::encrypt($data['colleger']->id_scholarship);

        return view('scholarship.edit_mahasiswa',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

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
      $hidup = explode(".",$request->hidup);
      $hidup1 = implode("",$hidup);
      $buku = explode(".",$request->buku);
      $buku1 = implode("",$buku);
      $penelitian = explode(".",$request->penelitian);
      $penelitian1 = implode("",$penelitian);

      $colleger = scholarships_detail::find($key);
      $colleger->chapter1 = $request->chapter1;
      $colleger->year1 = $request->year1;
      $colleger->chapter2 = $request->chapter2;
      $colleger->year2 = $request->year2;
      $colleger->total_sks = $request->total_sks;
      $colleger->total_chapter = $request->total_chapter;
      $colleger->bpp = $bpp1;
      $colleger->pengelolaan = $pengelolaan1;
      $colleger->biaya_hidup = $hidup1;
      $colleger->biaya_buku = $buku1;
      $colleger->biaya_penelitian = $penelitian1;
      $colleger->save();
      $id = crypt::encrypt($colleger->id_scholarship);

      Session::flash('success','Data berhasil diupdate.');

      return redirect('/beasiswa/lihat/'.$id);

    }

    public function destroyMahasiswa($id)
    {
      $detail = scholarships_detail::find(crypt::decrypt($id));
      $detail->delete();

      Session::flash('success','Data berhasil dihapus.');

      return back();
    }

    public function createTermin($id)
    {
      try {
        $key=crypt::decrypt($id);
        $data['scholarship'] = scholarship::find(crypt::decrypt($id));
        $data['termin'] = DB::select(DB::raw(
          "SELECT a.*, b.id as id_ar FROM termins a
          LEFT OUTER JOIN account_receivables b
          ON a.id=b.id_termin
          WHERE a.id_scholarship=$key"
        ));
        $data['total'] = DB::table('termins')->select(DB::raw('sum(bpp + pengelolaan) as total'))->where('id_scholarship', $data['scholarship']->id)->first();
        $data['id'] = $id;

        return view('scholarship.create_termin',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }
    }

    public function storeTermin(Request $request, $id)
    {
      $termins = count($request->nama);

      if ($termins > 0) {
        $scholarship = scholarship::find(crypt::decrypt($id));

        foreach ($request->nama as $name => $value) {
          $bpp = explode(".",$request->bpp[$name]);
          $bpp1 = implode('',$bpp);
          $pengelolaan = explode(".",$request->pengelolaan[$name]);
          $pengelolaan1 = implode('',$pengelolaan);

          $detail = new termin();
          $detail->name = $request->nama[$name];
          $detail->bpp = $bpp1;
          $detail->pengelolaan = $pengelolaan1;
          $detail->date = $request->tanggal[$name];
          $detail->date_end = $request->tanggal_end[$name];
          $detail->id_scholarship = $scholarship->id;
          $detail->save();
        }

        Session::flash('success','Data berhasil disimpan.');

        return back();

      } else {
        Session::flash('error','Tidak ada field.');

        return back();
      }
    }

    public function editTermin($id)
    {
      try {
        $key = crypt::decrypt($id);
        $data['termin'] = termin::find($key);
        $data['id'] = crypt::encrypt($data['termin']->id_scholarship);

        return view('scholarship.edit_termin',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }
    }

    public function updateTermin(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required',
        'bpp' => 'required',
        'pengelolaan' => 'required',
        'date' => 'required',
        'date_end' => 'required',
      ],[
        'name.required' => 'Field wajib diisi.',
        'bpp.required' => 'Field wajib diisi.',
        'pengelolaan.required' => 'Field wajib diisi.',
        'date.required' => 'Field wajib diisi.',
        'date_end.required' => 'Field wajib diisi.'
      ]);

      $key = crypt::decrypt($id);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);
      $pengelolaan = explode(".",$request->pengelolaan);
      $pengelolaan1 = implode("",$pengelolaan);

      $termin = termin::find($key);
      $termin->name = $request->name;
      $termin->bpp = $bpp1;
      $termin->pengelolaan = $pengelolaan1;
      $termin->date = $request->date;
      $termin->date_end = $request->date_end;
      $termin->save();

      $id = crypt::encrypt($termin->id_scholarship);

      Session::flash('success','Data berhasil diubah.');

      return redirect('/beasiswa/lihat/'.$id);
    }

    public function destroyTermin($id)
    {
      $termin = termin::find(crypt::decrypt($id));
      $termin->delete();

      Session::flash('success','Data berhasil dihapus.');

      return back();
    }

    public function downloadExcel($id)
    {
      $key = crypt::decrypt($id);
      $data['data1'] = scholarship::find($key);
      $data['data2'] = termin::where('id_scholarship',$key)->get();
      $data['data3'] = scholarships_detail::with('colleger')->where('id_scholarship',$key)->get();
      $total1 = DB::table('termins')->select(DB::raw('sum(bpp) as total'))->where('id_scholarship', $key)->first();
      $data['total_termin'] = (int)$total1->total;
      $total2 = DB::table('scholarships_details')->select(DB::raw('sum((bpp + pengelolaan) * total_chapter) as total'))->where('id_scholarship', $key)->first();
      $data['total_colleger'] = (int)$total2->total;

      return Excel::create('beasiswa(spk)_'.$data['data1']->spk, function($excel) use ($data) {
        $excel->sheet('spk', function($sheet) use ($data) {
          $sheet->loadView('scholarship.excel',$data);
        });
      })->export('xls');
    }

    public function searchMahasiswa($nim)
    {
      $mahasiswa = colleger::find($nim);
      $prodi = $mahasiswa->prodi_id;
      $year = "20".substr($nim, 3, 2);

      $bpp = bpp_prodi::where('prodi_id',$prodi)->where('year',$year)->first();

      if (count($bpp) > 0) {
        $total = number_format($bpp->bpp,0,'.','.');
      } else {
        $total = 0;
      }

      return $total;
    }

    public function hitungSks($sks, $nim)
    {

      $mahasiswa = colleger::find($nim);
      $prodi = $mahasiswa->prodi_id;
      $year = substr($nim, 3, 2);

      $bpp_prodi = bpp_prodi::where('prodi_id',$prodi)->where('year',$year)->first();

      if (count($bpp_prodi) > 0) {
        $bpp = $bpp_prodi->bpp;
      } else {
        $bpp = 0;
      }

      if($sks == 0 || $sks==null) {
        $total = number_format(($bpp / 2),0,'.','.');
      } else {
        $total = number_format($bpp,0,'.','.');
      }

      return $total;
    }

    public function cekSemester($nim, $semester)
    {
      $mahasiswa = colleger::find($nim);
      $sem = $mahasiswa->semester;
      $hasil1 = $semester%2;
      $hasil2 = substr($mahasiswa->nim,3,2)+$semester/2;
      if($sem=='Ganjil') {
        $data['semester1'] = '1';
        if($hasil1==0){
          $data['semester2'] = '2';
        } else {
          $data['semester2'] = '1';
        }
      } else {
        $data['semester1'] = '2';
        if($hasil1==0){
          $data['semester2'] = '1';
        } else {
          $data['semester2'] = '2';
        }
      }
      $data['tahun1'] = "20".substr($mahasiswa->nim,3,2);
      $data['tahun2'] = "20".(int)$hasil2;
      return $data;
    }

    public function findStudent(Request $req)
    {
      $term = trim($req->q);

      $student = Colleger::where('nama_lengkap','LIKE', '%'.$term.'%')
                          ->orWhere('nim','LIKE', '%'.$term.'%')
                          ->get()
                          ->take(20);
      $colleger = [];

      foreach ($student as $item) {
          $colleger[] = ['id' => $item->nim, 'text' => $item->nim.'-'.$item->nama_lengkap.'-'.$item->status];
      }

      return response()->json($colleger);
    }
}
