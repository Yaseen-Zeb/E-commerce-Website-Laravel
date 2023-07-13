@extends('front.main')
@section('title',"Cart || Page")
@section('main_section')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Your Cart
            </div>
        </div>
    </div>
    @php
    $total = 0;
    $i = 1;
 @endphp

 @if (isset($data[0]))
     <section class="mt-50 mb-50">
     <div class="container">
         <div class="row">
             <div class="col-12">
                <div class="table-responsive">
                    <div style="margin-bottom: 40px">
                    <table class="table shopping-summery text-center clean">
                       <h4 class="my-1 mb-2 " style="color: #F15412">Customer Details</h4>
                        <thead>
                            <tr class="main-heading">
                                <th scope="col">Customer Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Zip Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-sm-center text-right" data-title="Customer Name">{{$data[0]->name}}</td>
                                <td class="text-sm-center text-right" data-title="Mobile Number">{{$data[0]->mobile}}</td>
                                <td class="text-sm-center text-right" data-title="Address">{{$data[0]->address}}</td>
                                <td class="text-sm-center text-right" data-title="City">{{$data[0]->city}}</td>
                                <td class="text-sm-center text-right" data-title="CZip Code">{{$data[0]->zip}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>



                 <div>
                     <table class="table shopping-summery text-center clean">
                        <h4 class="my-1 mb-2" style="color: #F15412">Order Products Details</h4>
                         <thead>
                             <tr class="main-heading">
                                 <th scope="col">Image</th>
                                 <th scope="col">Name / Collection</th>
                                 <th scope="col">Price</th>
                                 <th scope="col">Quantity</th>
                                 {{-- <th scope="col">Coupon Code</th> --}}
                                 <th scope="col">Subtotal</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($data as $item)
                                  <tr class="row{{$i}}" style="border-bottom: 2px solid #F15412;">
                                 <td data-title="Image" class="image product-thumbnail text-sm-center text-right"><img src="{{asset('storage/images/'."/".$item->image)}}" alt="#"></td>
                                 <td data-title="Name / Collection" class="product-des product-name text-sm-center text-right">
                                     <span class="">
                                     <h5 class="product-name "><a href="/product_details/{{$item->slug}}">{{$item->title}}</a><br>
                                         @if ($item->color_name != "")
                                             Color : {!!$item->color_name."<br>"!!}
                                         @endif
                                         @if ($item->size_name != "")
                                             Size : {!!$item->size_name."<br>"!!}
                                         @endif
                                     
                                     </h5>
                                 </span>
                                 </td>
                                 <td class="text-sm-center text-right" data-title="Price"><span>Rs.<span>{{$item->product_price}}</span></span></td>
                                 <td class="text-sm-center text-right" data-title="Quantity">{{$item->qty}}</td>
                                 <td class=" text-sm-center text-right" data-title="Subtotal">
                                     Rs.<span class='SBT sub_total{{$i}}'>{{$item->qty*$item->product_price}}</span>
                                 </td>
                             </tr>

                             @php
                                 $total = $total+($item->qty*$item->product_price);
                                 $i++
                             @endphp
                             @endforeach

                            
                            
                         
                           
                         </tbody>
                     </table>
                    </div>
                 </div>
                 @if ($data[0]->code != "" )
                     <div class="row mb-2">
                        <span class="col-3"><h5 class="text-center my-1">Total : Rs {{$total}}</h5></span>
                        <span class="col-6"><h5 class="text-center my-1">Applied Coupon : <span style="color: #F15412">{{$data[0]->code}}</span> </h5></span>
                        <span class="col-3"><h5 class="text-center my-1">Final Total : Rs {{$data[0]->af_coupon}}</h5></span>
                     </div>
                @else
               <div class="row mb-2"><h5 class="text-center my-1 col-12">Total : Rs {{$total}}</h5></div>
                @endif
                 <div class="cart-action text-center">
                    <a class="btn" href="/" ><i class="fi-rs-shopping-bag mr-5"></i>Continue Shopping</a>
                </div>
             </div>
         </div>
     </div>
 </section>
    @else
        <div class="alert alert-warning container mt-4"style="font-weight: 600" role="alert">No Product You Added In Cart Yet!</div>
        <div class="cart-action text-center">
            <a class="btn" href="/" ><i class="fi-rs-shopping-bag mr-5"></i>Continue Shopping</a>
        </div>
    @endif
</main>


  
@endsection