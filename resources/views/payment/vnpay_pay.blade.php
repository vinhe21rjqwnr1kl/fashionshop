<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #f8f9fa;">

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="text-primary">Tạo mới đơn hàng</h2>
    </div>
    <div class="card shadow-sm p-4">
        <form action="/vnpay_create_payment" method="post">
            @csrf
            <!-- Số tiền -->
            <div class="form-group">
                <label for="amount" class="font-weight-bold">Số tiền</label>
                <input class="form-control" id="amount" name="amount" type="number" value="{{ $total }}" readonly />
            </div>

            <!-- Phương thức thanh toán -->
            <h4 class="font-weight-bold mt-4">Chọn phương thức thanh toán</h4>
            <div class="form-group">
                <h5 class="mt-3">Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h5>
                <div class="custom-control custom-radio">
                    <input type="radio" id="bankCode1" name="bankCode" value="" class="custom-control-input" checked>
                    <label class="custom-control-label" for="bankCode1">Cổng thanh toán VNPAYQR</label>
                </div>
                <h5 class="mt-3">Cách 2: Tách phương thức tại site của đơn vị kết nối</h5>
                <div class="custom-control custom-radio">
                    <input type="radio" id="bankCode2" name="bankCode" value="VNPAYQR" class="custom-control-input">
                    <label class="custom-control-label" for="bankCode2">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="bankCode3" name="bankCode" value="VNBANK" class="custom-control-input">
                    <label class="custom-control-label" for="bankCode3">Thanh toán qua thẻ ATM/Tài khoản nội địa</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="bankCode4" name="bankCode" value="INTCARD" class="custom-control-input">
                    <label class="custom-control-label" for="bankCode4">Thanh toán qua thẻ quốc tế</label>
                </div>
            </div>

            <!-- Ngôn ngữ -->
            <div class="form-group">
                <h5 class="font-weight-bold">Chọn ngôn ngữ giao diện thanh toán:</h5>
                <div class="custom-control custom-radio">
                    <input type="radio" id="languageVN" name="language" value="vn" class="custom-control-input" checked>
                    <label class="custom-control-label" for="languageVN">Tiếng Việt</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="languageEN" name="language" value="en" class="custom-control-input">
                    <label class="custom-control-label" for="languageEN">Tiếng Anh</label>
                </div>
            </div>

            <!-- Nút thanh toán -->
            <button type="submit" class="btn btn-primary btn-block mt-4">Thanh toán</button>
        </form>
    </div>

    <footer class="text-center mt-4">
        <p class="text-muted">&copy; VNPAY 2024</p>
    </footer>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
