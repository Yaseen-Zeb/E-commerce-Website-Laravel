@extends('admin.main');
@section('page_title')
    Product
@endsection
@section('product_active',"active")
@section('main_section')
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6" style="text-align: end" >
          <a href="/admin_penal/product/manage_product" class="btn btn-primary btn-sm">ADD NEW</a>
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
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    if (!isset($data[0])) {
                                       echo '<tr style="background-color: rgb(223, 136, 136)">
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                    </tr>'; 
                                    }else{
                                        foreach ($data as $value) {
                                       echo '<tr>
                                        <td>#'.$value->p_id.'</td>
                                        <td>'.$value->title.'</td>
                                        <td>'.$value->slug.'</td>
                                        <td><img width="100px" heigth="100px" src="'.asset("storage/images/".$value->image."").'" alt="fff" ></td>
                                        <td>';
                                            if ($value->status == 1) {
                                            echo '<a href="/admin_penal/product/manage_product/status/0/'.$value->p_id.'" class="btn btn-danger btn-sm delete-blood">Active</a>';
                                           }else{
                                            echo '<a href="/admin_penal/product/manage_product/status/1/'.$value->p_id.'" class="btn btn-danger btn-sm delete-blood">Deactive</a>';

                                           }
                                           echo '</td>

                                        <td>
                                            <a href="/admin_penal/product/manage_product/'.$value->p_id.'/'.$value->cat_id.'/'.$value->sub_cat_id."/".$value->brand_id.'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/admin_penal/product/manage_product/delete/'.$value->p_id.'" class="btn btn-danger btn-sm delete-blood"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                    </tr>';
                                        }
                                    }
                                    @endphp
                                
                                </tbody>
                            </table>
                            {{-- <img src="{{asset('storage\images\1681029955-.jpg')}}" alt="dfdfds"> --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection