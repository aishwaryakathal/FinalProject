<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use response;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Charts;
use Image;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = DB::table('users')->where('active','=','0')->count();
      $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();

      $newusers = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
      $chart = Charts::database($newusers, 'bar', 'highcharts')
      ->title("Monthly Register Users")
      ->elementLabel("Total Users")
      ->dimensions(1000, 500)
      ->responsive(true)
      ->groupByMonth(date('Y'), true);

      $usersmem = DB::table('users')->select('membership')->whereNotNull('membership')->get();
      $pie_chart = Charts::database($usersmem,'pie', 'highcharts')
			   ->elementLabel("Total")
         ->title("Membership Purchased")
				 ->groupBy('membership');

      $data =DB::table('membership_upgrade_request')->select('amount_paid','payment_id','created_at','membershiptype')->whereNotNull('payment_id')->get();
      $chartforpurchase = Charts::database($data, 'area', 'highcharts')
      ->title("Membership Sales")
      ->elementLabel("Total Sales")
      ->dimensions(1000, 500)
      ->responsive(true)
      ->groupBy('amount_paid','created_at')
      ->groupByMonth();

      $newsdata=DB::table('news')->select('membership')->get();
      $news=Charts::database($newsdata,'bar', 'highcharts')
      ->title('News By Membership')
      ->elementLabel("No of News")
      ->values($newsdata->pluck('total'))
      ->groupBy('membership');

        return view('dashboard', compact('users','membership_request','chart','pie_chart','chartforpurchase','news'));
    }

    public function showusers()
    {
      $users = DB::table('users')->select('id','name', 'email', 'gender', 'membership', 'created_at' )->where('active','=','1')->get();
      $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
      $useractive = DB::table('users')->where('active','=','0')->count();


      return view('showuser', compact('users','membership_request','useractive'));
    }

    public function showusersactive()
    {
      $usersactive = DB::table('users')->select('id','name', 'email', 'gender', 'membership', 'created_at' )->where('active','=','0')->get();
      $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
      $users = DB::table('users')->where('active','=','0')->count();


      return view('showactiveuser', compact('usersactive','membership_request','users'));
    }

    public function activateUser($id)
    {
      $useremail = DB::table('users')->select('email')->where('id','=',$id)->get();
      $username = DB::table('users')->select('name')->where('id','=',$id)->get();

      DB::table('users')->where('id', $id)->update(['active' => 1]);


      foreach ($username as $user)
      {
        Mail::to($useremail)->send(new SendMailable($user));
      }

      Session::flash('success_msg', 'User Activate successfully!');
      return redirect('admin/showactiveuser');
    }

    public function editUser($id)
    {
      $users = DB::table('users')->select('id','name', 'email', 'gender', 'membership', 'created_at' )->where('id','=',$id)->first();
      $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
      $useractive = DB::table('users')->where('active','=','0')->count();

      return view('edituser',  ['user' => $users,'membership_request'=>$membership_request,'useractive'=>$useractive]);
    }

    public function updateUser($id, Request $request){
            //validate post data
            // $this->validate($request, [
            //     'title' => 'required',
            //     'content' => 'required'
            // ]);
            //
            //get post data
            $userData = $request->all();

            //update post data
            User::find($id)->update($userData);

            //store status message
            Session::flash('success_msg', 'User Data updated successfully!');

            return redirect('admin/showuser');
        }

    public function deleteUser($id)
    {
      $users = DB::table('users')->where('id','=',$id)->delete();
      //store status message
      Session::flash('success_msg', 'User deleted successfully!');
      return redirect('admin/showuser');
    }

    public function showMembers()
    {
      $users = DB::table('users')
            ->join('membership_upgrade_request', 'users.id', '=', 'membership_upgrade_request.userid')->distinct()
            ->select('users.*', 'membership_upgrade_request.amount_paid', 'membership_upgrade_request.created_at','membership_upgrade_request.membershiptype')
            ->where('membership_upgrade_request.active', '=', '1')
            ->get();

      $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
      $usersactive = DB::table('users')->where('active','=','0')->count();


      return view('showmembers', compact('users','membership_request','usersactive'));
    }

    public function editMembership($id)
    {
      $users = DB::table('users')->select('id','name', 'email', 'gender', 'membership', 'created_at' )->where('id','=',$id)->first();
      return view('membershipedit',  ['user' => $users]);
    }
    public function updateMembership($id, Request $request)
    {
            //validate post data
            // $this->validate($request, [
            //     'title' => 'required',
            //     'content' => 'required'
            // ]);
            //
            //get post data
            $userData = $request->all();

            //update post data
            User::find($id)->update($userData);

            // Update the user membership table
            DB::table('membership_upgrade_request')
            ->where('userid',$id)
            ->update(['active' => 0]);

            //store status message
            Session::flash('success_msg', 'Membership status updated successfully!');

            return redirect('admin/members');
        }

        public function membershipType()
        {
          $users = DB::table('membership_type')->select('id','membership_type', 'amount' )->get();
          $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
          $usersactive = DB::table('users')->where('active','=','0')->count();

          return view('membershiptypes', compact('users','membership_request','usersactive'));
        }
        public function addMembershipType(Request $request)
        {


          DB::table('membership_type')->insert(['membership_type' => $request->membershiptype, 'amount' => $request->amount]);


                //store status message
                Session::flash('success_msg', 'Membership Added successfully!');

                return redirect('admin/membershiptype');
        }

        public function addNews()
        {
        $users = DB::table('membership_type')->select('membership_type')->get();
        $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
        $usersactive = DB::table('users')->where('active','=','0')->count();

          return view('news', compact('users','membership_request','usersactive'));

        }

        public function postNews(Request $request)
        {

                $this->validate($request, [
                    'title' => 'required',
                    'imgupload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'description' => 'required'
                ]);


                if($request->hasFile('imgupload')){
                  $image = $request->file('imgupload');
                  $filename = time() . '.' . $image->getClientOriginalExtension();
                  Image::make($image)->resize(200, 450)->save( storage_path('/upload/' . $filename ) );
                };


                $data_insert['title']= $request->title;
                $data_insert['description']= $request->description;
                $data_insert['imagepath']   = $filename;
                $data_insert['membership']   = $request->selectmembership;
                // Update the user membership table
                //DB::table('news')->insert(['title' => $request->title, 'description' => $request->description,'membership'=>$request->selectmembership]);

                DB::table('news')->insert($data_insert);

                //store status message
                Session::flash('success_msg', 'News has been Posted Successfully!');

                return redirect('admin/news');
            }

            public function getMembersEmails()
            {
            $users = DB::table('membership_type')->select('membership_type')->get();
            $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
            $usersactive = DB::table('users')->where('active','=','0')->count();

              return view('sendemail', compact('users','membership_request','usersactive'));
            }

            public function getIndividualEmails()
            {
            $users = DB::table('membership_type')->select('membership_type')->get();
            $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
            $usersactive = DB::table('users')->where('active','=','0')->count();

              return view('sendemailindividual', compact('users','membership_request','usersactive'));
            }

            public function sendEmail(Request $request)
            {
          if ($request->selectmembership=='ALL')
          {
             $emailgroup = DB::table('users')->select('email')->get();
           }
           if ($request->selectmembership=='NONE' || $request->emailaddress!='')
           {
             $title= $request->title;
             $body= $request->description;
             $emailgroup = $request->emailaddress;
             Mail::send('email.bulkemail', ['name'=>$body], function($message) use ($emailgroup,$title)
             {
               $message->to($emailgroup)->subject($title);
             });

             $emailgroup = '';

           }
          if ($request->selectmembership!='ALL')
          {
            $emailgroup = DB::table('users')->select('email')->where('membership',$request->selectmembership)->get();
          }
            //  $emails = explode(',', $emails);

            //  $emails = array('useremails' => $useremail);;
              //$emails = ['karunakarreddy12495@gmail.com','atiqk551@gmail.com'];
              $title= $request->title;
              $body= $request->description;

              foreach ($emailgroup as $emails)
              {
              Mail::send('email.bulkemail', ['name'=>$body], function($message) use ($emails,$title)
              {
                $message->to($emails->email)->subject($title);
              });
              }



          //    Mail::bcc($emails)->send(new SendMailable($title));

              Session::flash('success_msg', 'Email Sent Successfully!');
              return redirect('admin/email');
            }

            public function discountpage()
            {

              return view('discount');

            }
            public function add_discount(Request $request)
            {

            DB::table('discount')->insert(['discount_code' => $request->discountcode, 'discount_percentage' =>$request->discountpercentage]);

            Session::flash('success_msg', 'Discount code added successfully!');
            return view('discount');
            }

            public function mainBanner()
            {
            $users = DB::table('membership_type')->select('membership_type')->get();
            $membership_request = DB::table('membership_upgrade_request')->where('active','=','1')->distinct('amount_paid')->count();
            $usersactive = DB::table('users')->where('active','=','0')->count();

              return view('mainBanner', compact('users','membership_request','usersactive'));

            }


            public function postmainBanner(Request $request)
            {

                    $this->validate($request, [
                        'title' => 'required',
                        'imgupload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'description' => 'required'
                    ]);


                    if($request->hasFile('imgupload')){
                      $image = $request->file('imgupload');
                      $filename = time() . '.' . $image->getClientOriginalExtension();
                      Image::make($image)->resize(200, 375)->save( storage_path('/upload/' . $filename ) );
                    };


                    $data_insert['title']= $request->title;
                    $data_insert['description']= $request->description;
                    $data_insert['imagepath']   = $filename;

                    // Update the user membership table
                    //DB::table('news')->insert(['title' => $request->title, 'description' => $request->description,'membership'=>$request->selectmembership]);

                    DB::table('welcome_slider')->insert($data_insert);

                    //store status message
                    Session::flash('success_msg', 'News has been Posted Successfully!');

                    return redirect('admin/mainbanner');
                }







}
