@extends('admin.main')
@section('dashboard_active',"active")
@section('page_title')
    Dashborad
@endsection
@section('main_section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
           
            <div class="small-box bg-info">
              <div class="inner">
                <h3>5454</h3>
                <p>Total Donors</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="../donor/donor.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
           
            <div class="small-box bg-success">
              <div class="inner">
                <h3>90</h3>
                <p>Total Blood Group</p>
              </div>
              <div class="icon">
                <i class="fas fa-clinic-medical"></i>
              </div>
              <a href="../blood-group/blood.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
           
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>87</h3>
                <p>Total City</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-city"></i>
              </div>
              <a href="../city/city.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
           
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
           
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>543</h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-user"></i>
              </div>
              <a href="../users/user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
           
          </div>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
