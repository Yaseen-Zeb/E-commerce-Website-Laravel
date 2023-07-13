@extends('admin.main');
@section('page_title')
    Out of Stock
@endsection
@section('outofstock_active',"active")
@section('main_section')
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Out of Stock Products</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-12">
                            <table style="width: 100%" id="example1" class="table table-bordered table-hover table-striped table-inverse ">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    if (!isset($out_of_stock[0])) {
                                       echo '<tr style="background-color: rgb(223, 136, 136)">
                                        <td style="width:1%">Empty</td>
                                        <td style="width:1%">Empty</td>
                                        <td style="width:1%">Empty</td>
                                        <td style="width:1%">Empty</td>
                                        <td style="width:1%">Empty</td>
                                        <td style="width:1%">Empty</td>
                                    </tr>'; 
                                    }else{
                                        $p = 0;
                                        // <td style="width:1%"></td>
                                        foreach ($out_of_stock as $value) {
                                       echo '<tr>
                                        <td style="width:1%">
                                        <p>
                                            <a class="collapsed" data-toggle="collapse" href="#contentIdp'.$p.'" aria-expanded="false" aria-controls="contentIdp'.$p.'">
                                                #'.$value->p_id.' / '.count($attr[$value->p_id]).'(attributes)  <i class="fas fa-sort-down     "></i>
                                            </a>
                                        </p>
                                        <div class="collapse" id="contentIdp'.$p.'" style="">';
                                            foreach ($attr[$value->p_id] as $val) {
                                           echo '<div class="row">
                                                <div class="col-5"><img width="100px" heigth="80px" src="'.asset("storage/images/".$val->image."").'" alt="fff" ></div>
                                            <div class="col-7">
                                                <div>SKU : '.$val->sku.'</div>';
                                                if ($val->color_name != "") {
                                                    echo  '<div>Color : '.$val->color_name.'</div>';
                                                }
                                                if ($val->size_name != "") {
                                                    echo  '<div>Size : '.$val->size_name.'</div>';
                                                }
                                            echo '</div>
                                            
                                            </div>
                                            <hr class="my-1">';
                                        }
                                       echo '</div>
                                    </td>
                                        <td style="width:1%">'.$value->title.'</td>
                                        <td style="width:1%">'.$value->slug.'</td>
                                        

                                        <td style="width:1%">
                                            <a href="/admin_penal/product/manage_product/'.$value->p_id.'/'.$value->cat_id.'/'.$value->sub_cat_id."/".$value->brand_id.'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            </td>
                                    </tr>';
                                    $p++;
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