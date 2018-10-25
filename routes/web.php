<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  $images = DB::table('welcome_slider')->select('imagepath','title','description')->get();

    return view('welcome',compact('images'));
});

Auth::routes();

// Route::get('paypal', function () {
//     return view('paypal');
// });


//Showing membership type to users
Route::get('paypal', 'PaymentController@showform')->name('payment_form');

//Posting data to paypal
Route::POST('paypal', 'PaymentController@payWithpaypal')->name('paypal');
Route::get('status', 'PaymentController@getPaymentStatus')->name('status');
Route::get('/paymenthistory', 'PaymentController@paymentHistory')->name('payment_history');

Route::get('/payments/excel', 'PaymentController@excel')->name('admin.payments.excel');

//Home
Route::get('/userdashboard', 'HomeController@index')->name('userdashboard');

//User logout
Route::get('/users/logout','Auth\LoginController@userLogout')->name('user.logout');

//show profile
Route::get('/profile','ProfileController@show')->name('profile.show');

//Edit and update profile
 Route::get('/users/{user}','UserController@edit')->name('user.edit');
 Route::patch('/users/{user}/update','UserController@update')->name('user.update');




//Group for Admin login and user login
Route:: prefix('admin')->group(function(){
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/', 'AdminController@index')->name('admin.dashboard');



//Show users for Admin Module
Route::get('/showuser', 'AdminController@showusers')->name('show_user');
//show option to activate user for Admin Module
Route::get('/showactiveuser', 'AdminController@showusersactive')->name('show_user_active');
// Activate User from admin Module
Route::get('/user/{id}','AdminController@activateUser')->name('activate_user');

//show membership for Admin Module
Route::get('/members','AdminController@showMembers')->name('show_members');

//Edit membership for Admin Module
Route::get('/editmembership/{id}','AdminController@editMembership')->name('edit_membership');

//update membership for Admin Module
Route::post('/updatemembership/{id}','AdminController@updateMembership')->name('update_membership');

// Membership Types for Admin module
Route::get('/membershiptype','AdminController@membershipType')->name('membership_type');

//Add membership type for Admin Module
Route::post('/addmembershiptype','AdminController@addMembershipType')->name('add_membership_type');

//Add news section for Admin Module
Route::get('/news','AdminController@addNews')->name('add_news');

//Post News section for Admin Module
Route::post('/postnews','AdminController@postNews')->name('send_news');

//Add sendemail section for Admin Module
Route::get('/email', 'AdminController@getMembersEmails')->name('get_email_accounts');

//Add sendemail section for Admin Module
Route::get('/email/individual', 'AdminController@getIndividualEmails')->name('get_individual_accounts');

//Add sendemail section for Admin Module
Route::post('/send/email', 'AdminController@sendEmail')->name('send_email');

/*show Discount page for Admin */
Route::get('/discount/page','AdminController@discountpage')->name('adddiscount');

/*Discount for Admin */
Route::post('/discount','AdminController@add_discount')->name('add_discount');

/*show main banner page to Admin */
Route::get('/mainbanner','AdminController@mainBanner')->name('main_banner');

/*post main banner */
Route::post('/postmainbanner','AdminController@postmainBanner')->name('post_main_banner');


//Edit User From Admin Module
Route::get('/editUser/{id}','AdminController@editUser')->name('edit_user');
//Update User From Admin Module
Route::post('/users/{id}', 'AdminController@updateUser')->name('user_update');
//Delete User From Admin Panel
Route::get('/users/{id}','AdminController@deleteUser')->name('delete-userinfo');


Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

});
