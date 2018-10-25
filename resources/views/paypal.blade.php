    @extends('layouts.app')

    @section('content')


    @if(Auth::guard('web')->check())


    @if ($message = Session::get('success'))
    <div class="w3-panel w3-green w3-display-container">
        <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-green w3-large w3-display-topright">&times;</span>
        <p>{!! $message !!} &nbsp {!! Session::get('amount')!!}</p>

    </div>
    <?php Session::forget('success');?>
    @endif
    @if ($message = Session::get('error'))
    <div class="w3-panel w3-red w3-display-container">
        <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-red w3-large w3-display-topright">&times;</span>
        <p>{!! $message !!}</p>
    </div>

    <?php Session::forget('error');?>
    @endif

    <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="{!! URL::to('paypal')!!}">
      {{ csrf_field() }}

      <p>


        <label class="col-md-1 col-form-label text-md-right"><b>Memberships</b></label><br/>


  <!-- <input type="radio" name="amount" class="col-md-1 col-form-label text-md-right" value=10 /> Silver Membership<br> -->

    @foreach($membership_types as $m)

      <!-- <input type="text" name="membership" value={{ $m->membership_type }}> -->
      <input type="radio" name="amount" class="col-md-1 col-form-label text-md-right" value={{$m->amount}} /> {{ $m->membership_type }}<br>


    </br>
    @endforeach
  <!-- <input type="radio" name="amount" class="col-md-1 col-form-label text-md-right" value=20 /> Gold Membership<br>
  <input type="text" name="membership" value="Gold"> -->


  <div class="col-xs-6 col-md-4">&nbsp;&nbsp; &nbsp;<button class="col-md-0.5" >Pay with PayPal</button></p></div>
  </form>
<div class="col-xs-6 col-md-4">
  &nbsp; &nbsp; <a href="{{ route('admin.payments.excel') }}"> <button type="button" class="btn btn-primary">Download Payment History</button>  </a>
</div>
  @endif





  @endsection
