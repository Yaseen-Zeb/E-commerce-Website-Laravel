@extends('admin.main')
@section('page_title')
    Order details
@endsection
@section('orders_active',"active")
@section('main_section')
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="mb-2">
            <a href="/admin_penal/orders"><button class="btn btn-primary">Back</button></a>
        </div>
        <div class="row">
         <div class="form-group col-md-5">
            <label for="">Update Order Status</label>
           <select class="form-control update_order_status" onchange="update_order_status(<?php echo $data[0]->order_id ?>)" name="" id="">
            @foreach ($order_status  as $key => $item)
            @if ($data[0]->order_status == $item->id)
                <option selected value="{{$item->id}}">{{$item->status}}</option>
            @else
            <option value="{{$item->id}}">{{$item->status}}</option>
            @endif
                 
            @endforeach
           </select>
         </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            @php
            $total = 0;
            $i = 1
         @endphp
            <div class="row"> 
                <div class="col-12">
                    <div style="margin-bottom: 40px">
                        <table class="table table-striped table-inverse table-responsive-sm table-bordered">
                           <h4 class="my-1 mb-2 " style="color: #F15412">Customer Details</h4>
                            <thead class="thead-dark">
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
                         <table class="table table-striped table-inverse table-responsive-sm table-bordered">
                            <h4 class="my-1 mb-2" style="color: #F15412">Order Products Details</h4>
                             <thead class="thead-dark">
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
                                      <tr>
                                     <td data-title="Image" class="image product-thumbnail text-sm-center text-right"><img  width="100px" heigth="100px"  src="{{asset('storage/images/'."/".$item->image)}}" alt="#"></td>
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
            </div>
            @if ($data[0]->code != "" )
                        <div class="row">
                           <span class="col-sm-3"><h5 class="text-center my-1">Total : Rs {{$total}}</h5></span>
                           <span class="col-sm-6"><h5 class="text-center my-1">Applied Coupon : <span style="color: #F15412">{{$data[0]->code}}</span> </h5></span>
                           <span class="col-sm-3"><h5 class="text-center my-1">Final Total : Rs {{$data[0]->af_coupon}}</h5></span>
                        </div>
                   @else
                  <div class="row"><h5 class="text-center my-1 col-12">Total : Rs {{$total}}</h5></div>
                   @endif
        </div>
    </section>
</div>
@endsection

