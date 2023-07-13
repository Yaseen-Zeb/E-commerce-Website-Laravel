@extends('admin.main');
@section('page_title')
    Coupon
@endsection
@section('coupon_active',"active")
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
          <a href="/admin_penal/coupon/manage_coupon" class="btn btn-primary btn-sm">ADD NEW</a>
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
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Value</th>
                                        <th>Type</th>
                                        <th>Use time</th>
                                        <th>Minimum order amount</th>
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
                                        <td>'.$value["title"].'</td>
                                        <td>'.$value["code"].'</td>';
                                        echo  $value["type"] == 'value' ? '<td>Rs.'.$value["value"].'</td>' : '<td>'.$value["value"].'%</td>';
                                        echo  $value["type"] == 'value' ? '<td>Value</td>' : '<td>Percentage</td>';
                                        echo  $value["use_times"] == 1 ? '<td>One time</td>' : '<td>Multiple times</td>';
                                       echo '<td>Rs.'.$value["order_min_amount"].'</td>';
                                       echo '<td>';
                                            if ($value["status"] == 1) {
                                            echo '<a href="/admin_penal/coupon/manage_coupon/status/0/'.$value["id"].'" class="btn btn-danger btn-sm delete-blood">Active</a>';
                                           }else{
                                            echo '<a href="/admin_penal/coupon/manage_coupon/status/1/'.$value["id"].'" class="btn btn-danger btn-sm delete-blood">Deactive</a>';

                                           }
                                           echo '</td>

                                        <td>
                                            <a href="/admin_penal/coupon/manage_coupon/'.$value["id"].'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="/admin_penal/coupon/manage_coupon/delete/'.$value["id"].'" class="btn btn-danger btn-sm delete-blood"><i class="fa fa-trash" aria-hidden="true"></i></a>
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