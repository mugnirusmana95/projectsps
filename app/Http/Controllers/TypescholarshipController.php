<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\type_of_scholarship;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class TypescholarshipController extends Controller
{
    public function index()
    {
      $data['type'] = type_of_scholarship::orderBy('created_at','DESC')->get();
      foreach ($data['type'] as $key) {
        $data['id'] = crypt::encrypt($key->id);
      }

      return view('type.index',$data);
    }

    public function create()
    {
      return view('type.create');
    }

    public function store(Request $request)
    {
      $type = new type_of_scholarship();

      $this->validate($request,[
        'name'  => 'required|max:20|unique:type_of_scholarships'
      ],[
        'name.required' => 'Field wajib diisi',
        'name.max' => 'Maksimal 20 karakter',
        'name.unique' => 'Jenis beasiswa sudah digunakan'
      ]);

      $type->name = $request->name;
      $type->save();

      Session::flash('success','Data berhasil disimpan.');

      return back();
    }

    public function edit($id)
    {
      try {
        $data['type'] = type_of_scholarship::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['type']->id);

        return view('type.edit',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function update(Request $request, $id)
    {
      $type = type_of_scholarship::find(crypt::decrypt($id));

      $this->validate($request,[
        'name'  => 'required|max:20|unique:type_of_scholarships'
      ],[
        'name.required' => 'Field wajib diisi',
        'name.max' => 'Maksimal 20 karakter',
        'name.unique' => 'Jenis beasiswa sudah digunakan'
      ]);

      $type->name = $request->name;
      $type->save();

      Session::flash('success','Data berhasil diubah.');

      return redirect('/master/jenis_beasiswa');
    }

    public function destroy($id)
    {
      $type = type_of_scholarship::find(crypt::decrypt($id));
      $type->delete();

      Session::flash('success','Data berhasil dihapus.');

      return back();
    }
}
