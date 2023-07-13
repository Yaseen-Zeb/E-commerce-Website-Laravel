@extends('admin.main');
@section('page_title')
    Coupon
@endsection
@section('color_active',"active")
@section('main_section')
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupon</h1>
          </div>
          <div class="col-sm-6" style="text-align: end" >
          <a href="/admin_penal/color/manage_color" class="btn btn-primary btn-sm">ADD NEW</a>
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
                            <table id="example1" class="table table-bordered table-hover">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Color</th>
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
                                    </tr>'; 
                                    }else{
                                        foreach ($data as $value) {
                                       echo '<tr>
                                        <td>'.$value["id"].'</td>
                                        <td>'.$value["color_name"].'</td>';
                                       echo '<td>';
                                            if ($value["status"] == 1) {
                                            echo '<a href="/admin_penal/color/manage_color/status/0/'.$value["id"].'" class="btn btn-danger btn-sm">Active</a>';
                                           }else{
                                            echo '<a href="/admin_penal/color/manage_color/status/1/'.$value["id"].'" class="btn btn-danger btn-sm">Deactive</a>';

                                           }
                                           echo '</td>

                                        <td>
                                            <a href="/admin_penal/color/manage_color/'.$value["id"].'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/admin_penal/color/manage_color/delete/'.$value["id"].'" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                    </tr>';
                                        }
                                    }
                                    @endphp
                                
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection