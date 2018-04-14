<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facultie;
use App\studie;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FacultyController extends Controller
{
    public function index()
    {
      $data['faculty'] = facultie::orderBy('name')->get();
      foreach ($data['faculty'] as $key) {
        $data['id'] = crypt::encrypt($key->id);
      }

      return view('faculty.index',$data);
    }

    public function create()
    {
      return view('faculty.create');
    }

    public function store(Request $request)
    {
      $faculty = new facultie();

      $this->validate($request,[
        'name' => 'required|max:20|unique:faculties',
      ],[
        'name.unique' => $request->name.' sudah digunakan.',
        'name.required' => 'Field wajib diisi.',
        'name.max' => 'Maksimal 20 karakter.'
      ]);

      $faculty->name = $request->name;
      $faculty->save();

      Session::flash('success','Fakultas berhasil ditambah.');

      return back();
    }

    public function detail($id)
    {

      try {
        $data['faculty'] = facultie::find(crypt::decrypt($id));
        $data['study'] = studie::where('id_faculty',$data['faculty']->id)->get();
        $data['id'] = crypt::encrypt($data['faculty']->id);

        return view('faculty.detail',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function edit($id)
    {
      try {
        $data['faculty'] = facultie::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['faculty']->id);

        return view('faculty.edit',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function update(Request $request, $id)
    {
      $faculty = facultie::find(crypt::decrypt($id));

      if($faculty->name == $request->name) {
        $this->validate($request,[
          'name' => 'required|max:20',
        ],[
          'name.required' => 'Field wajib diisi.',
          'name.max' => 'Maksimal 20 karakter.'
        ]);
      } else {
        $this->validate($request,[
          'name' => 'required|max:20|unique:faculties',
        ],[
          'name.unique' => $request->name.' sudah digunakan.',
          'name.required' => 'Field wajib diisi.',
          'name.max' => 'Maksimal 20 karakter.'
        ]);
      }

      $faculty->name = $request->name;
      $faculty->save();

      Session::flash('success','Fakultas berhasil diubah.');

      return redirect('/master/fakultas');
    }

    public function destroy($id)
    {
      $faculty = facultie::find(crypt::decrypt($id));

      if (count(studie::where('id_faculty',$faculty->id)->get())>0) {
        $study = studie::where('id_faculty',$faculty->id)->delete();
      }

      $faculty->delete();

      Session::flash('success','Fakultas berhasil dihapus.');

      return redirect('/master/fakultas');
    }

    public function createStudy($id)
    {
      try {
        $data['faculty'] = facultie::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['faculty']->id);

        return view('faculty.create_study',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function storeStudy(Request $request, $id)
    {
      $studie = count($request->name);

      if($studie > 0) {
        $faculty = facultie::find(crypt::decrypt($id));

        foreach ($request->name as $name=>$value) {
          $study = new studie();
          $study->name = $request->name[$name];
          $study->id_faculty = $faculty->id;
          $study->save();
        }

        Session::flash('success',$studie.' Program studi telah ditambahkan ke fakultas '.$faculty->name);

        return redirect ('/master/fakultas/detail/'.$id);
      } else {

        Session::flash('error','Tidak ada field.');

        return back();
      }

    }

    public function editStudy($id)
    {
      try {
        $data['study'] = studie::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['study']->id);
        $data['faculty'] = facultie::find($data['study']->id_faculty);

        return view('faculty.edit_study',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function updateStudy(Request $request, $id)
    {
      $study = studie::find(crypt::decrypt($id));

      $this->validate($request,[
        'prodi' => 'required|max:35'
      ],[
        'prodi.required' => 'Field wajib diisi.',
        'prodi.max' => 'Maksimal 35 karakter.'
      ]);

      $study->name = $request->prodi;
      $study->save();

      Session::flash('success','Program studi berhasil diubah.');

      return redirect('/master/fakultas/detail/'.crypt::encrypt($study->id_faculty));
    }

    public function destroyStudy($id)
    {
      $study = studie::find(crypt::decrypt($id));
      $study->delete();

      Session::flash('success','Program studi berhasil dihapus.');

      return back();
    }


}
