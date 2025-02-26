
<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
    
    
      <li class="nav-item dropdown" style="right: 90px;max-width:200px">
        <div class="d-flex align-items-center">
          
          @if (Auth::user() && Auth::user()->thumb)
          {{-- Kiểm tra nếu đường dẫn thumb đã là URL tuyệt đối --}}
          @if (filter_var(Auth::user()->thumb, FILTER_VALIDATE_URL))
              <img src="{{ Auth::user()->thumb }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-4" style="width: 40px; height: 40px;">
          @else
              <img src="{{ asset('storage/' . Auth::user()->thumb) }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-4" style="width: 40px; height: 40px;">
          @endif
      @else
          <img src="{{ asset('template/images/icons/R.png') }}" alt="User Avatar" class="rounded-circle me-4" style="width: 40px; height: 40px;">
      @endif
                  <span class="fw-bold dropdown-toggle" style="margin-left: 10px" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="">Thông tin người dùng</a></li>
                <li><a class="dropdown-item" href="/change-password">Đổi mật khẩu</a></li>
                <li><a class="dropdown-item" href="/">Về Trang Chủ</a></li>
                <li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
              </li>
            </ul>
        </div>
    </li>
<style>
  .dropdown:hover .dropdown-menu {
    display: block;
}
  </style>    
    
    </ul>
  </nav>
  <!-- /.navbar -->

  @include('admin.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @include('admin.alert')
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary mt-3">
              <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
              </div>

              @yield('content')
            
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  @include('admin.footer')
</body>
</html>
