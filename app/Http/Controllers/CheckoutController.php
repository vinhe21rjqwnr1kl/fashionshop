<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function vnpay_payment(){

      return view('payment.vnpay_create_payment');

        
}

}
// https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=2000000&vnp_BankCode=NCB&vnp_Command=pay&vnp_CreateDate=20241127064949&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+h%C3%A0ng+test&vnp_OrderType=billpayment&vnp_ReturnUrl=http%3A%2F%2F127.0.0.1%3A8000%2Fcarts&vnp_TmnCode=RDH85BNJ&vnp_TxnRef=1267&vnp_Version=2.1.0&vnp_SecureHash=167b402194d34012a40c629cf996c98a3a92a98a3881e89f6945c2faa7c5dbbd30fd993c98dd160a8f06a734b4b745427da7413e79af33f65065c1719e471231
// https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=1806000&vnp_BankCode=NCB&vnp_Command=pay&vnp_CreateDate=20241127064949&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+toan+don+hang+%3A5&vnp_OrderType=other&vnp_ReturnUrl=https%3A%2F%2Fdomainmerchant.vn%2FReturnUrl&vnp_TmnCode=DEMOV210&vnp_TxnRef=5&vnp_Version=2.1.0&vnp_SecureHash=3e0d61a0c0534b2e36680b3f7277743e8784cc4e1d68fa7d276e79c23be7d6318d338b477910a27992f5057bb1582bd44bd82ae8009ffaf6d141219218625c42
//https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=2000000&vnp_BankCode=NCB&vnp_Command=pay&vnp_CreateDate=20241127070936&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+h%C3%A0ng+test&vnp_OrderType=billpayment&vnp_ReturnUrl=http%3A%2F%2F127.0.0.1%3A8000%2Fcarts&vnp_TmnCode=RDH85BNJ&vnp_TxnRef=1267&vnp_Version=2.1.0&vnp_SecureHash=1766552be933aa3574427465f9b3dc62eef9c860b2a5bc1604a8f6c5c3ebc5f3eb4f17d33c25106db4f13b3094256a99fe88a84108f6a9483c18923aff976151