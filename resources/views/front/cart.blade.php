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
       $i = 0;
    @endphp
   <span class="add_price_conditional_span d-none" ></span>
    @if (isset($products_in_cart[0]))
        <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name / Collection</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products_in_cart as $item)
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
                                    <td class="text-sm-center text-right" data-title="Price"><span>Rs.<span class="price{{$i}}">{{$item->price}}</span></span></td>
                                    <td class="text-sm-center text-right" data-title="Quantity">
                                        <div class="detail-qty border radius  m-auto">
                                            <i onclick="update_cart(<?php echo $item->p_id ?>,<?php echo $item->color_id ?>,<?php echo $item->size_id ?>,'up',{{$i}})" class="fi-rs-angle-small-up up" style="position: absolute;top: 3px;right: 18px;"></i>
                                            <span ><input class="qty{{$i}}" style="padding: 0;height:20px;border:none;pointer-events: none;" type="text" name="" id="" value="{{$item->qty}}"></span>
                                            <i onclick="update_cart(<?php echo $item->p_id ?>,<?php echo $item->color_id ?>,<?php echo $item->size_id ?>,'down',{{$i}})" class="fi-rs-angle-small-down down" style="position: absolute;bottom: 3px;right: 18px;" ></i>
                                        </div>
                                    </td>
                                    <td class=" text-sm-center text-right" data-title="Subtotal">
                                        Rs.<span class='SBT sub_total{{$i}}'>{{$item->qty*$item->price}}</span>
                                    </td>
                                    <td class="action text-sm-center text-right" data-title="Action"><a href="#" class="text-muted"><i onclick="remove(<?php echo $item->p_id ?>,<?php echo $item->color_id ?>,<?php echo $item->size_id ?>,{{$i}})" class="fi-rs-trash"></i></a></td>
                                    
                                </tr>

                                @php
                                    $total = $total+($item->qty*$item->price);
                                    $i++
                                @endphp
                                @endforeach
                               
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-action text-center d-sm-flex " style="justify-content: space-between">
                        <a class="btn mt-2" href="/"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        <a href="/checkout" class="btn mt-2 chk_btn"> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
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


   <script>
   
   </script>
@endsection