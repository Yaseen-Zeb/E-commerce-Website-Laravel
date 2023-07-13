@extends('admin.main')

@section('page_title')
    Category
@endsection
@section('category_active',"active")
@section('main_section')
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
          <a href="/admin_penal/category/manage_cat" class="btn btn-primary btn-sm">ADD NEW</a>
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
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Show in home</th>
                                        <th>Our Collection</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                   @foreach ($data as $value)
                                    <tr>
                                        <td>{{$value->category_name}}</td>
                                        <td>{{$value->category_slug}}</td>
                                        @if ($value->home_show == 1)
                                        <td><span class="badge badge-primary">Yes</span></td>
                                    @else
                                    <td><span class="badge badge-danger badge">NO</span></td>
                                    @endif
                                        @if ($value->our_collection == 1)
                                        <td><span class="badge badge-primary">Yes</span></td>
                                    @else
                                    <td><span class="badge badge-danger badge">NO</span></td>
                                    @endif
                                        <td>
                                            @if ($value["status"] == 0)
                                                 <a href="{{url('/admin_penal/category/manage_cat/status/1')."/".$value->cat_id}}" class="btn btn-primary btn-sm">Deatcive</a></td>
                                            @else
                                            <a href="{{url('/admin_penal/category/manage_cat/status/0')."/".$value->cat_id}}" class="btn btn-primary btn-sm">Active</a></td>
                                            @endif
                                           
                                        <td>
                                            <a href="/admin_penal/category/manage_cat/{{$value->cat_id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="category/delete/{{$value->cat_id}}" class="btn btn-danger btn-sm delete-blood"><i class="fa fa-trash" aria-hidden="true"></i></a>
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