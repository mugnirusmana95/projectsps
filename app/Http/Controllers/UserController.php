<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Auth;
use Session;
use DB;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $data['user'] = user::where('id','!=',Auth::user()->id)->where('level','!=','0')->where('level','!=',0)->orderBy('created_at','DESC')->get();
      foreach ($data['user'] as $key) {
        $data['id'] = crypt::encrypt($key->id);
      }

      return view ('user.index',$data);
    }

    public function create()
    {
      return view('user.create');
    }

    public function store(Request $request)
    {
      $user = new user();

      $query = DB::table('users')
          ->max('id');
      $nourut = (int) substr($query, 1, 5);
      $nourut++;
      $id = 'U'.sprintf('%05s', $nourut);

      $this->validate($request,[
        'nip'           => 'required|max:16|unique:users',
        'nama_depan'    => 'required|max:15',
        'nama_belakang' => 'max:20',
        'username'      => 'required|max:15|unique:users',
        'email'         => 'required|email|max:50|unique:users'
      ],[
        'nip.required'        => 'Field wajib diisi.',
        'nip.max'             => 'Maksimal 16 karakter.',
        'nip.unique'          => 'NIP telah digunakan.',
        'nama_depan.required' => 'Field wajib diisi.',
        'nama_depan.max'      => 'Maksimal 15 karakter.',
        'nama_belakang.max'   => 'Maksimal 20 karakter.',
        'username.required'   => 'Field wajib diisi.',
        'username.max'        => 'Maksimal 15 karakter.',
        'username.unique'     => 'Username telah digunakan.',
        'email.required'      => 'Field wajib diisi.',
        'email.email'         => 'Email tidak valid.',
        'email.max'           => 'Maksimal 15 karakter.',
        'email.unique'        => 'Email telah digunakan.'
      ]);

      $user->id       = $id;
      $user->nip      = $request->nip;
      $user->name     = $request->nama_depan;
      $user->l_name   = $request->nama_belakang;
      $user->username = $request->username;
      $user->email    = $request->email;
      $user->gender   = $request->jenis_kelamin;
      $user->level    = $request->user_level;
      $user->password = bcrypt('beasiswasps');
      $user->save();

      Session::flash('success','Berhasil menambah akun.');

      return redirect('/users/tambah');

    }

    public function detail($id)
    {
      $data['user'] = user::find(crypt::decrypt($id));

      return view('user.detail',$data);
    }

    public function edit($id)
    {
      $data['user'] = user::find(crypt::decrypt($id));
      $data['id'] = crypt::encrypt($data['user']->id);

      return view('user.edit',$data);
    }

    public function update(Request $request, $id)
    {
      $user = user::find(crypt::decrypt($id));

      if($user->level == '0') {
        Session::flash('error',"Anda tidak dapat mengubah akun developer.");

        return redirect('/users');
      } else {
        $user->level = $request->level;
        $user->save();

        Session::flash('success',"Hak akses ".$user->name." ".$user->l_name." telah diubah.");

        return redirect('/users');
      }

    }

    public function reset($id)
    {
      $user = user::find(crypt::decrypt($id));
      if($user->level == '0') {
        Session::flash('error',"Anda tidak dapat mengubah akun developer.");

        return redirect('/users');
      } else {
        $user->password = bcrypt('beasiswasps');
        $user->save();

        Session::flash('success','Password '.$user->name.' '.$user->l_name.' telah di reset.');

        return back();
      }
    }
}
