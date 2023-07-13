@extends('front.main')
@section('title',"Profile Page")
@section('main_section')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>                    
                <span></span> MY Profile
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h2 class="section-head text-center">My Profile</h2>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Name</h6></div>
                            <div class="col-sm-9 text-secondary">{{$name}}</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                            <div class="col-sm-9 text-secondary">{{$email}}</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Phone/Mobile</h6></div>
                            <div class="col-sm-9 text-secondary">{{$mobile}}</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                            <div class="col-sm-9 text-secondary">{{$address}}</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">State</h6></div>
                            <div class="col-sm-9 text-secondary">{{$state}}</div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">City</h6></div>
                            <div class="col-sm-9 text-secondary">{{$city}}</div>
                        </div>
                        <hr />
                        <div class="row text-center">
                            <div class="col-sm-12"><a class="modify-btn btn m-auto" href="/update_profile">Modify Details</a></div>
                        </div>
                    </div>
                </div>                             
            </div>
        </div>
    </div>
    
</main>
@endsection