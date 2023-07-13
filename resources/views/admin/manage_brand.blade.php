@extends('admin.main')
@section('main_section')
@section('brand_active',"active");
@if ($brand_name != "")
    @section('page_title',"Brand upadte Page")
    @else
    @section('page_title',"Brand add Page")
    @endif
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Brand</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/brand")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                            <form class="form-horizontal" id="add-city" action="{{$url}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-6">
                                    @if (session()->has("error") )
                                          <div class="alert alert-danger py-0">{{session("error")}}</div>
                                    @endif
                                    <label for="">Brand Name</label>
                                    <input type="text" class="form-control" value="{{$brand_name}}" name="brand_name" placeholder="Brand Name" required >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Select Category</label>
                                    <select onchange="getRelatedData()" class="form-control cat_selector" name="cat_id" id="" required>
                                        <option value="">Select Category</option>
                                        @foreach ($cat_s as $item)
                                        @if ($cat_id == $item["cat_id"])
                                        <option selected value="{{$item["cat_id"]}}">{{$item["category_name"]}}</option>
                                        @else
                                              <option value="{{$item["cat_id"]}}">{{$item["category_name"]}}</option>
                                        @endif
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group col-6 ">
                                    <label for="" class="mb-0">Select Image</label>
                                    <input type="file" class="form-control-file" name="image" @if ($image === "")
                                        required
                                    @endif> 
                                    @if ($image != "")
                                         <div><a target="_blank" href="{{asset('storage/images/brand/'.$image)}}"><img  width="95" height="70" src="{{asset('storage/images/brand/'.$image)}}" alt="df"></a></div>
                                    @endif 
                                 </div>  
                              <div class="form-check mb-6 pl-4">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="home_check" id="" value="1" {{$check}}>
                                  Show On Home Page
                                </label>
                              </div>
                                <div class="form-group col-6 mt-3">
                                    <input type="submit" class="btn btn-primary" value="{{$btn_val}}">
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection