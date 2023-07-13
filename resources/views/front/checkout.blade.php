@extends('front.main')
@section('title',"Cart || Page")
@section('main_section')

<main class="main" data-select2-id="263">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50" data-select2-id="262">
        <div class="container" data-select2-id="261">
            <div class="row">
                <div class="col-lg-6 mb-sm-15">
                    @if (session()->has("login") == false)
                        <div class="toggle_info">
                        <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an account?</span> <a data-toggle="modal" data-target="#modelId" href="javascript:void(0)"aria-expanded="false">Click here to login</a></span>
                    </div>
                    @endif
                    
                </div>
                <div class="col-lg-6 coupon_col">
                    <div class="toggle_info">
                        <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a class="" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Click here to enter your code</a></span>
                    </div>
                    <div class="row">
                        <div class="col">
                          <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card card-body">
                                <p class="mb-8 font-sm">If you have a coupon code, please apply it below.</p>
                                <form class="coupon_form">
                                    @csrf
                                    <div class="form-group">
                                        <input class="coupon_offical_inp" type="text" name="coupon" required placeholder="Enter Coupon Code...">
                                    </div>
                                    <div class="form-group">
                                        <div class="alert alert-success coupon_success py-1 mb-1" role="alert" style="display: none" ></div>
                                        <div class="alert alert-danger coupon_error py-1 mb-1" role="alert" style="display: none" ></div>
                                        <button class="btn  btn-md coupon_submit_btn" type="submit" >Apply Coupon</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                    <div class="panel-collapse coupon_form collapse" id="coupon" style="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-25">
                        <h4>Billing Details</h4>
                    </div>
                    <form class="checkout_form" data-select2-id="10">
                        @csrf
                        <div class="form-group">
                            <label >Name *</label>
                            @if (session()->has("login"))
                            <input disabled value="{{$name}}" class="form-control bg-light" type="text" required  placeholder="Name *">
                            <input value="{{$name}}" class="form-control" type="hidden" required name="fname">
                            @else
                            <input value="{{$name}}" class="form-control" type="text" required name="fname" placeholder="Name *">
                            @endif
                        </div>
                        <div class="form-group ">
                            <label >Billing Address *</label>
                           <textarea class="form-control" name="billing_address" required placeholder="Address *" id="" cols="30" rows="2">{{$address}}</textarea>
                        </div>
                         <div class="form-group">
                            <label >State *</label>
                            <input value="{{$state}}" required type="text" name="state" placeholder="State / County *">
                        </div>
                        <div class="form-group">
                            <label >City</label>
                            <input value="{{$city}}" required type="text" name="city" placeholder="City / Town *">
                        </div>
                       
                        <div class="form-group">
                            <label >zip/postal Code *</label>
                            <input value="{{$zip}}" required type="text" name="zipcode" placeholder="Postcode / ZIP *">
                        </div>
                        <div class="form-group">
                            <label >Mobile *</label>
                            @if (session()->has("login") && $mobile != "")
                                <input value="{{$mobile}}" class="bg-light" required type="number" disabled name="phone" placeholder="Phone *">
                                <input value="{{$mobile}}" required  name="phone" type="hidden" name="" id="">
                            @else
                            <input value="{{$mobile}}" required type="number" name="phone" placeholder="Phone *">
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label >Email *</label>
                            @if (session()->has("login") && $email != "")
                                <input disabled class="bg-light" value="{{$email}}" required type="email"  placeholder="Email address *">
                                <input type="hidden" value="{{$email}}" name="email" id="">
                            @else
                            <input  value="{{$email}}" required type="email" name="email"  placeholder="Email address *">
                            @endif
                            
                            
                        </div>
                         @if (session()->has("login") == false)
                         <div class="form-group">
                            <label >Password *</label>
                            <input value="{{$password}}" class="password" required type="password" name="password"  placeholder="Password... *">
                        </div>

                        <div class="alert alert-primary" role="alert">
                            <strong>Note</strong> : 
                            <p>If You Are Not Register, On Checkout You Will Be Register So Next Time For Chkeckout or To see your order details, You will Need To Login So Remember The given Email And Password, Thanks</p> 
                        </div>
@endif
                        
                        
                        

                         
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total = 0;
                                    ?>
                                    @foreach ($products_in_cart as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{asset('storage/images/'."/".$item->image)}}" alt="#"></td>
                                        <td>
                                            <h5><a href="product_details/{{$item->slug}}">{{$item->title}}</a></h5>
                                            @if ($item->size_name != "")
                                                Size : {!!$item->size_name."<br>"!!} . 
                                            @endif
                                            @if ($item->color_name != "")
                                                Color : {!!$item->color_name."<br>"!!} . 
                                            @endif
                                             <span class="product-qty">Qty : {{$item->qty}}</span>
                                        </td>
                                        <td>Rs {{$item->price}}</td>
                                    </tr>
                                    <?php 
                                    $total = $total+($item->price * $item->qty);
                                     ?>
                                    @endforeach
                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal sub_total" colspan="2">Rs {{$total}}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td colspan="2"><em>Free Shipping</em></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="product-subtotal total"><span class="font-xl text-brand fw-900">Rs {{$total}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Payment</h5>
                            </div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input value="COD" class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3">
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On Delivery</label>                                        
                                </div>
                                <div class="custome-radio">
                                    <input value="card" class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>                                        
                                </div>
                                <div class="custome-radio">
                                    <input value="paypal" class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Paypal</label>                                        
                                </div>
                            </div>
                        </div>
                        {{-- hidden inputs --}}
                        <input type="hidden" name="coupon_code" class="coupon_inp" id="">
                        <input type="hidden" name="total_price" value="{{$total}}" class="total_inp" id="">
                        {{-- hidden inputs --}}
                        <div class="alert alert-success checkout_success py-1 mb-1" role="alert" style="display: none" ></div>
                        <div class="alert alert-danger checkout_error py-1 mb-1" role="alert" style="display: none" ></div>
                        <button  type="submit" class="btn btn-fill-out btn-block mt-30 checkout_btn">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
   <script>
   
   </script>
@endsection