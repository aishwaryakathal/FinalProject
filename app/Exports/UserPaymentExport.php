<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserPaymentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {


      $userid = Auth::user();

      $paymenthistory = DB::table('membership_upgrade_request')->where('userid', $userid->id)->select('amount_paid','payment_id','created_at','membershiptype')->get();

      return $paymenthistory;
    }
    public function headings(): array
    {
       return [
           'Amount Paid',
           'Payment ID',
           'Created At',
           'Membership Purchased',
       ];
   }
}
