@extends('admin.main')
@section('main_section')
@section('page_title',"Sub Category")
@section('sub_category_active',"active")
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6" style="text-align: end" >
          <a href="/admin_penal/sub_category/manage_sub_cat" class="btn btn-primary btn-sm">ADD NEW</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            @if (session()->has("message"))
                 <div class="alert alert-success py-0">{{session("message")}}</div>
            @endif
            @if (session()->has("error"))
            <div class="alert alert-danger py-0">{{session("error")}}</div>
       @endif
            <div class="row">
                <div class="col-12">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sub Category Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($data as $value)
                                    <tr>
                                        <td>{{$value->sub_cat_name}}</td>
                                        <td>{{$value->category_name}}</td>
                                        <td>
                                            @if ($value->status == 0)
                                                 <a href="{{url('/admin_penal/sub_category/manage_sub_cat/status/1')."/".$value->id}}" class="btn btn-danger btn-sm">Deatcive</a></td>
                                            @else
                                            <a href="{{url('/admin_penal/sub_category/manage_sub_cat/status/0')."/".$value->id}}" class="btn btn-primary btn-sm">Active</a></td>
                                            @endif
                                           
                                        <td>
                                            <a href="/admin_penal/sub_category/manage_sub_cat/{{$value->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="sub_category/delete/{{$value->id}}" class="btn btn-danger btn-sm delete-blood"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection