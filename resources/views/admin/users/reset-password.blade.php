<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>

<body class="login-page" style="min-height: 386.781px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step away from your new password, recover your password now.</p>

                <!-- Password Reset Form -->
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu mới" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Đặt lại mật khẩu</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/admin/users/login">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    @include('admin.footer')
   
</body>
</html>
