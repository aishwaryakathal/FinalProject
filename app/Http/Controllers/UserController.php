<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Session;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
     {
         $user = Auth::user();
         return view('edit', compact('user'));
     }


   //  public function update(Request $request,$id) {
   //    $name = $request->input('stud_name');
   //    DB::update('update users set name = ? where id = ?',[$name,$id]);
   //    echo "Record updated successfully.<br/>";
   //    echo '<a href = "/edit-records">Click Here</a> to go back.';
   // }
    public function update(User $useredit)
    {

        //$user = Auth::user()->id;
        // $user->name =request('name');
        // $user->gender =request('gender');
         $useredit->password = bcrypt(request('password'));

        Session::flash('success_msg', 'Password has been updated successfully!');


        $useredit->save();

        return view('profile');
    }



}
