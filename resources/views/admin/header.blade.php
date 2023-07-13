<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>@yield('page_title')</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/css/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/responsive.bootstrap4.min.css')}}">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin/css/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <!-- editor -->
  <link rel="stylesheet" href="{{asset('admin/css/editor.css')}}">
  <style>
    .notActive{
    color: #3276b1;
    background-color: #fff;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item @yield('active')">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item @yield('active')">
      </li>
    </ul>
    <ul class="navbar-nav">
      <div class="dropdown">
        
          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Hi @if (session()->has("admin_login"))
           {{session("admin_name")}}
            @else
                Admin
            @endif
          </button>
          
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="../change-password/changepassword.php">Change Password</a>
              <a class="dropdown-item logout" href="logout">Log Out</a>
          </div>
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->

 {{-- sidebar --}}

 <aside class="main-sidebar sidebar-dark-primary elevation-4">
 
 
         <a href="../dashboard/dashboard.php" class="brand-link text-center">
           <span style="font-weight:900; font-size:40px">My-Ecom</span>
         </a>
 
     <!-- Sidebar -->
     <div class="sidebar">
       <!-- Sidebar user panel (optional) -->
      
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="text-center w-100">
           <span class="text-center" style="font-weight:500; font-size:20px; color:rgb(255, 255, 255)">Admin Penal</span>
         </div>
       </div>
 
       <!-- Sidebar Menu -->
       <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item ">
             <a href="/admin_penal/dashboard" class="nav-link  @yield('dashboard_active')">
               <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>
                 Dashboard
               </p>
             </a>
           </li>

           <li class="nav-item ">
             <a href="/admin_penal/product" class="nav-link  @yield('product_active')">
               <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>
                 Products
               </p>
             </a>
           </li>
           
           <li class="nav-item">
             <a href="/admin_penal/category" class="nav-link @yield('category_active')">
               <i class="fa fa-list" aria-hidden="true"></i>
               <p>
                 Category
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="/admin_penal/sub_category" class="nav-link @yield('sub_category_active')">
               <i class="fas fa-subscript    "></i>
               <p>
                Sub Category
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="/admin_penal/brand" class="nav-link @yield('brand_active')">
               <i class="fas fa-code-branch    "></i>
               <p>
                 Brand
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="/admin_penal/coupon" class="nav-link @yield('coupon_active')">
               <i class="fa fa-tags" aria-hidden="true"></i>
               <p>
                 Coupon
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="/admin_penal/size" class="nav-link @yield('size_active')">
               <i class="fa fa-window-maximize" aria-hidden="true"></i>
               <p>
                 Size
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="/admin_penal/color" class="nav-link @yield('color_active')">
               <i class="fa fa-paint-brush" aria-hidden="true"></i>
               <p>
                 Color
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="/admin_penal/home_banner" class="nav-link @yield('home_banner_active')">
               <i class="fas fa-images"></i>
               <p>
                 Home Banners
               </p>
             </a>
           </li>
           <li class="nav-item">
            <a href="/admin_penal/orders" class="nav-link @yield('orders_active')">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin_penal/reviews" class="nav-link @yield('reviews_active')">
              <i class="fas fa-book-open    "></i>
              <p>
                Reviews
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin_penal/out_of_stock" class="nav-link @yield('outofstock_active')">
              <i class="fa fa-ban" aria-hidden="true"></i>
              <p>
                Out of Stock
              </p>
            </a>
          </li>
         </ul>
       </nav>
       <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
   </aside>
 
