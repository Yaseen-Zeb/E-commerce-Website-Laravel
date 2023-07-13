@extends('admin.main')
@section('main_section')
@if ($title != "")
    @section('page_title',"Coupon upadte Page")
    @else
    @section('page_title',"Coupon add Page")
    @endif
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Coupon</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/coupon")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                            <form class="form-horizontal" id="add-city" action="{{$url}}" method="post">
                                @if (session()->has("error") )
                                <div class="alert alert-danger py-0">{{session("error")}}</div>
                                @endif
                                @csrf
                                <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Coupon Name</label>
                                    <input type="text" class="form-control" value="{{$title}}" name="title"  placeholder="Coupon Name" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Coupon Code</label>
                                    <input type="text" class="form-control" value="{{$code}}" name="code"  placeholder="Coupon Code" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Coupon Value</label>
                                    <input type="number" class="form-control" value="{{$value}}" name="value"  placeholder="Coupon Vlaue" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Coupon type</label>
                                    <select class="form-control" name="type" id="" >
                                        @if ($type == "value")
                                        <option selected value="value">value</option>
                                        <option value="per">percentage</option>
                                        @elseif($type == "per")
                                        <option  value="value">value</option>
                                        <option selected value="per">percentage</option>
                                        @else
                                        <option  value="">Select Coupon use times</option>
                                        <option  value="value">value</option>
                                        <option  value="per">percentage</option>
                                        @endif
                                      </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Minimum order amount</label>
                                    <input type="number" class="form-control" value="{{$order_min_amount}}" name="order_min_amount" required placeholder="Minimum order amount" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Coupon use times</label>
                                    <select class="form-control" name="use_times" id="" required>
                                        @if ($use_times == 1)
                                        <option selected value="1">One time</option>
                                        <option value="0">Multiples time</option>
                                        @elseif($use_times == 0)
                                        <option  value="1">One time</option>
                                        <option selected value="0">Multiples time</option>
                                        @else
                                        <option  value="">Select Coupon use times</option>
                                        <option  value="1">One time</option>
                                        <option  value="0">Multiples time</option>
                                        @endif
                                      </select>
                                </div>
                            </div>
                            <div class="form-group col-4 mx-auto">
                                    <input  type="submit" class="btn btn-primary w-100" value="{{$btn_val}}">
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection