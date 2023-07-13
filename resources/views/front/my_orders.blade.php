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
   
    @if (isset($data[0]))
        <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Placed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                     <tr  style="border-bottom: 2px solid #F15412;">
                                    <td class="text-sm-center text-right" data-title="Order ID"><a class="badge badge-danger ob p-2" href="my_order_details/{{$item->id}}
                                        ">{{"ORD_".$item->id}}</a> </td>
                                    <td class="text-sm-center text-right" data-title="Order Status">{{$item->status}}</td>
                                    <td class="text-sm-center text-right" data-title="Payment Status">{{$item->payment_status}}</td>
                                    @if ($item->payment_id != "")
                                    <td class="text-sm-center text-right" data-title="Payment ID">{{$item->payment_id}}</td>
                                    @else
                                    <td class="text-sm-center text-right" data-title="Payment ID"><span style="font-weight:700">---</span></td>
                                    @endif
                                    <td class="text-sm-center text-right" data-title="Total Amount"><span>Rs.<span>{{$item->total_price}}</span></span></td>
                                    <td class="text-sm-center text-right" data-title="Placed At">{{$item->added_on}}</td>
                                </tr>

                               
                                @endforeach
                               
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-action text-center d-sm-flex " style="justify-content: space-between">
                        <a class="btn mt-2" href="/"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        <a href="/checkout" class="btn mt-2"> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
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