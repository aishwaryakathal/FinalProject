<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function index()
    {
      $usermembership=Auth::user()->membership;

      //$newslist = DB::table('news')->select('title', 'description')->get();

      $newslist = DB::table('news')->where('membership', $usermembership)->get();

      return view('userdashboard', compact('newslist'));
    }






}
