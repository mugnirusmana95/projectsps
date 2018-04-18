<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bpp_prodi;
use App\studie;
use Session;
use Crypt;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

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
        'bpp' => 'required'
      ],[
        'prodi.required' => 'Field wajib dipilih',
        'year.required' => 'Field wajib dipilih',
        'bpp.required' => 'Field wajib diisi'
      ]);

      $bppp = new bpp_prodi();

      $prodi = bpp_prodi::where('prodi',$request->prodi)->where('year',$request->year)->first();

      if(count($prodi)>0) {

        session::flash('warning','Prodi '.$request->prodi.' tahun '.$request->year.' sudah diinputkan.');

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

      $data['prodi'] = studie::orderBy('name')->get();
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
        'bpp' => 'required'
      ],[
        'prodi.required' => 'Field wajib dipilih',
        'year.required' => 'Field wajib dipilih',
        'bpp.required' => 'Field wajib diisi'
      ]);

      $bpp = bpp_prodi::find(crypt::decrypt($id));

      $bpp1 = explode(".",$request->bpp);
      $bpp2 = implode("",$bpp1);

      $bpp->prodi = $request->prodi;
      $bpp->year = $request->year;
      $bpp->bpp = $bpp2;
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
}
