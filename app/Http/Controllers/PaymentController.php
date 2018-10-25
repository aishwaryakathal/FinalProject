<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Redirect;
use URL;
use DB;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Exports\UserPaymentExport;





class PaymentController extends Controller
{

  public function __construct()
    {

        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function showform()
    {
        //$membership_types=Auth::user()->name;
        //Select all the membership types
        $membership_types = DB::table('membership_type')->select('membership_type', 'amount')->get();

        return view('userpaypal', compact('membership_types'));
    }

    public function payWithpaypal(Request $request)
    {

      if($request->discountcode!=NULL)
      {
        $discount_percentage = DB::table('discount')->select('discount_percentage')->where('discount_code',$request->discountcode)->get();

        $discounted_amount=$discount_percentage->first()->discount_percentage;

        $discount=(($request->amount)-(($request->amount)*$discounted_amount/100));
      }

        
      else
      {
        $discount=$request->amount;
      }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Membership Upgrade') /** item name **/
            ->setCurrency('AUD')
            ->setQuantity(1)
            ->setPrice($discount); /** unit price **/
            $item_list = new ItemList();
            $item_list->setItems(array($item_1));
            $amount = new Amount();
            $amount->setCurrency('AUD')->setTotal($discount);
            $transaction = new Transaction();
            $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your Membership Upgradation');
            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('status'));
            $payment = new Payment();
            $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
          $payment->create($this->_api_context);
            }
        catch (\PayPal\Exception\PPConnectionException $ex)
        {
            if (\Config::get('app.debug'))
              {
              \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
              } else
              {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
              }
        }
          foreach ($payment->getLinks() as $link)
          {
            if ($link->getRel() == 'approval_url')
            {
              $redirect_url = $link->getHref();
                break;
            }
          }
/** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('amount', $request->amount);
        Session::put('amountpaid', $discount);
        if (isset($redirect_url))
        {
/** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $amountpaid=Session::get('amount');
        $amount=Session::get('amountpaid');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token')))
        {
          \Session::put('error', 'Payment failed');
            return Redirect::route('paypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved')
        {

          $membership_purchase= DB::table('membership_type')->select('membership_type' )->where('amount','=',$amountpaid)->get();
          $membership = $membership_purchase->pluck('membership_type');

          $userid = Auth::user();

          //save in the database
          DB::table('membership_upgrade_request')->insert
          (
            ['userid' => $userid->id, 'amount_paid' => $amount,'payment_id'=>$payment_id,'active'=>1,'membershiptype'=>$membership]
          );




          //DB::table('membership_upgrade_request')->where('userid',$userid->id)->where('amount_paid',$amountpaid)->update(['membershiptype' =>$membership_purchase ]);


          \Session::put('success', 'Payment successfull of amount');

            return Redirect::route('paypal');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('paypal');

    }

    public function excel() {



    // Generate and return the spreadsheet
  return Excel::download(new UserPaymentExport, 'Payment History.xlsx');
}


public function paymentHistory()
{
    $userid=Auth::user()->id;

    $users = DB::table('membership_upgrade_request')->select('userid','amount_paid','payment_id','created_at','membershiptype')->where('userid','=',$userid)->get();

    return view('paymenthistory', compact('users'));
}


}
