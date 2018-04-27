<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bpp_prodi;
use App\studie;
use Session;
use Crypt;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Excel;

class BppprodiController extends Controller
{
    public function index()
    {
      $data['bpp'] = bpp_prodi::with('prody')->orderBy('year','DESC')->orderBy('prodi_id','ASC')->get();

      return view('bppp.index',$data);
    }

    public function create()
    {
      $data['prodi'] = studie::orderBy('nama_prodi')->get();
      $data['year'] = date('Y');
      $data['year2'] = $data['year']-20;

      return view('bppp.create',$data);
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'prodi' => 'required',
        'year' => 'required',
        'bpp' => 'required',
        'sks' => 'required'
      ],[
        'prodi.required' => 'Field wajib dipilih',
        'year.required' => 'Field wajib dipilih',
        'bpp.required' => 'Field wajib diisi',
        'sks.required' => 'Field wajib diisi'
      ]);

      $bppp = new bpp_prodi();

      $prodi = bpp_prodi::with('prody')->where('prodi_id',$request->prodi)->where('year',$request->year)->first();

      if(count($prodi)>0) {

        session::flash('warning','Prodi '.$prodi->prodi_id.'-'.$prodi->prody->nama_prodi.'-'.$prodi->prody->strata.' tahun '.$request->year.' sudah diinputkan (Rp '.number_format($prodi->bpp,0,'.','.').').');

        return back();

      } else {
        $bpp = explode(".",$request->bpp);
        $bpp1 = implode("",$bpp);

        $bppp->prodi_id = $request->prodi;
        $bppp->year = $request->year;
        $bppp->bpp = $bpp1;
        $bppp->save();

        session::flash('success','Data berhasil disimpan.');

        return back();

      }

    }

    public function edit($id)
    {
      $data['bpp'] = bpp_prodi::find(crypt::decrypt($id));

      $data['prodi'] = studie::orderBy('nama_prodi')->get();
      $data['year'] = date('Y');
      $data['year2'] = $data['year']-20;
      $data['id'] = crypt::encrypt($data['bpp']->id);

      return view('bppp.edit',$data);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'prodi' => 'required',
        'year' => 'required',
        'bpp' => 'required',
        'sks' => 'required'
      ],[
        'prodi.required' => 'Field wajib dipilih',
        'year.required' => 'Field wajib dipilih',
        'bpp.required' => 'Field wajib diisi',
        'sks.required' => 'Field wajib diisi'
      ]);

      $bpp = bpp_prodi::find(crypt::decrypt($id));

      $bpp1 = explode(".",$request->bpp);
      $bpp2 = implode("",$bpp1);

      $bpp->prodi_id = $request->prodi;
      $bpp->year = $request->year;
      $bpp->bpp = $bpp2;
      $bpp->sks = $request->sks;
      $bpp->save();

      Session::flash('success','Data berhasil diubah.');

      return redirect('/master/bpp_prodi');
    }

    public function destroy($id)
    {
      $bpp = bpp_prodi::find(crypt::decrypt($id));
      $bpp->delete();

      Session::flash('success','Data berhasil dihapus.');
      return back();
    }

    public function createImport()
    {
      return view('bppp.import');
    }

    public function storeImport(Request $request)
    {
      $this->validate($request,[
        'prodi' => 'required'
      ],[
        'prodi.required' => 'Field wajib diisi',
      ]);

      if($request->hasFile('prodi')){
        $path = $request->file('prodi')->getRealPath();
        $data = \Excel::load($path)->get();
        if($data->count()){
          foreach ($data as $key => $value) {
            $prodi_list[] = [
              'prodi_id' => (int)$value->prodi_id,
              'year' => (int)$value->year,
              'bpp' => (int)$value->bpp,
            ];
          }
          if(!empty($prodi_list)){
            bpp_prodi::insert($prodi_list);
            Session::flash('success','Data berhasil di import');
          }
        }
      } else {
        Session::flash('warning','Data gagal di import');
      }

      return redirect('/master/bpp_prodi');

    }
}
