<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\scholarship;
use App\scholarship_detail;
use App\account_receivable;
use App\account_receivable_detil;
use App\account_receivable_payments;
use App\account_receivable_payment_details;
use App\account_payables;
use App\account_payable_detail;
use App\termin;
use Auth;
use Hash;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $data['today'] = date('Y-m-d');

      $data['check'] = Hash::check('kermaitb', Auth::user()->password);
      $data['termin'] = termin::whereNotIn('id', function($query){
                          $query->from('account_receivables')->select('id_termin');
                        })->get();
      $data['invoice'] = account_receivable::where('date','<',$data['today'])
                         ->whereNotIn('id', function($query){
                           $query->from('account_receivable_payments')->select('id_ar');
                         })->get();
      $data['tagihan'] = account_receivable_payments::whereNotIn('id', function($query){
                           $query->from('account_payables')->select('id_arp');
                         })->get();

      return view ('dashboard.index',$data);
    }
}
