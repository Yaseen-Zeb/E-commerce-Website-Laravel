@extends('front.main')
@section('title',"Search Page")
@section('main_section')
<main class="main">
    @if (count($search_products) > 0)
         <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop <span></span> <a href="">{{$search_products[0]->category_name}}</a> <span></span> <a href="">{{$search_products[0]->sub_cat_name}}</a>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">{{count($search_products)}}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                   
                                    <div class="sort-by-dropdown-wrap">
                                        <span> @if (isset($limit) && $limit != "")
                                            {{$limit}}
                                        @else
                                            8
                                        @endif <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        @for ($i = 8; $i <= 40; $i=$i+8)
                                        <?php
                                        $active = "";
                                        $f_active = "";
                                        $l = 8;
                                        if (isset($limit) && $limit != ""){
                                           if ($limit == $i){
                                                $active = "active";
                                            }else{
                                            $active = "";}
                                            $l = $limit;
                                            }else{
                                            if ($i == 8){
                                            $f_active = "active";
                                             }else{
                                            $f_active = ""; }
                                            }
                                      ?>
                                            <li><a onclick="limit({{$i}})" class="limit{{$i}} {{$active}} {{$f_active}}" href="#">{{$i}}</a></li>
                                       @endfor  
                                
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <i class="fi-rs-angle-small-down"></i>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        @php
                                            $active="";
                                        @endphp
                                        @if ($sort == "")
                                        @php
                                            $active = "active";
                                        @endphp
                                        @endif
                                        <li><a class="{{$active}}" @if ($sort == "featured") class="active" @endif  onclick="sort('featured')" href="javascript:void(0)">Featured</a></li>
                                        <li><a @if ($sort == "trending") class="active" @endif onclick="sort('trending')"  href="javascript:void(0)">Trending</a></li>
                                        <li><a @if ($sort == "L_to_H") class="active" @endif onclick="sort('L_to_H')" href="javascript:void(0)">Price: Low to High</a></li>
                                        <li><a @if ($sort == "H_to_L") class="active" @endif onclick="sort('H_to_L')" href="javascript:void(0)">Price: High to Low</a></li>
                                        <li><a @if ($sort == "latest") class="active" @endif onclick="sort('latest')"  href="javascript:void(0)">Release: Latest</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @if (isset($search_products[0]))
                        @foreach ($search_products as $item)
                             <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="/product_details/{{$item->slug}}">
                                        <img class="default-img" src="{{asset('storage/images/')."/".$item->image}}" alt="">
                                        @if (isset($hover_search_products_img[$item->p_id]))
                                        <img class="hover-img" src="{{asset('storage/images/')."/".$hover_search_products_img[$item->p_id]}}" alt="">
                                    @endif
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" onclick="add_wish_list({{$item->p_id}},'add')" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="/search/{{$item->id}}">{{$item->sub_cat_name}}</a>
                                </div>
                                <h2><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h2>
                                <div class="product-price">
                                    <span>Rs.{{$search_products_attr[$item->p_id][0]->price}}</span>
                                    <span class="old-price">Rs.{{$search_products_attr[$item->p_id][0]->mrp}}</span>
                                </div>
                                <div class="product-action-1 show">
                                    <a aria-label="Add To Cart" class="action-btn hover-up" onclick="home_add_to_cart(<?php echo $item->p_id ?>,<?php echo $search_products_attr[$item->p_id][0]->size_id ?>,<?php echo $search_products_attr[$item->p_id][0]->color_id ?>,1)" href="javascript:void(0)"><i class="fi-rs-shopping-bag-add"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        <div class="alert alert-danger" role="alert"><h1 class="text-center" >OPPs, No Related Product Found !!!</h1></div>
    @endif
   
</main>
@endsection