<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colleger;
use App\facultie;
use App\studie;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class CollegerController extends Controller
{
    public function index()
    {
      $data['colleger'] = colleger::orderBy('nim')->get();

      return view ('colleger.index',$data);
    }

    public function create()
    {
      $data['faculty'] = facultie::orderBy('name')->get();
      $data['study'] = studie::orderBy('name')->get();

      return view('colleger.create',$data);
    }

    public function store(Request $request)
    {

      $colleger = new colleger();

      $this->validate($request,[
        'nim'       => 'required|max:8|unique:collegers',
        'nama'      => 'required|max:50',
        'program'   => 'required',
        'fakultas'  => 'required',
        'prodi'     => 'required'
      ],[
        'nim.required'      => 'Field wajib diisi.',
        'nim.max'           => 'Maksimal 8 karakter.',
        'nim.unique'        => 'NIM sudah digunakan.',
        'nama.required'     => 'Field wajib diisi.',
        'nama.max'          => 'Maskimal 50 karakter.',
        'program.required'  => 'Field wajib dipilih.',
        'fakultas.required' => 'Field wajib dipilih.',
        'prodi.required'    => 'Field wajib dipilih.'
      ]);

      $fakultas = $request->fakultas;

      $colleger->nim = $request->nim;
      $colleger->name = $request->nama;
      $colleger->chapter = $request->semester;
      $colleger->program = $request->program;
      if($request->fakultas == '0') {
        $colleger->faculty = $request->fakultas2;
      } else {
        $colleger->faculty = $request->fakultas;
      }
      if($request->prodi == '0') {
        $colleger->prodi = $request->prodi2;
      } else {
        $colleger->prodi = $request->prodi;
      }
      $colleger->status = '1';
      $colleger->save();

      if($request->fakultas == '0') {
        $fakultas = new facultie();
        $fakultas->name = $request->fakultas2;
        $fakultas->save();
      }

      if($request->prodi == '0') {
        $prodi = new studie();
        $prodi->name = $request->prodi2;
        if($request->fakultas == '0') {
          $prodi->id_faculty = $fakultas->id;
        } else {
          $fak = facultie::where('name',$request->fakultas)->first();
          $prodi->id_faculty = $fak->id;
        }
        $prodi->save();
      }

      Session::flash('success','Data mahasiswa berhasil ditambah.');

      return back();
    }

    public function detail($nim)
    {
        try {
          $data['colleger'] = colleger::find(crypt::decrypt($nim));
          $data['nim'] = crypt::encrypt($data['colleger']->nim);

          return view('colleger.detail',$data);
        } catch (DecryptException $e) {
          return view('errors.404');
        }

    }

    public function edit($nim)
    {
        try {
          $data['colleger'] = colleger::find(crypt::decrypt($nim));
          $data['id'] = crypt::encrypt($data['colleger']->nim);
          $data['faculty'] = facultie::orderBy('name')->get();;
          $data['study'] = studie::orderBy('name')->get();;

          return view('colleger.edit',$data);
        } catch (DecryptException $e) {
          return view('errors.404');
        }
    }

    public function update(Request $request, $nim)
    {
      $colleger = colleger::find(crypt::decrypt($nim));

      $this->validate($request,[
        'nama'      => 'required|max:50',
        'program'   => 'required',
        'fakultas'  => 'required',
        'prodi'     => 'required'
      ],[
        'nama.required'     => 'Field wajib diisi.',
        'nama.max'          => 'Maksimal 50 karakter.',
        'program.required'  => 'Field wajib dipilih.',
        'fakultas.required' => 'Field wajib dipilih.',
        'prodi.required'    => 'Field wajib dipilih.'
      ]);

      $colleger->name = $request->nama;
      $colleger->chapter = $request->semester;
      $colleger->program = $request->program;
      $colleger->faculty = $request->fakultas;
      $colleger->prodi = $request->prodi;
      $colleger->save();

      Session::flash('success','Data berhasil diubah');

      return redirect('/master/mahasiswa/lihat/'.$nim);

    }

    public function aktif($nim)
    {
      $colleger = colleger::find(crypt::decrypt($nim));

      $colleger->status = '1';
      $colleger->save();

      Session::flash('success','Data '.$colleger->name.' berhasil diaktifkan.');

      return back();
    }

    public function nonaktif($nim)
    {
      $colleger = colleger::find(crypt::decrypt($nim));

      $colleger->status = '0';
      $colleger->save();

      Session::flash('success','Data '.$colleger->name.' berhasil di non-aktifkan.');

      return back();
    }

}
