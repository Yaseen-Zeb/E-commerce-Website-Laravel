@extends('admin.main')
@section('main_section')
@if ($size_name != "")
    @section('page_title',"Size upadte Page")
@endsection
    @else
    @section('page_title',"Size add Page")
    @endif
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add New Size</h1>
            </div>
            <div class="col-sm-6" style="text-align: end">
            <a href="{{url("admin_penal/size")}}" class="btn btn-primary btn-sm mr-3">BACK</a>
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
                                    <label for="">Size Name</label>
                                    <input type="text" class="form-control" value="{{$size_name}}" name="size_name" required placeholder="Size Name" >
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