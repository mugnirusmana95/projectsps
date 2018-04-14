<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Auth;
use Session;
use Storage;
use Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfileController extends Controller
{
  public function __contruct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $data['user'] = user::find(Auth::user()->id);

    return view('profile.index',$data);
  }

  public function edit()
  {
    return view('profile.edit');
  }

  public function update(Request $request)
  {
    $user = user::find(Auth::user()->id);

    $this->validate($request,[
      'first_name'        => 'required|max:15',
      'last_name'         => 'max:20',
      'title_before_name' => 'max:50',
      'title_after_name'  => 'max:50',
      'plcae_of_birthday' => 'max:15',
      'date_of_birthday'  => 'max:10',
      'address'           => 'max:100'
    ]);

    $user->name     = $request->first_name;
    $user->l_name   = $request->last_name;
    $user->tb_name  = $request->title_before_name;
    $user->ta_name  = $request->title_after_name;
    $user->pob      = $request->place_of_birthday;
    $user->dob      = $request->date_of_birthday;
    $user->gender   = $request->gender;
    $user->address  = $request->address;
    $user->save();

    Session::flash('success','Biodata berhasil diubah.');

    return redirect('/profile');
  }

  public function account()
  {
    return view('profile.account');
  }

  public function updateAccount(Request $request)
  {
    $user = user::find(Auth::user()->id);

    $this->validate($request,[
      'username' => 'required|max:15|unique:users',
      'email'    => 'required|max:50|unique:users'
    ]);

    $user->username = $request->username;
    $user->email = $request->email;
    $user->save();

    Session::flash('success','Akun berhasil diubah.');

    return redirect('/profile');
  }

  public function avatar()
  {
    return view('profile.avatar');
  }

  public function UpdateAvatar(Request $request)
  {
    $user = user::find(Auth::user()->id);

    $this->validate($request,[
      'file'  => 'required|max:5000'
    ]);

    $images     = $request->file('file');
    $filePath   = $images->getRealPath();
    $fileExt    = $images->getClientOriginalExtension();
    $fileName   = Auth::user()->id.'.'.$fileExt;
    Storage::put('public/profile/'.Auth::user()->id.'/'.$fileName, file_get_contents($filePath));

    $user->profile = $fileName;
    $user->save();

    Session::flash('success','Foto profile berhasil diubah.');

    return redirect('/profile');
  }

  public function password()
  {
    return view('profile.password');
  }

  public function UpdatePassword(Request $request)
  {
    $user = user::find(Auth::user()->id);

    $this->validate($request,[
      'old_password' => 'required',
      'password' => 'required|confirmed',
      'password_confirmation' => 'required'
    ]);

    $password = Auth::user()->password;
    $check    = Hash::check($request->old_password, $password);

    if ($check == true) {

      $user->password = bcrypt($request->password);
      $user->save();
      Session::flash('success','Password berhasil diubah.');
      return redirect('/profile');

    } else {

      Session::flash('error','Password lama salah.');
      return back();

    }

  }
}
