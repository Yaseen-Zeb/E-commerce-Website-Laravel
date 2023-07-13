@extends('front.main')
@section("title",'Thank You')
@section('main_section')
<main class="main" style="dispal" >
   <div class="container text-center h-100 py-5" style="min-height: 50vh;background-color: rgba(243, 34, 34, 0.76)">
   <h2 class="text-center mb-5">Thank You</h2>
   <p style="color: white">A varifaction link is send to your given email</p>
    <p style="color: white">Please hit the link to complete registeration</p>
    <button class="btn btn-primary">Go to mail</button>
   </div>
</main>
@endsection