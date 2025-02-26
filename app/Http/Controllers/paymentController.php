<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class paymentController extends Controller
{

    public function payment(Request $request)
    {
        $total = $request->input('total');
        return view('payment.vnpay_pay', ['total' => $total]);
    }

    public function createPayment(Request $request)
    {
        $total = $request->input('amount');
        $vnp_TmnCode = "STFPYM9A"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "9GN772O91SC2M8HP4AH2Y7I5TBGTZNDS"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay_return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));


        $vnp_CreateDate = Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis');
        $vnp_ExpireDate = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(15)->format('YmdHis');  // Thời gian hết hạn là 15 phút


        $vnp_TxnRef = rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Locale = "vn"; //Ngôn ngữ chuyển hướng thanh toán

        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $total * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:",
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }



        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        header('Location: ' . $vnp_Url);
        
        die();
    }

    public function save(Request $request)
    {
        $payment = new  Payment();
        $payment->madonhang = $request->input('madon');
        $payment->sotien = $request->input('sotien');
        $payment->noidung = $request->input('noidung');
        $payment->maphanhoi = $request->input('maphanhoi');
        $payment->magiaodich = $request->input('magiaodich');
        $payment->manganhang = $request->input('manganhang');
        $payment->thoigian = $request->input('thoigian');
        $payment->ketqua = $request->input('kq');

        $payment->save();
        return redirect()->route('home');
    }
    public function vnpay_return()
    {

        Session::forget('carts');
        return view('payment.vnpay_return');
    }

    public function index()
    {
        // Lấy toàn bộ dữ liệu từ bảng payments
        $payments = Payment:: paginate(10);

        // Hiển thị view (hoặc JSON nếu cần)
        return view('admin.carts.index',['title' => 'Trang Lưu VnPay'], compact('payments'));
    }
}
