<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <link href="/assets/bootstrap.min.css" rel="stylesheet" />
    <script src="/assets/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php
    @include('/config');
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }
    ?>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg w-96 p-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-green-600">FASHION SHOP</h3>
            </div>
            <form action="/saveInForPay" method="post">
                @csrf
                <div class="space-y-4">
                    <div class="text-gray-700">
                        <label class="block font-medium">Mã đơn hàng:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_TxnRef'] ?></p>
                        <input type="hidden" name="madon" value="<?php echo $_GET['vnp_TxnRef'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Số tiền:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_Amount'] ?></p>
                        <input type="hidden" name="sotien" value="<?php echo $_GET['vnp_Amount'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Nội dung thanh toán:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_OrderInfo'] ?></p>
                        <input type="hidden" name="noidung" value="<?php echo $_GET['vnp_OrderInfo'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Mã phản hồi:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_ResponseCode'] ?></p>
                        <input type="hidden" name="maphanhoi" value="<?php echo $_GET['vnp_ResponseCode'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Mã GD tại VNPAY:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_TransactionNo'] ?></p>
                        <input type="hidden" name="magiaodich" value="<?php echo $_GET['vnp_TransactionNo'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Mã ngân hàng:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_BankCode'] ?></p>
                        <input type="hidden" name="manganhang" value="<?php echo $_GET['vnp_BankCode'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Thời gian thanh toán:</label>
                        <p class="bg-gray-100 p-2 rounded"><?php echo $_GET['vnp_PayDate'] ?></p>
                        <input type="hidden" name="thoigian" value="<?php echo $_GET['vnp_PayDate'] ?>">
                    </div>
                    <div class="text-gray-700">
                        <label class="block font-medium">Kết quả:</label>
                        <p class="bg-gray-100 p-2 rounded">
                            <?php
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "<span class='text-blue-500'>GD Thành công</span>";
                                echo "<input type='hidden' name='kq' value='GD Thành công'>";
                            } else {
                                echo "<span class='text-red-500'>GD Không thành công</span>";
                                echo "<input type='hidden' name='kq' value='GD Không thành công'>";
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Quay về trang chủ</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const miniCart = JSON.parse(localStorage.getItem('miniCartss')) || [];
        miniCart.splice(0, miniCart.length);
        localStorage.setItem('miniCartss', JSON.stringify(miniCart));
    </script>
</body>
</html>
