@extends('admin.main');
@section('page_title')
    Orders
@endsection
@section('orders_active',"active")
@section('main_section')
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            @if (session()->has("message"))
                 <div class="alert alert-success py-0">{{session("message")}}</div>
            @endif
            <div class="row"> 
                <div class="col-12">
                            <table id="example1" class="table table-bordered table-hover table-striped table-inverse ">
                            <table id="example1" class="table table-bordered table-hover table-striped table-inverse ">
                                <thead class="bg-dark">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Coupon</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Payment ID</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Placed At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!isset($orders[0])) {
                                        
                                       echo '<tr style="background-color: rgb(223, 136, 136)">
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                    </tr>'; 
                                    }else{
                                        foreach ($orders as $value) {
                                    ?>
                                    <tr>
                                     <td class="text-sm-center text-right" data-title="Order ID"><a class="badge badge-danger ob p-2" href="/admin_penal/order_details/{{$value->id}}
                                        ">{{"ORD_".$value->id}}</a> </td>
                                        @if ($value->coupon_code != "")
                                            <td class="text-sm-center text-right" data-title="Order Status">{{$value->coupon_code}}</td>
                                        @else
                                        <td class="text-sm-center text-right" data-title="Order Status"><span style="font-weight:700">---</span></td>
                                        @endif
                                    
                                    <td class="text-sm-center text-right" data-title="Order Status">{{$value->status}}</td>
                                    <td class="text-sm-center text-right" data-title="Payment Status">{{$value->payment_status}}</td>
                                    @if ($value->payment_id != "")
                                    <td class="text-sm-center text-right" data-title="Payment ID">{{$value->payment_id}}</td>
                                    @else
                                    <td class="text-sm-center text-right" data-title="Payment ID"><span style="font-weight:700">---</span></td>
                                    @endif
                                    <td class="text-sm-center text-right" data-title="Total Amount"><span>Rs.<span>{{$value->total_price}}</span></span></td>
                                    <td class="text-sm-center text-right" data-title="Placed At">{{$value->added_on}}</td>
</tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                
                                </tbody>
                            </table>
                            {{-- <img src="{{asset('storage\images\1681029955-.jpg')}}" alt="dfdfds"> --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection