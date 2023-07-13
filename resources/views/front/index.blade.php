@extends('front.main')
@section("title",'Online Shop')
@section('main_section')
<main class="main">
@section('nav_active',"active")
    <section class="home-slider position-relative ">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">

            @if (isset($home_banner[0]))
                     @foreach ($home_banner as $item)
                     <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-12 col-md-12">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img style="width: 100%; height:100%" class="animated slider-1-1" src="{{asset('storage/images/home_banner/')."/".$item->image}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
            @else

            @endif
          
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>
    {{--  --}}
    <section class="featured section-padding position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{asset('front/imgs/theme/icons/feature-1.png')}}" alt="">
                        <h4 class="bg-1">Free Shipping</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{asset('front/imgs/theme/icons/feature-2.png')}}" alt="">
                        <h4 class="bg-3">Online Order</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{asset('front/imgs/theme/icons/feature-3.png')}}" alt="">
                        <h4 class="bg-2">Save Money</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{asset('front/imgs/theme/icons/feature-4.png')}}" alt="">
                        <h4 class="bg-4">Promotions</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{asset('front/imgs/theme/icons/feature-5.png')}}" alt="">
                        <h4 class="bg-5">Happy Sell</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="{{asset('front/imgs/theme/icons/feature-6.png')}}" alt="">
                        <h4 class="bg-6">24/7 Support</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#featured" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#trending" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Trending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#discounted" type="button" role="tab" aria-controls="discounted" aria-selected="false">Discounted</button>
                    </li>
                </ul>
                <a href="#" class="view-more d-none d-md-flex">View More<i class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @if (isset($featured_products[0]))
                            @foreach ($featured_products as $item)
                                 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="/product_details/{{$item->slug}}">
                                            <img class="default-img" src="{{asset('storage/images/')."/".$item->image}}" alt="">
                                            @if (isset($featured_hover_products_image[$item->p_id]))
                                                <img class="hover-img" src="{{asset('storage/images/')."/".$featured_hover_products_image[$item->p_id]}}" alt="">
                                            @endif
                                            
                                            
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up"onclick="add_wish_list({{$item->p_id}},'add')" href="javascript:void(0)"><i class="fi-rs-heart"></i></a>
                                        
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a>
                                    </div>
                                    <h2><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h2>
                                    <div class="product-price">
                                        <span>Rs.{{$featured_products_attr[$item->p_id][0]->price}}</span>
                                        <span class="old-price">Rs.{{$featured_products_attr[$item->p_id][0]->mrp}}</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" onclick="home_add_to_cart(<?php echo $item->p_id ?>,<?php echo $featured_products_attr[$item->p_id][0]->size_id ?>,<?php echo $featured_products_attr[$item->p_id][0]->color_id ?>,1)" href="javascript:void(0)"><i class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @else
                            
                        @endif
                       
                        
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab one (Featured)-->
                <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="trending">
                    <div class="row product-grid-4">
                        @if (isset($trending_products[0]))
                            @foreach ($trending_products as $item)
                                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="/product_details/{{$item->slug}}">
                                            <img class="default-img" src="{{asset('storage/images/')."/".$item->image}}" alt="">
                                            @if (isset($trending_hover_products_image[$item->p_id]))
                                            <img class="hover-img" src="{{asset('storage/images/')."/".$trending_hover_products_image[$item->p_id]}}" alt="">
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
                                        <a href="sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a>
                                    </div>
                                    <h2><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h2>
                                    <div class="product-price">
                                        <span>Rs.{{$trending_products_attr[$item->p_id][0]->price}}</span>
                                        <span class="old-price">Rs.{{$trending_products_attr[$item->p_id][0]->mrp}}</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" onclick="home_add_to_cart(<?php echo $item->p_id ?>,<?php echo $trending_products_attr[$item->p_id][0]->size_id ?>,<?php echo $trending_products_attr[$item->p_id][0]->color_id ?>,1)" href="javascript:void(0)"><i class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @else
                            
                        @endif
                      
                        
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab two (Popular)-->
                <div class="tab-pane fade" id="discounted" role="tabpanel" aria-labelledby="discounted">
                    <div class="row product-grid-4">
                        @if (isset($discounted_products[0]))
                            @foreach ($discounted_products as $item)
                                 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="/product_details/{{$item->slug}}">
                                            <img class="default-img" src="{{asset('storage/images/')."/".$item->image}}" alt="">
                                            @if (isset($discounted_hover_products_image[$item->p_id]))
                                            <img class="hover-img" src="{{asset('storage/images/')."/".$discounted_hover_products_image[$item->p_id]}}" alt="">
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
                                        <a href="sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a>
                                    </div>
                                    <h2><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h2>
                                    
                                    <div class="product-price">
                                        <span>Rs.{{$discounted_products_attr[$item->p_id][0]->price}}</span>
                                        <span class="old-price">Rs.{{$discounted_products_attr[$item->p_id][0]->mrp}}</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" onclick="home_add_to_cart(<?php echo $item->p_id ?>,<?php echo $discounted_products_attr[$item->p_id][0]->size_id ?>,<?php echo $discounted_products_attr[$item->p_id][0]->color_id ?>,1)" href="javascript:void(0)"><i class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endif
                       
                        
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab three (New added)-->
            </div>
            <!--End tab-content-->
        </div>
    </section>
    
  
    <section class="popular-categories section-padding mt-15 mb-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    <?php
                    if (isset($categories[0])) {
                        foreach ($categories as  $category) {
                           ?>
                          <div class="card-1">
                           <figure class=" img-hover-scale overflow-hidden">
                               <a href="category/{{$category->category_slug}}"><img style="width:100%" src="{{asset('storage/images/category/')."/".$category->image}}" alt=""></a>
                            </figure>
                             <h5><a href="category/{{$category->category_slug}}">{{$category->category_name}}</a></h5>
                            </div>
                           <?php
                        }
                    }
                    ?>
                    
                   
                    
                </div>
            </div>
        </div>
    </section>

    
    <section class="section-padding">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>New</span> Arrivals</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    @if (isset($new_products[0]))
                            @foreach ($new_products as $item)
                    <div class="product-cart-wrap small hover-up">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="/product_details/{{$item->slug}}">
                                    <img class="default-img" src="{{asset('storage/images/')."/".$item->image}}" alt="">
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                    <i class="fi-rs-eye"></i></a>
                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" onclick="add_wish_list({{$item->p_id}},'add')" href="javascript:void(0)" tabindex="0"><i class="fi-rs-heart"></i></a>
                                
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <h2><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h2>
                            <div class="product-price">
                                <span>Rs.{{$new_products_attr[$item->p_id][0]->price}}</span>
                                <span class="old-price">Rs.{{$new_products_attr[$item->p_id][0]->mrp}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
                </div>
            </div>
        </div>
    </section>
   
    <section class="section-padding">
        <div class="container">
            <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
            <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                    <?php 
                    if (isset($brands[0])) {
                       foreach ($brands as  $brand) {
                        ?>
                        <a href="/brand/{{$brand->id}}">
                        <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('storage/images/brand/'.$brand->image)}}" alt="">
                        </div></a>
                  <?php
                       }
                    }
                    ?>
                    
                  
                </div>
            </div>
        </div>
    </section>
</main>
@endsection