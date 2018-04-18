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
      $data['faculty'] = facultie::orderBy('nama_fakultas')->get();

      return view('faculty.index',$data);
    }

}
