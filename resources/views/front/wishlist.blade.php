@extends('front.main')
@section('title',"Wistlist || Page")
@section('main_section')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> My Wishlist
            </div>
        </div>
    </div>
   <span class="add_price_conditional_span d-none" ></span>
    @if (isset($products_in_wishlist[0]))
        <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products_in_wishlist as $item)
                                     <tr  style="border-bottom: 2px solid #F15412;">
                                    <td data-title="Image" class="image product-thumbnail text-sm-center text-right"><img src="{{asset('storage/images/'."/".$item->image)}}" alt="#"></td>
                                    <td data-title="Name / Collection" class="product-des product-name text-sm-center text-right">
                                        <h5 class="product-name "><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h5>
                                    </td>
                                    <td class="text-sm-center text-right" data-title="Price"><span>Rs.<span>{{$attr[$item->p_id][0]->price}}</span></span></td>
                                    
                                    <td class="action text-sm-center text-right" data-title="Action"><button class=" btn btn-primary btn-sm" style="color:white" onclick="home_add_to_cart(<?php echo $item->p_id ?>,<?php echo $attr[$item->p_id][0]->size_id ?>,<?php echo $attr[$item->p_id][0]->color_id ?>,1)">Add to cart</button></td>
                                    <td class="action text-sm-center text-right" data-title="Action"><a href="#" class="text-muted"><i onclick="add_wish_list(<?php echo $item->p_id ?>,'delete')" class="fi-rs-trash"></i></a></td>
                                    
                                </tr>
                                @endforeach
                               
                              
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    @else
        <div class="alert alert-warning container mt-4"style="font-weight: 600" role="alert">No Product You Added In Wishlist Yet!</div>
        <div class="cart-action text-center">
            <a class="btn" href="/" ><i class="fi-rs-shopping-bag mr-5"></i>Continue Shopping</a>
        </div>
    @endif
</main>


   <script>
   
   </script>
@endsection