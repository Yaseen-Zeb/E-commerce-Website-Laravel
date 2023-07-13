@extends('front.main')
@section('title',"Shop Page")
@section('main_section')
<main class="main">
    @if (count($sub_category_products) > 0)
         <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop <span></span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">{{count($sub_category_products)}}</strong> items for you!</p>
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
                        @if (isset($sub_category_products[0]))
                        @foreach ($sub_category_products as $item)
                             <div class="col-lg-4 col-md-4 col-6 col-sm-6">
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
                                    <span>Rs.{{$sub_category_products_attr[$item->p_id][0]->price}}</span>
                                    <span class="old-price">Rs.{{$sub_category_products_attr[$item->p_id][0]->mrp}}</span>
                                </div>
                                <div class="product-action-1 show">
                                    <a aria-label="Add To Cart" class="action-btn hover-up" onclick="home_add_to_cart(<?php echo $item->p_id ?>,<?php echo $sub_category_products_attr[$item->p_id][0]->size_id ?>,<?php echo $sub_category_products_attr[$item->p_id][0]->color_id ?>,1)" href="javascript:void(0)"><i class="fi-rs-shopping-bag-add"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
                    </div>

                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="row">
                        <div class="col-lg-12 col-mg-6"></div>
                        <div class="col-lg-12 col-mg-6"></div>
                    </div>
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Categories</h5>
                         <ul class="categories">
                        @if (count($related_categories) > 0)
                            @foreach ($related_categories as $item)
                                <li><a href="/category/{{$item->category_slug}}">{{$item->category_name}}</a></li>
                            @endforeach
                        @else
                            <div class="alert alert-danger py-2">No Related Category Found!</div>
                        @endif
                       </ul>
                    </div>
                    {{--  --}}
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Sub Categories</h5>
                        <ul class="categories">
                            @if (count($related_sub_categories) > 0)
                                @foreach ($related_sub_categories as $item)
                                    <li><a href="/sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a></li>
                                @endforeach
                            @else
                                <div class="alert alert-danger py-2">No Related Sub Category Found!</div>
                            @endif
                           </ul>
                    </div>
                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input d-flex">
                                        <span>Range:</span> <span style="font-weight: bold"> Rs <input style="width: 34px" type="text" id="min" name=""></span><span style="font-weight: 900">- </span>  <span style="font-weight: bold"> Rs <input style="width: 68px" type="text" id="max" name=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($color_arr) > 0)
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    @foreach ($color_arr as $key => $item)
                                    <?php
                                    if (in_array($key,$exploded_arr)) {
                                        $checked = "checked";
                                    }else{
                                        $checked = "";
                                    }
                                    ?>
                                    <input {{$checked}} onclick="color_filter({{$key}})" class="form-check-input ch{{$key}}" type="checkbox" name="checkbox" id="exampleCheckbox{{$key}}" value="{{$key}}">
                                    <label class="form-check-label" for="exampleCheckbox{{$key}}"><span>{{ucfirst($item)}}</span></label>
                                    <br>
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                         @endif
                        <a href="javascript:void(0)" onclick="filter()" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    <!-- Product sidebar Widget -->
                    @if (isset($new_products[0]))
                        
                    
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">New products</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        @foreach ($new_products as $item)
                            <div class="single-post clearfix">
                            <div class="image">
                                <a href="/product_details/{{$item->slug}}">
                                <img src="{{asset('storage/images')."/".$new_products_attr[$item->p_id][0]->image}}" alt="#">
                            </a>
                            </div>
                            <div class="content pt-10">
                                <h5><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h5>
                                <p class="price mb-0 mt-5">Rs {{$new_products_attr[$item->p_id][0]->price}}</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @else
        <div class="alert alert-danger" role="alert"><h1 class="text-center" >OPPs, No Related Product Found !!!</h1></div>
    @endif
   
</main>


@endsection