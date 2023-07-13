@extends('admin.main');
@section('main_section')
@section('color_active',"active")
@if ($color_name != "")
    @section('page_title',"Color upadte Page")
    @else
    @section('page_title',"Color add Page")
    @endif
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Color</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/color")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
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
                                    <label for="">Color Name</label>
                                    <input type="text" class="form-control" value="{{$color_name}}" name="color_name" required placeholder="Color Name" >
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