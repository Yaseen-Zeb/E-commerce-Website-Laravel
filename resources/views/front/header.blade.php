<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
<title>@yield('title')</title>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="">
<meta property="og:type" content="">
<meta property="og:url" content="">
<meta property="og:image" content="">
<link rel="shortcut icon" type="image/x-icon" href="{{asset('front/imgs/theme/favicon.ico')}}">
<link rel="stylesheet" href="{{asset('front/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('front/css/main.css')}}">
<link rel="stylesheet" href="{{asset('front/css/custom.css')}}">
<link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">

<style>







.ob {
  animation: pulse 5s infinite;
}

@keyframes pulse {
  0% {
    background-color: #0080ff;
  }
  100% {
    background-color: #ff463c;
  }
}
    label{
        font-weight: 600;
    }
    i[class*=" fi-rs-"]:before{
        padding-right: 5px
    }
    .categori-dropdown-wrap ul li.has-children .dropdown-menu{
        width: unset;
    }
    li a span{
        border: 1px solid;
    }

/* .container {
  padding: 2rem 0rem;
} */

h4 {
  margin: 2rem 0rem;
}

/* .container {
  padding: 2rem 0rem;
} */

@media (min-width: 576px) {
  .modal-dialog {
    max-width: 400px;
  }
  .modal-dialog .modal-content {
    padding: 1rem;
  }
}
.modal-header .close {
  margin-top: -1.5rem;
}

.form-title {
  margin: -2rem 0rem 2rem;
}

.btn-round {
  border-radius: 3rem;
}

.delimiter {
  padding: 1rem;
}

.social-buttons .btn {
  margin: 0 0.5rem 1rem;
}

.signup-section {
  padding: 0.3rem 0rem;
}

/*  */
/* make the current radio visually hidden */
input[type="radio"] {
  -webkit-appearance: none;
  margin: 0;
  box-shadow: none; /* remove shadow on invalid submit */
}

/* generated content is now supported on input. supporting older browsers? change button above to {position: absolute; opacity: 0;} and add a label, then style that, and change all selectors to reflect that change */
input[type="radio"]::after {
  content: "\2605";
  font-size: 32px;
}

/* by default, if no value is selected, all stars are grey */
input[type="radio"]:invalid::after {
  color: #ddd;
}

/* if the rating has focus or is hovered, make all stars darker */
rating:hover input[type="radio"]:invalid::after,
rating:focus-within input[type="radio"]:invalid::after {
  color: #888;
}

/* make all the stars after the focused one back to ligh grey, until a value is selected */
rating:hover input[type="radio"]:hover ~ input[type="radio"]:invalid::after,
rating input[type="radio"]:focus ~ input[type="radio"]:invalid::after {
  color: #ddd;
}

/* if a value is selected, make them all selected */
rating input[type="radio"]:valid {
  color: orange;
}
/* then make the ones coming after the selected value look inactive */
rating input[type="radio"]:checked ~ input[type="radio"]:not(:checked)::after {
  color: #ccc;
  content: "\2606"; /* optional. hollow star */
}

</style>

</head>

<body class="body">
    {{-- {{show_arr(nav_data())}}
    @php
        die();
    @endphp --}}
    <input type="hidden" class="img_path" value="{{asset('storage/images/')."/"}}">
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                        <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> English <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="#"><img src="{{asset('front/imgs/theme/flag-fr.png')}}" alt="">Français</a></li>
                                        <li><a href="#"><img src="{{asset('front/imgs/theme/flag-dt.png')}}" alt="">Deutsch</a></li>
                                        <li><a href="#"><img src="{{asset('front/imgs/theme/flag-ru.png')}}" alt="">Pусский</a></li>
                                    </ul>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Get great devices up to 50% off <a href="shop.html">View details</a></li>
                                    <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today <a href="shop.html">Shop now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>  
                                @if (session()->has("user_name"))
                                <?php
                               $firstname =  explode(" ",session("user_name"))[0];
                                ?>
                                 <div class="dropdown open">
                                    <i style="font-weight:600;    font-size: 16px;
                                    border: #d15f45 2px solid;
                                    border-radius: 28px;" class="dropdown-toggle fi-rs-user p-1 mr-2" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" >Hi {{strtoupper($firstname) }}</i>
                        <div class="dropdown-menu" style="left: -50px;" aria-labelledby="triggerId">
                            <a href="/profile"><button class="dropdown-item">My Profile</button></a>
                            <a href="/my_orders"><button class="dropdown-item">My Orders</button></a>
                            <a   href="/logout"><button class="dropdown-item">Logout</button></a>
                        </div>
                       </div>
                                {{-- <li><span style="color: black; padding-right:15px">Hi <span style="color: #e12d2d;font-weight: 600;"> {{strtoupper($firstname) }}</span></span>/<a href="/logout">Log out </a></li> --}}
                                @else
                                <div class="dropdown open">
                                    <i style="font-weight:600;    font-size: 16px;
                                    border: #d15f45 2px solid;
                                    border-radius: 28px;" class="dropdown-toggle fi-rs-user p-1" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" > Hi user</i>
                        <div class="dropdown-menu" style="left: -50px;" aria-labelledby="triggerId">
                            <a href="/register"><button class="dropdown-item">Register</button></a>
                            <a class="login_pop"   data-toggle="modal" data-target="#modelId" href="javascript:void(0)"><button class="dropdown-item">Login</button></a>
                        </div>
                       </div>
                                @endif                      
                              

                              
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="/index.php"><img src="{{asset('front/imgs/logo/logo.png')}}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-1">
                            <form action="javascript:void(0)">                                
                                <input type="text" class="search_inp" placeholder="Search for items...">
                              <button class="search" onclick="search('lg')"><i class="fi-rs-search"></i></button>  
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="/wishlist">
                                        <img class="svgInject" alt="Surfside Media" src="{{asset('front/imgs/theme/icons/icon-heart.svg')}}">
                                        <span class="pro-count blue wishlist_count">{{wishlist_count()}}</span>
                                    </a>
                                </div>
                                <div class="header-action-icon-2 cart_icon">
                                    <a class="mini-cart-icon" href="/cart.php">
                                        <img alt="Surfside Media" src="{{asset('front/imgs/theme/icons/icon-cart.svg')}}">
                                        <span class="pro-count blue cart_count">{{count(cart_pop())}}</span>
                                    </a>
                                    <div class="pop">
                                    @if (count(cart_pop()) > 0)
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul class="cart_pop">
                                            @php
                                                $total = 0;
                                                $i = 0;
                                            @endphp
                                            @foreach (cart_pop() as $item)
                                            @php
                                                $total += $item->qty*$item->price;
                                            @endphp
                                            <li class="row{{$i}}">
                                                <div class="shopping-cart-img">
                                                    <a href="/product_details.php/{{$item->slug}}"><img alt="Surfside Media" src="{{asset('storage/images/')."/".$item->image}}"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="/product_details/{{$item->slug}}">{{$item->title}}</a></h4>
                                                    <h4><span>{{$item->qty}} × </span><span>Rs.</span><span>{{$item->price}}</span></h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i onclick="remove({{$item->p_id}},{{$item->color_id}},{{$item->size_id}},{{$i}})" class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                            @php
                                                $i++;
                                            @endphp
                                           @endforeach
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span class="total">Rs.{{$total}}</span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="/cart.php" class="outline">View cart</a>
                                                <a href="checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.html"><img src="{{asset('front/imgs/logo/logo.png')}}" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> Browse Categories
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                @if (isset(nav_data()["browse_categories"][0]))
                                @php
                                        $i = 1;
                                        $j=0;
                                    @endphp
                                <ul>
                                    
                                @foreach (nav_data()["browse_categories"] as $category)
                                @php
                                    
                                    $icon = "";
                                @endphp
                                @if (isset(nav_data()["browse__sub_categories"][nav_data()["browse_categories"][$j]->cat_id]["section1"][0]))
                                @php
                                    $icon = "has-children";
                                @endphp
                                @endif
                                {{-- {{$browse_categories[0]->cat_id}} --}}
                                    <li class="{{$icon}}">
                                        @php
                                              $j++;
                                        @endphp
                                        <a href="/category/{{$category->category_slug}}"><i class="surfsidemedia-font-dress"></i>{{$category->category_name}}</a>
                                        @if (isset(nav_data()["browse__sub_categories"][$category->cat_id]["section1"][0]))
                                        @php
                                        $drop_w = '';
                                            if (isset(nav_data()["browse__sub_categories"][$category->cat_id]["section1"][0]) && isset(nav_data()["browse__sub_categories"][$category->cat_id]["section2"][0]) && !isset(nav_data()["browse__sub_categories"][$category->cat_id]["section3"][0])) {
                                                $w = 'col-lg-6';  
                                                $drop_w = '291px';  
                                            }elseif (isset(nav_data()["browse__sub_categories"][$category->cat_id]["section1"][0]) && !isset(nav_data()["browse__sub_categories"][$category->cat_id]["section2"][0]) && !isset(nav_data()["browse__sub_categories"][$category->cat_id]["section3"][0])) {
                                                $w = 'col-lg-12';  
                                                $drop_w = '180px';  
                                            } elseif (isset(nav_data()["browse__sub_categories"][$category->cat_id]["section1"][0]) && isset(nav_data()["browse__sub_categories"][$category->cat_id]["section2"][0]) && isset(nav_data()["browse__sub_categories"][$category->cat_id]["section3"][0])) {
                                                $w = 'col-lg-4';
                                                $drop_w = '500px';  
                                            }
                                                            
                                                        @endphp
                                            <div class="dropdown-menu px-0" style="min-width: {{$drop_w}}; ">
                                            <ul class="mega-menu">
                                                <li class="">
                                                    <div class="mb-1" style="color: red; text-align:center;">Sub-Categories</div>
                                                    <ul class="row">
                                                        
                                                        <li class="mega-menu {{$w}}" style="padding-left: 0;
                                                        ">
                                                            <ul>
                                                                @foreach (nav_data()["browse__sub_categories"][$category->cat_id]["section1"] as $item)
                                                                <li><a class="dropdown-item nav-link nav_item" href="/sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @if (isset(nav_data()["browse__sub_categories"][$category->cat_id]["section2"][0]))
                                                        <li class="mega-menu {{$w}}">
                                                            <ul>
                                                                @foreach (nav_data()["browse__sub_categories"][$category->cat_id]["section2"] as $item)
                                                                <li><a class="dropdown-item nav-link nav_item" href="/sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @endif
                                                        @if (isset(nav_data()["browse__sub_categories"][$category->cat_id]["section3"][0]))
                                                             <li class="mega-menu {{$w}}">
                                                            <ul>
                                                                @foreach (nav_data()["browse__sub_categories"][$category->cat_id]["section3"] as $item)
                                                                <li><a class="dropdown-item nav-link nav_item" href="/sub_category/{{$item->id}}">{{$item->sub_cat_name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                        
                                    </li>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                    {{-- <ul class="more_slide_open" style="display: none;">
                                        <li><a href="shop.html"><i class="surfsidemedia-font-desktop"></i>Beauty, Health</a></li>
                                        <li><a href="shop.html"><i class="surfsidemedia-font-cpu"></i>Bags and Shoes</a></li>
                                        <li><a href="shop.html"><i class="surfsidemedia-font-diamond"></i>Consumer Electronics</a></li>
                                        <li><a href="shop.html"><i class="surfsidemedia-font-home"></i>Automobiles & Motorcycles</a></li>
                                    </ul> --}}
                            </ul>
                                  <div class="more_categories">Show more...</div>
                            @else
                                
                            @endif
                               
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="@yield('nav_active')" href="/">Home </a></li>
                                    <li class="@yield('shop_active')"><a href="/shop">Shop</a></li>
                                    <li class="position-static "><a class="@yield('coll_active')" href="#">Our Collections <i class="fi-rs-angle-down"></i></a>
                                         @if (isset(nav_data()["our_collection"][0]))
                                            <ul class="mega-menu">
                                            @foreach (nav_data()["our_collection"] as $item)
                                                 <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="/category/{{$item->category_slug}}">{{$item->category_name}}</a>
                                                <ul>
                                                    @foreach (nav_data()["our_collection_sub_categories"][$item->cat_id] as $item1)
                                                        <li><a href="/sub_category/{{$item1->id}}">{{$item1->sub_cat_name}}</a></li>
                                                    @endforeach
                                                    
                                                    
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                            @else
                                               <ul class="mega-menu">
                                               <div class="alert alert-danger py-0" role="alert">
                                                No Collection Found
                                               </div>
                                                </ul> 
                                            @endif
                                        
                                    </li>
                                    <li class=""><a class="@yield('about_active')" href="/about">About</a></li>                                
                                    <li ><a class="@yield('contact_active')" href="/contact">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>Toll Free</span> (+1) 0000-000-000 </p>
                    </div>
                    <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="/wishlist">
                                    <img alt="Surfside Media" src="{{asset('front/imgs/theme/icons/icon-heart.svg')}}">
                                    <span class="pro-count white wishlist_count">{{wishlist_count()}}</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="/cart.php">
                                    <img alt="Surfside Media" src="{{asset('front/imgs/theme/icons/icon-cart.svg')}}">
                                    <span class="pro-count white cart_count">{{count(cart_pop())}}</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="Surfside Media" src="{{asset('front/imgs/shop/thumbnail-3.jpg')}}"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="Surfside Media" src="{{asset('front/imgs/shop/thumbnail-4.jpg')}}"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="/cart.php">View cart</a>
                                            <a href="shop-checkout.php">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
   
    <div class="mobile-header-active mobile-header-wrapper-style ">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{asset('front/imgs/logo/logo.png')}}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="javascript:void(0)">
                        <input type="text" class="search_inp_mob" placeholder="Search for items…">
                        <button type="button" class="search_mob" onclick="search('mob')"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>
                       

                        @if (isset(nav_data()["browse_categories"][0]))
                                
                            @foreach (nav_data()["browse_categories"] as $category)
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                                <li><a href="/category/{{$category->category_slug}}"><i class="surfsidemedia-font-dress"></i>{{$category->category_name}}</a></li>
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="/">Home</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="/shop">shop</a></li>
                           
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="/contact">Contact us</a></li>
                            @if (session()->has("user_name"))
                            <?php
                           $firstname =  explode(" ",session("user_name"))[0];
                            ?>
                            <li class="menu-item-has-children"><span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><span class="menu-expand"></span><a href="#">Hi {{$firstname}}</a>
                                <ul class="dropdown" style="display: none;">
                                    <li><a href="/profile">My Profile</a></li>
                                    <li><a href="/my_orders">My Orders</a></li>
                                    <li><a href="/logout">Logout</a></li>
                                </ul>
                            </li>
                            @else
                            <li class="menu-item-has-children"><span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span><span class="menu-expand"></span><a href="#">Hi user</a>
                                <ul class="dropdown" style="display: none;">
                                    <li><a href="/register">Register</a></li>
                                    <li><a class="login_pop" data-toggle="modal" data-target="#modelId" href="javascript:void(0)">Login</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-social-icon mt-3">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="{{asset('front/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                    <a href="#"><img src="{{asset('front/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>



    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4>Login</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form class="loginform">
                    @csrf
                    <div class="form-group">
                        <div class="alert alert-danger login_error py-1" style="display: none" role="alert"></div>
                        <div class="alert alert-primary login_success py-1" style="display: none" role="alert"></div>
                      <input name="email1" required type="email" class="form-control" id="email1" placeholder="Your email address...">
                    </div>
                    <div class="form-group">
                      <input name="password1" required type="password" class="form-control f" id="password1" placeholder="Your password...">
                    </div>
                    <button type="submit" class="btn btn-info btn-block btn-round login_submit_btn">Login</button>
                  </form>
              </div>
            </div>
              <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Not a member yet? <a href="/register" class="text-info">Register</a>.</div>
              </div>
          </div>
        </div>
    </div>
    

    {{--  --}}
<form id="cart_form">
    @csrf
    <input class="cart_pid" type="hidden" name="p_id" value="">
    <input class="cart_qty" type="hidden" name="qty" value="">
    <input class="cart_sid" type="hidden" name="s_id" value="">
    <input class="cart_cid" type="hidden" name="c_id" value="">
</form>

<form id="sort_form">
    <input class="limit" type="hidden" name="limit"  @if (isset( $limit) && $limit != "")value="{{$limit}}" @endif>
    <input class="sort" type="hidden" name="sort"  @if (isset( $sort) && $sort != "")value="{{$sort}}" @endif>
    <input class="min" type="hidden" name="min"  @if (isset($min) && $min != "")value="{{$min}}" @endif>
    <input class="max" type="hidden" name="max"  @if (isset( $max) && $max != "")value="{{$max}}" @endif>
    <input class="color_filter" type="hidden" name="color_filter"  @if (isset( $color_filter) && $color_filter != "")value="{{$color_filter}}" @endif>
</form>


   {{--  --}}

   