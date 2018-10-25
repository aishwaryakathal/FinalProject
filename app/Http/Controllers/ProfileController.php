<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show()
    {

      return view ('profile');
      // $user= User::whereid($id)->first();
      // if ($id)
      // {
      //   return view ('profile')->withUser($user);
      // }
      // else
      // {
      //   dd($user);
      // }
    }
}
