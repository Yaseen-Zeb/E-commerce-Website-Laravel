@extends('front.main')
@section('title',"Registeration Page")
@section('main_section')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>                    
                <span></span> REgister
            </div>
        </div>
    </div>
    <section class="pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row ">
                        <div class="col-lg-7 m-auto">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Create an Account</h3>
                                    </div>                                        
                                    <form class="frmregister">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" name="name" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" required="" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="alert alert-success success py-1 mb-1" role="alert" style="display: none" ></div>
                                            <div class="alert alert-danger error py-1 mb-1" role="alert" style="display: none" ></div>
                                            <button  type="submit" class="btn btn-fill-out btn-block hover-up submit_btn" name="login">Submit & Register</button>
                                        </div>
                                    </form>                                        
                                    <div class="text-muted text-center">Already have an account? <a data-toggle="modal" data-target="#modelId" href="javascript:void(0)">Sign in now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection