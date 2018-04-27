<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class SettingController extends Controller
{
    public function toggleBar()
    {
      $user = User::find(Auth::user()->id);
      $data = $user->toggle_bar;
      if($data=='' || $data==null){
        $user->toggle_bar='sidebar-collapse';
      } else {
        $user->toggle_bar=null;
      }
      $user->save();

      return $data;
    }
}
