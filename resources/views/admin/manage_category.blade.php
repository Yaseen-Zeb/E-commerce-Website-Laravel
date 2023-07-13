@extends('admin.main')
@section('main_section')
@section('category_active',"active")
@if ($cat_name != "")
    @section('page_title',"Category upadte Page")
    @else
    @section('page_title',"Category add Page")
    @endif
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Category</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/category")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                            <form class="form-horizontal" id="add-city" action="{{$url}}" method="post" enctype="multipart/form-data">
                                @if (session()->has("error"))
                                <div class="alert alert-danger py-0" role="alert">{{session("error")}}</div>
                            @endif
                                @csrf
                                <div class="form-group col-6">
                                    <label for="">Category Name *</label>
                                    <input type="text" class="form-control" value="{{$cat_name}}" name="CategoryName" placeholder="Category Name" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Category Slug *</label>
                                    <input type="text" class="form-control"  value="{{$slug_name}}" name="CategorySlug" placeholder="Category Slug" >
                                </div>
                                <div class="form-group col-6 ">
                                    <label for="" class="mb-0">Select Image</label>
                                    <input type="file" class="form-control-file" name="image" @if ($image === "")
                                        required
                                    @endif> 
                                    @if ($image != "")
                                         <div><a target="_blank" href="{{asset('storage/images/category/'.$image)}}"><img  width="95" height="70" src="{{asset('storage/images/category/'.$image)}}" alt="df"></a></div>
                                
                                    @endif 
                                 </div>  
                              <div class="form-check mb-6 pl-4">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="collection_check" id="" value="1" {{$collection_check}}>
                                  Show In Navbar Collection
                                </label>
                              </div>
                              <div class="form-check mb-6 pl-4">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="home_check" id="" value="1" {{$home_check}}>
                                  Show On Home Page
                                </label>
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