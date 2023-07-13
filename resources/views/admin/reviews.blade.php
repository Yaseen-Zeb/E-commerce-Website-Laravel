@extends('admin.main');
@section('page_title')
    Reviews
@endsection
@section('reviews_active',"active")
@section('main_section')
<div class="message"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reviews</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-12">
                            <table id="example1" class="table table-bordered table-hover table-striped table-inverse ">
                            <table id="example1" class="table table-bordered table-hover table-striped table-inverse ">
                                <thead class="bg-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Review</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!isset($reviews[0])) {
                                        
                                       echo '<tr style="background-color: rgb(223, 136, 136)">
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                        <td>Empty</td>
                                    </tr>'; 
                                    }else{
                                        $u = 0;
                                        $p = 0;
                                        foreach ($reviews as $value) {
                                    ?>
                                    <tr>
                                     <td >{{"REV_".$value->id}}</td>
                                    
                                    <td >
                                        <p>
                                            <a class="" data-toggle="collapse" href="#contentIdu{{$u}}" aria-expanded="false" aria-controls="contentIdu{{$u}}">
                                                {{$value->name}} <i class="fas fa-sort-down    "></i>
                                            </a>
                                        </p>
                                        <div class="collapse" id="contentIdu{{$u}}">
                                            <div>{{$value->email}}</div>
                                            @if ($value->mobile != "")
                                                <div>{{$value->mobile}}</div>
                                            @endif
                                            <div>{{$value->created_at}}</div>
                                            
                                        </div>
                                    </td>
                                    <td >
                                    <p>
                                        <a class="" data-toggle="collapse" href="#contentIdp{{$p}}" aria-expanded="false" aria-controls="contentIdp{{$p}}">
                                        {{$value->title}} <i class="fas fa-sort-down"></i>
                                        </a>
                                    </p>
                                    <div class="collapse" id="contentIdp{{$p}}">
                                        <img width="100px" heigth="100px" src="{{asset('storage/images'."/".$value->image)}}" alt="fff">
                                    </div>
                                 </td>
                                    <td ><div >
                                        @if ($value->rating == 5)
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        @elseif ($value->rating == 4)
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        @elseif ($value->rating == 3)
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        @elseif ($value->rating == 2)
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        @elseif ($value->rating == 1)
                                        <i style="color: rgb(241 155 82)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        <i style="color: rgb(117, 111, 93)"  class="fa fa-star"></i>
                                        @endif
                                    </div></td>
                                    <td >{{$value->msg}}</td>
                                    <td>
                                    @if ($value->status == 1)
                                        <a href="/admin_penal/reviews/status/0/{{$value->id}}" class="btn btn-danger btn-sm">Active</a>
                                       @else
                                        <a href="/admin_penal/reviews/status/1/{{$value->id}}" class="btn btn-danger btn-sm">Deactive</a>
                                       @endif
                                    </td>
                                    <td >{{$value->date}}</td>
</tr>
                                    <?php
                                    $u++;
                                    $p++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            {{-- <img src="{{asset('storage\images\1681029955-.jpg')}}" alt="dfdfds"> --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection