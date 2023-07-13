@extends('admin.main')
@section('main_section')
@section('sub_category_active',"active");
@if ($sub_cat_name != "")
    @section('page_title',"Sub_category upadte Page")
    @else
    @section('page_title',"Sub_category add Page")
    @endif
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Sub Category</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/sub_category")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                            <form class="form-horizontal" id="add-city" action="{{$url}}" method="post">
                                @csrf
                                <div class="form-group col-6">
                                    @if (session()->has("error") )
                                          <div class="alert alert-danger py-0">{{session("error")}}</div>
                                    @endif
                                    <label for="">Sub Category Name</label>
                                    <input type="text" class="form-control" value="{{$sub_cat_name}}" name="sub_cat_name" placeholder="Sub Category Name" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Select Category</label>
                                    <select onchange="getRelatedData()" class="form-control cat_selector" name="cat_id" id="" required>
                                        <option value="">Select Category</option>
                                        @foreach ($cat_s as $item)
                                        @if ($cat_id == $item->cat_id)
                                        <option selected value="{{$item["cat_id"]}}">{{$item["category_name"]}}</option>
                                        @else
                                              <option value="{{$item["cat_id"]}}">{{$item["category_name"]}}</option>
                                        @endif
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group col-6">
                                    <input type="submit" class="btn btn-primary" value="{{$btn_val}}">
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection