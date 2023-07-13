@extends('front.main')
@section('title',"Update Profile Page")
@section('main_section')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>                    
                <span></span> My Profile
            </div>
        </div>
    </div>
    <section class="pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row ">
                        <div class="col-lg-8 m-auto">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Update Details</h3>
                                    </div>                                        
                                    <form class="frmprofileupdate">
                                        @csrf
                                        <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Email :</label>
                                            <input value="{{$email}}" class="form-control" type="email" disabled required="" name="" placeholder="Email">
                                            <input type="hidden" value="{{$email}}" name="email" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Name* :</label>
                                            <input value="{{$name}}" class="form-control" type="text" required="" name="name" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Password :</label>
                                            <input value="{{$password}}" class="form-control " type="text"  name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Mobile number :</label>
                                            <input value="{{$mobile}}" class="form-control mobile" type="number"  name="mobile" placeholder="Mobile number">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address :</label>
                                          <textarea class="form-control" name="address" id="" cols="30" rows="2" placeholder="Address">{{$address}}</textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">State :</label>
                                            <input value="{{$state}}" class="form-control" type="text" name="state" placeholder="State">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">City :</label>
                                            <input value="{{$city}}" class="form-control" type="text" name="city" placeholder="City">
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <div class="alert alert-success success py-1 mb-1" role="alert" style="display: none" ></div>
                                            <div class="alert alert-danger error py-1 mb-1" role="alert" style="display: none" ></div>
                                            <button  type="submit" class="btn btn-fill-out btn-block hover-up submit_btn" name="login">Submit</button>
                                        </div>
                                    </form>
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