@extends('front.main')
@section('title')
{{$product[0]->title}} 
@endsection
@section('main_section')
@if (count($reviews) > 0)
    <?php $sum_of_numbers = 0; ?>
@foreach ($reviews as $item)
<?php $sum_of_numbers = $sum_of_numbers+$item->rating ?>
@endforeach
<?php
$avarage_rating =round($sum_of_numbers/count($reviews));
 ?>
@else
<?php
$avarage_rating =5;
 ?>
@endif
    


<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> {{$product[0]->sub_cat_name}}
                <span></span> {{$product[0]->title}}
            </div>
        </div>
    </div>
    <input type="hidden" class="hidden" value="{{asset("storage/images/")}}">
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        {{--  --}}
                                        <figure class="border-radius-10 ">
                                            <img class="main_img" src="{{asset("storage/images/")."/".$product[0]->image}}" alt="product image">
                                        </figure>
                                        
                                        {{-- main-image --}}

                                        @if (isset($product_images[0]))
                                            @foreach ($product_images as $item)
                                        {{-- <figure class="border-radius-10">
                                            <img src="{{asset("storage/images/")."/".$item->image}}" alt="product image">
                                        </figure> --}}
                                        <figure class="border-radius-10">
                                            <img src="{{asset("storage/images/")."/".$item->image}}" alt="product image">
                                        </figure>
                                            @endforeach
                                        @endif
                                       
                                        
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                    <div><img src="{{asset("storage/images/")."/".$product[0]->image}}" alt="product image"></div>
                                    
                                    @if (isset($product_images[0]))
                                    @foreach ($product_images as $item)
                                    <div><img src="{{asset("storage/images/")."/".$item->image}}" alt="product image"></div>
                                    @endforeach
                                    @endif
                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Share this:</strong></li>
                                        <li class="social-facebook"><a href="#"><img src="{{asset('front/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a></li>
                                        <li class="social-twitter"> <a href="#"><img src="{{asset('front/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img src="{{asset('front/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img src="{{asset('front/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{$product[0]->title}}</h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Brands: <a href="shop.html">
                                            @if ($product[0]->brand_id != "")
                                                {{$product[0]->brand_name}}
                                            @else
                                                unknown
                                            @endif
                                        </a></span>
                                        </div>
                                        <div class="product-rate-cover text-end d-flex">
                                            <div >
                                                @if ($avarage_rating == 5)
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                @elseif ($avarage_rating == 4)
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                @elseif ($avarage_rating == 3)
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                @elseif ($avarage_rating == 2)
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                @elseif ($avarage_rating == 1)
                                                <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                @endif
                                        </div>
                                            <span class="font-small ml-5 text-muted"> ({{count($reviews)}} reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand price">Rs.{{$product_attr[0]->price}}</span></ins>
                                            <ins><span class="old-price font-md ml-15 mrp">Rs.{{$product_attr[0]->mrp}}</span></ins>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            
                                            <li  class="mt-10"><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                            @if ($product[0]->lead_time != 0)
                                                <li style="color: red; font-weight:bold;"><i class="fi-rs-crown 
                                                     mr-5"> {{$product[0]->lead_time}} Delivery</i></li>
                                            @endif
                                            <li class="avalible_qty stock_div" style="display: none">Availability:<span class="in-stock text-success ml-5"><span class="stock_qty_span"></span>  Items In Stock</span></li>
                                        </ul>
                                    </div>

                                    @if (count($avalible_sizes) > 0)
                                   
                                    <div class="attr-detail attr-size mb-15">
                                        <strong class="mr-10">Size</strong>
                                        <ul class="list-filter size-filter font-small">
                                            @foreach ($avalible_sizes as $key => $item)
                                                @if ($item != "")
                                                <li class=""><a href="#" onclick="get(<?php echo $product[0]->p_id?>,<?php echo $key ?>,0,1)">{{$item}}</a></li>
                                                @endif
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                    @endif
                                    

                                    @if (count($avalible_colors) > 0)
                                    <div class="attr-detail attr-color">
                                   <strong class="mr-10">Color</strong>
                                   <ul class="list-filter color-filter">
                                       @foreach ($avalible_colors as $key => $item)
                                           @if ($item != "")
                                           <li class="colors" pid="<?php echo $product[0]->p_id?>" cid="<?php echo $key ?>"><a href="javascript:void(0)"><span style="background-color:<?php echo strtolower($item) ?>" ></span></a></li>
                                           @endif
                                       @endforeach
                                       
                                       
                                   </ul>
                               </div>
                               @endif
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="alert alert-danger w-100 py-0 cart_error" style="display: none" role="alert"></div>
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val" max="">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart" onclick="add_to_cart({{$product[0]->p_id}})">Add to cart</button>
                                            <a href="javascript:void(0)"
                                            @if (session()->has("login"))
                                            onclick="add_wish_list({{$product[0]->p_id}},'add')"
                                        @else
                                      data-toggle="modal" data-target="#modelId"
                                        @endif
                                            aria-label="Add To Wishlist" class="action-btn hover-up" ><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">SKU: <a href="#" class="sku">{{$product_attr[0]->sku}}</a></li>
                                        @if ($product[0]->keywords != "")
                                            <li class="mb-5">Tags: {{$product[0]->keywords}} </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>

                        {{--  --}}
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                @if ($product[0]->uses != "")
                                      <li class="nav-item">
                                    <a class="nav-link" id="Uses-tab" data-bs-toggle="tab" href="#uses">Uses</a>
                                </li>
                                @endif
                              
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{count($reviews)}})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                   {!!$product[0]->description!!}
                                </div>
                                @if ($product[0]->uses != "")
                                    <div class="tab-pane fade" id="uses">
                                  {!!$product[0]->uses!!}
                                </div>
                                @endif
                                
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area p-0 m-0">
                                        <div class="row">
                                            @if (count($reviews) > 0)
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                 
                                                <div class="comment-list" id="reviews">
                                                   @foreach ($reviews as $item)
                                                        <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center" style="margin-top:5px">
                                                                <h6 style="font-size: 15px;">{{$item->name}}</h6>
                                                                <?php  $Y = explode(" ",$item->created_at)  ?>
                                                                <p class="font-xxs">{{$Y[0]}}</p>
                                                            </div>
                                                            <div class="desc">
                                                                    <div >
                                                                        @if ($item->rating == 5)
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        @elseif ($item->rating == 4)
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        @elseif ($item->rating == 3)
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        @elseif ($item->rating == 2)
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        @elseif ($item->rating == 1)
                                                                        <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                                        @endif
                                                                    </div>
                                                                <p class="m-0">{{$item->msg}}</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">{{$item->date}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   @endforeach
                                                   


                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Average</h4>
                                                <div class="d-flex mb-30 " style="align-items: center">
                                                        <div >
                                                            @if ($avarage_rating == 5)
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            @elseif ($avarage_rating == 4)
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            @elseif ($avarage_rating == 3)
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            @elseif ($avarage_rating == 2)
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            @elseif ($avarage_rating == 1)
                                                            <i style="color: rgb(241 155 82)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            <i style="color: rgb(117, 111, 93)"  class="fi-rs-star"></i>
                                                            @endif
                                                    </div>
                                                    <h6 class="ml-2">{{$avarage_rating}} out of 5</h6>
                                                </div>
                                               
                                            </div>
                                        
                                                    @else
                                                        <div class="alert alert-primary col-md-8" role="alert">No Review Yet !</div>
                                                    @endif
                                           </div>
                                    </div>
                                    <!--comment form-->
                                    
                                    <div class="comment-form pt-0">
                                        <h4 class="mb-15">Add a review</h4>
                                        @if (session()->has("login"))
                                        {{-- <div class="product-rate d-inline-block mb-30">
                                        </div> --}}
                                        <fieldset>
                                            <form class="form-contact comment_form review_form"  id="commentForm">
                                                @csrf
                                             <rating style="display:flex">
                                               <input style="border: none;
                                                margin: 0;
                                                padding: 0;
                                                width: 9px;margin-right:15px" class="star_inp" type="radio" name="rating" value="1" aria-label="1 star" required/>
                                               <input style="border: none;
                                                margin: 0;
                                                padding: 0;
                                                width: 9px;margin-right:15px" class="star_inp" type="radio" name="rating" value="2" aria-label="2 stars"/>                                     <input style="border: none;
                                                margin: 0;
                                                padding: 0;
                                                width: 9px;margin-right:15px" class="star_inp" type="radio" name="rating" value="3" aria-label="3 stars"/>
                                               <input style="border: none;
                                                margin: 0;
                                                padding: 0;
                                                width: 9px;margin-right:15px" class="star_inp" type="radio" name="rating" value="4" aria-label="4 stars"/>
                                               <input style="border: none;
                                                margin: 0;
                                                padding: 0;
                                                width: 9px;margin-right:15px" class="star_inp" type="radio" name="rating" value="5" aria-label="5 stars"/>
                                             </rating>
                                            </fieldset>
                                            <input value="{{$product[0]->slug}}" type="hidden" name="p_slug">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                               
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea required class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="alert alert-success r_s py-1 mb-1" style="display: none" role="alert" >dssdf</div>
                                                        <div class="alert alert-danger r_e py-1 mb-1" style="display: none" role="alert" >dssdf</div>
                                                        <button type="submit" class="button button-contactForm r_btn">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                            <div class="alert alert-danger col-5" role="alert">Register or Login To Add Reviews</div>
                                        @endif
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  --}}

                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Related products</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @if (isset($related_products[0]))
                                    @foreach ($related_products as $item)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="/product_details/{{$item->slug}}" tabindex="0">
                                                        <img class="default-img" src="{{asset('storage/images/')."/".$item->image}}" alt="">
                                                        @if (isset($related_hover_products_image[$item->p_id]))
                                                        <img class="hover-img" src="{{asset('storage/images/')."/".$related_hover_products_image[$item->p_id]}}" alt="">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="javascript:void()" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="/product_details/{{$item->slug}}" tabindex="0">{{$item->title}}</a></h2>
                                                <div class="product-price">
                                                    <span>Rs.{{$related_products_attr[$item->p_id][0]->price}}</span>
                                                    <span class="old-price">Rs.{{$related_products_attr[$item->p_id][0]->mrp}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                        <div class="alert alert-danger" role="alert">No Related Product Found</div>
                                    @endif
                                   
                                    
                                </div>
                            </div>
                        </div>                            
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                        <ul class="categories">
                            <li><a href="shop.html">Shoes & Bags</a></li>
                            <li><a href="shop.html">Blouses & Shirts</a></li>
                            <li><a href="shop.html">Dresses</a></li>
                            <li><a href="shop.html">Swimwear</a></li>
                            <li><a href="shop.html">Beauty</a></li>
                            <li><a href="shop.html">Jewelry & Watch</a></li>
                            <li><a href="shop.html">Accessories</a></li>
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
                                    <div class="label-input">
                                        <span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                </div>
                            </div>
                        </div>
                        <a href="shop.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">New products</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('front/imgs/shop/thumbnail-3.jpg')}}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h5><a href="/product_details">Chen Cardigan</a></h5>
                                <p class="price mb-0 mt-5">$99.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('front/imgs/shop/thumbnail-4.jpg')}}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="/product_details">Chen Sweater</a></h6>
                                <p class="price mb-0 mt-5">$89.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:80%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('front/imgs/shop/thumbnail-5.jpg')}}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="/product_details">Colorful Jacket</a></h6>
                                <p class="price mb-0 mt-5">$25</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </section>
</main>
<script>
</script>
@endsection
 



                           