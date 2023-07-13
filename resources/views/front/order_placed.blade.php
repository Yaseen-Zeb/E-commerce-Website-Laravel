@extends('front.main')
@section("title",'Order palced')
@section('main_section')
<main class="main" style="dispal" >
   <div class="container text-center h-100 py-5" style="min-height: 50vh;background-color: rgba(243, 34, 34, 0.76)">
   <h2 class="text-center">Thank You</h2>
   <h3 class="my-3" style="color: white">Your order has been placed successfully</h3>
   @if (session()->has("pass"))
       <div class="alert alert-primary w-50 mx-auto note" role="alert" >
      <strong>Note: </strong> You has been register first time so remember login details i.e <br> Email: {{session("user_email")}} & password: {{session("pass")}}
   </div>
   @endif
<?php session()->forget("pass");
 session()->forget("new") ?>
   <a href="/my_orders"> <button class="btn btn-primary">My orders</button></a>
   </div>
</main>
@endsection