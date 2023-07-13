@extends('front.main')
@section('title',"About us Page")
@section('main_section')
<main class="main single-page">
    @section('about_active',"active")
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>                    
                <span></span> About us
            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container pt-25">
            <div class="row">
                <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                    <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated animated animated" style="visibility: visible;">Our Company</h6>
                    <h1 class="font-heading mb-40">
                        We are Building The Destination For Getting Things Done
                    </h1>
                    <p>Tempus ultricies augue luctus et ut suscipit. Morbi arcu, ultrices purus dolor erat bibendum sapien metus.</p>
                    <p>Tempus ultricies augue luctus et ut suscipit. Morbi arcu, ultrices purus dolor erat bibendum sapien metus. Sit mi, pharetra, morbi arcu id. Pellentesque dapibus nibh augue senectus. </p>
                </div>
                <div class="col-lg-6">
                    <img src="{{asset('/front/imgs/page/about-1.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>                
    <section id="testimonials" class="section-padding">
        <div class="container pt-25">
            <div class="row mb-50">
                <div class="col-lg-12 col-md-12 text-center">
                    <h6 class="mt-0 mb-10 text-uppercase  text-brand font-sm wow fadeIn animated animated animated" style="visibility: visible;">some facts</h6>
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated animated animated" style="visibility: visible;">Take a look what<br> our clients say about us</h2>
                    <p class="w-50 m-auto text-grey-3 wow fadeIn animated animated animated" style="visibility: visible;">At vero eos et accusamus et iusto odio dignissimos ducimus quiblanditiis praesentium. ebitis nesciunt voluptatum dicta reprehenderit accusamus</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex" style="visibility: hidden; animation-name: none;">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{asset('/front/imgs/page/avatar-1.jpg')}}" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                J. Bezos
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex" style="visibility: hidden; animation-name: none;">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{asset('/front/imgs/page/avatar-3.jpg')}}" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B.Gates
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex" style="visibility: hidden; animation-name: none;">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{asset('/front/imgs/page/avatar-2.jpg')}}" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B. Meyers
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex" style="visibility: hidden; animation-name: none;">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{asset('/front/imgs/page/avatar-4.jpg')}}" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                J. Bezos
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex" style="visibility: hidden; animation-name: none;">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{asset('/front/imgs/page/avatar-5.jpg')}}" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B.Gates
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex" style="visibility: hidden; animation-name: none;">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{asset('/front/imgs/page/avatar-1.jpg')}}" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B. Meyers
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-12 text-center">
                    <p class="wow fadeIn animated" style="visibility: hidden; animation-name: none;">
                        <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg">View More</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container pb-25">
            <h3 class="section-title mb-20 wow fadeIn animated text-center" style="visibility: hidden; animation-name: none;"><span>Featured</span> Clients</h3>
            <div class="carausel-6-columns-cover position-relative wow fadeIn animated" style="visibility: hidden; animation-name: none;">
                <div class="carausel-6-columns text-center slick-initialized slick-slider" id="carausel-6-columns-3">
                    <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 4400px; transform: translate3d(-1540px, 0px, 0px); transition: transform 1000ms ease 0s;"><div class="brand-logo slick-slide slick-cloned" data-slick-index="-6" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-2.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="-5" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-3.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="-4" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-4.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="-3" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-5.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-6.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-3.png')}}" alt="">
                    </div><div class="brand-logo slick-slide" data-slick-index="0" aria-hidden="true" tabindex="0" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-1.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-current slick-active" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-2.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-active" data-slick-index="2" aria-hidden="false" tabindex="0" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-3.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-active" data-slick-index="3" aria-hidden="false" tabindex="0" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-4.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-active" data-slick-index="4" aria-hidden="false" tabindex="0" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-5.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-active" data-slick-index="5" aria-hidden="false" tabindex="0" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-6.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-active" data-slick-index="6" aria-hidden="false" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-3.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="7" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-1.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="8" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-2.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="9" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-3.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="10" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-4.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="11" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-5.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="12" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-6.png')}}" alt="">
                    </div><div class="brand-logo slick-slide slick-cloned" data-slick-index="13" id="" aria-hidden="true" tabindex="-1" style="width: 220px;">
                        <img class="img-grey-hover" src="{{asset('front/imgs/banner/brand-3.png')}}" alt="">
                    </div></div></div>
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
</main>
@endsection