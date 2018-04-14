<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\source_of_scholarship;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SourcescholarshipController extends Controller
{
    public function index()
    {
      $data['source'] = source_of_scholarship::orderBy('name','ASC')->get();
      foreach ($data['source'] as $key) {
        $data['id'] = crypt::encrypt($key->id);
      }

      return view('source.index',$data);
    }

    public function create()
    {
      return view('source.create');
    }

    public function store(Request $request)
    {
      $source = new source_of_scholarship();

      $this->validate($request,[
        'name'  => 'required|max:20|unique:source_of_scholarships',
      ],[
        'name.required' => 'Field wajib diisi.',
        'name.max'  => 'Maksimal 20 karakter.',
        'name.unique' => 'Sumber beasiswa sudah digunakan.'
      ]);

      $bpp = explode(".",$request->bpp);
      $bpp1 = implode("",$bpp);

      $source->name = $request->name;
      $source->bpp = $bpp1;
      $source->save();

      Session::flash('success','Data berhasil disimpan.');

      return back();
    }

    public function edit($id)
    {
      try {
        $data['source'] = source_of_scholarship::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['source']->id);

        return view('source.edit',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function update(Request $request, $id)
    {
      $source = source_of_scholarship::find(crypt::decrypt($id));

      $this->validate($request,[
        'name'  => 'required|max:20|unique:source_of_scholarships',
      ],[
        'name.required' => 'Field wajib diisi.',
        'name.max'  => 'Maksimal 20 karakter.',
        'name.unique' => 'Sumber beasiswa sudah digunakan.'
      ]);

      $source->name = $request->name;
      $source->bpp = $request->bpp;
      $source->save();

      Session::flash('success','Data berhasil diubah.');

      return redirect('/master/sumber_beasiswa');
    }

    public function destroy($id)
    {
      $source = source_of_scholarship::find(crypt::decrypt($id));
      $source->delete();

      Session::flash('success','Data berhasil dihapus.');

      return back();
    }
}
