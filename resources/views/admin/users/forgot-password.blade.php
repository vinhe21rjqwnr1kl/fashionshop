<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="login-page" style="min-height: 332.781px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Coza</b>Store</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

                <!-- Forgot Password Form -->
                <form action="{{ route('forgot.password.send') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Gửi liên kết reset mật khẩu</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/admin/users/login">Login</a>
                </p>
                <p class="mb-0">
                    <a href="/admin/users/register" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    @include('admin.footer')

</body>
</html>
