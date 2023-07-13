@extends('front.main')
@section("title",'Varifaction Page')
@section('main_section')
<main class="main" style="dispal" >
<div class="container">
   @if (session("is_email_varify") == 0)
   
         <div class="card w-50 mx-auto my-5 mail_otp">

      <div class="card-header">
         <h4 class="my-0 text-center">Varify your email</h4>
      </div>
      <div class="card-body text-center  pt-0">
        <form class="email_otp">
         @csrf
         <div class="form-group">
           <label for=""></label>
           <input type="text" class="form-control bg-light text-center text-danger" style="font-size: 17px;
           font-weight: 600;" disabled name="" id="" aria-describedby="helpId" placeholder="" value="{{session("data")["email"]}}">
           <input type="hidden" name="varification_email" value="{{session("data")["email"]}}">
         </div>
         <button  type="submit" style="font-size: 20; padding: 7px 23px" class="btn btn-danger m-auto">Send OTP</button>
        </form>

      </div>
   </div>
   @else
   <div class="card w-25 mx-auto my-5 mobile_otp_card">

      <div class="fs">
      <div class="card-header">
         <h4 class="my-0 text-center">Varify your mobile number</h4>
      </div>
      <div class="card-body text-center  pt-0">
        <form class="mobile_otp">
         @csrf
         <div class="form-group">
           <label for=""></label>
           <input type="text" class="form-control bg-light text-center text-danger" style="font-size: 17px;
           font-weight: 600;" disabled name="" id="" aria-describedby="helpId" placeholder="" value="{{session("data")["phone"]}}">
           <input type="hidden" name="varification_number" value="{{session("data")["phone"]}}">
         </div>
         <button  type="submit" style="font-size: 20; padding: 7px 23px" class="btn btn-danger m-auto">Send OTP</button>
        </form>
      </div>
</div>

<div class="s" style="display: none">
      <div class="card-header">
         <h4 class="my-0 text-center">Enter OTP Code</h4>
      </div>
      <div class="card-body text-center  pt-4">
        <form class="mobile_varify_form">
         @csrf
        <div class="alert alert-primary py-0 text-center  mobile_varify_success" style="display:none" role="alert"></div>
        <div class="alert alert-danger py-0 text-center  mobile_varify_error" style="display:none" role="alert"></div>
        <div class="alert alert-warning py-0 otpp text-center w-50 mx-auto" role="alert"></div>
        
            <input value="{{session("data")["fname"]}}" class="form-control" type="hidden" required name="fname" placeholder="Name *">
            <input value="{{session("data")["billing_address"]}}" required type="hidden" name="billing_address">
          
            <input value="{{session("data")["state"]}}" required type="hidden" name="state" placeholder="State / County *">
            <input value="{{session("data")["city"]}}" required type="hidden" name="city" placeholder="City / Town *">
            <input value="{{session("data")["zipcode"]}}" required type="hidden" name="zipcode" placeholder="Postcode / ZIP *">
            <input value="{{session("data")["phone"]}}" required type="hidden" name="phone" placeholder="Phone *">
            <input type="hidden" value="{{session("data")["coupon_code"]}}" name="coupon_code" class="coupon_inp" id="">
            <input type="hidden" name="total_price" value="{{session("data")["total_price"]}}" class="total_inp" id="">
            <input type="hidden" name="payment_option" value="{{session("data")["payment_option"]}}" class="" id="">

         <div class="form-group d-flex w-100">
           <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="first">
           <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="second">
           <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="third">
           <input maxlength="1" required type="text" class="form-control text-center w-25" style="font-size: 30px; font-weight: 600;"  name="forth">
         </div>
         <button  type="submit" style="font-size: 20; padding: 7px 23px" class="btn btn-danger m-auto mobile_varify_btn">Varify</button>
</form>
</div>
   </div>
</div>
   @endif
 


<?php
//  [fname] => Captain
//     [billing_address] => Karachi
//     [state] => Pakistan
//     [city] => Karachi
//     [zipcode] => 432571
//     [phone] => 03437096543
//     [email] => ggg@gmail.com
//     [payment_option] => COD
//     [coupon_code] => 
//     [total_price] => 490
?>
</main>
<form class="form_token">
   @csrf
</form>
@endsection