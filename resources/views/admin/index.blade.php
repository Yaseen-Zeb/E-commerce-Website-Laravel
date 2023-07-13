
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/css/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="admin/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href=admin/css/adminlte.min.css>
</head>
<div class="message"></div>
<body class="hold-transition login-page">
 
<div class="login-box">
 
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo">
        <a href="#" style="font-weight:900">Laravel E-com</a>
      </div>
    <div class="card-body login-card-body">
      <form id="login" action="{{url('admin_penal/dashboard')}}" method="POST" autocomplete="off">
      @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control username" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control password" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fas fa-lock    "></i>
            </div>
          </div>
        </div>
        @if (session()->has("error"))
              {!! '<div class="alert alert-warning py-0">'.session('error').'</div>' !!} 
        @endif
        
      <div class="row">
          <div class="offset-md-8 col-4">
            <input type="submit" class="btn btn-primary float-right" name="login" value="Login">
          </div>
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="admin/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/js/adminlte.min.js"></script>
</body>
</html>
