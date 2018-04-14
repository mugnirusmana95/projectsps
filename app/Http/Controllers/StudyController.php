<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facultie;
use App\studie;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class StudyController extends Controller
{
    public function index()
    {
      $data['study'] = studie::orderBy('name')->get();
      foreach ($data['study'] as $key) {
        $data['id'] = crypt::encrypt($key->id);
      }

      return view('study.index',$data);
    }

    public function create()
    {
      $data['faculty'] = facultie::orderBy('name')->get();

      return view('study.create',$data);
    }

    public function store(Request $request)
    {
      $study = new studie();

      $this->validate($request,[
        'faculty' => 'required',
        'name' => 'required|max:35'
      ],[
        'faculty.required' => 'Field wajib dipilih.',
        'name.required' => 'Field wajib diisi.',
        'name.max' => 'Maksimal 35 karakter.'
      ]);

      $study->name = $request->name;
      $study->id_faculty = $request->faculty;
      $study->save();

      Session::flash('success','Program studi berhasil disimpan.');

      return back();
    }

    public function edit($id)
    {
      try {
        $data['study'] = studie::find(crypt::decrypt($id));
        $data['id'] = crypt::encrypt($data['study']->id);
        $data['faculty'] = facultie::orderBy('name')->get();

        return view('study.edit',$data);
      } catch (DecryptException $e) {
        return view('errors.404');
      }

    }

    public function update(Request $request,$id)
    {
      $study = studie::find(crypt::decrypt($id));

      $this->validate($request,[
        'faculty' => 'required',
        'name' => 'required|max:35'
      ],[
        'faculty.required' => 'Field wajib dipilih.',
        'name.required' => 'Field wajib diisi.',
        'name.max' => 'Maksimal 35 karakter.'
      ]);

      $study->name = $request->name;
      $study->id_faculty = $request->faculty;
      $study->save();

      Session::flash('success','Program studi berasil diubah.');

      return redirect('/master/program_studi');
    }

    public function destroy($id)
    {
      $study = studie::find(crypt::decrypt($id));
      $study->delete();

      Session::flash('success','Program studi berhasil dihapus.');

      return redirect('/master/program_studi');
    }

    public function search($name)
    {
      $faculty = facultie::where('name',$name)->first();
      $study = studie::where('id_faculty',$faculty->id)->get();

      return $study;
    }
}
