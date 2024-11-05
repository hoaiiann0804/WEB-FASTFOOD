<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vnpay;

class CheckoutController extends Controller
{
    //
    public function online_checkout(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:3000/thank";
        $vnp_TmnCode = "V3XN6MIB";//Mã website tại VNPAY
        $vnp_HashSecret = "Z1JWTZ037O6TDZR8Y2D7WBPG4SPB3ZH9"; //Chuỗi bí mật

        $vnp_TxnRef = rand(00,999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này
        $vnp_OrderInfo = "Noi dung thanh toan don hang Jollibe";
        $vnp_OrderType = "billpayment";
        // $vnp_Amount = $request->input('amount') * 100; // Lấy tổng tiền từ request
        $usdAmount = $request->input('amount');
        $exchangeRate = 23500; // Tỷ giá USD/VND (giả sử tỷ giá này)
        $vndAmount = $usdAmount * $exchangeRate;

        $vnp_Amount = $vndAmount * 100;


        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

            // "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
            // vui lòng tham khảo thêm tại code demo



   public function vnpay_return(Request $request)
{
    $vnp_HashSecret = "Z1JWTZ037O6TDZR8Y2D7WBPG4SPB3ZH9"; // Secret key provided by VNPAY
    $vnp_SecureHash = $request->input('vnp_SecureHash'); // Get the secure hash from the request
    $inputData = $request->all(); // Get all input data from the request

    // Remove vnp_SecureHash for the hash validation process
    unset($inputData['vnp_SecureHash']);

    // Sort data by key to calculate the hash
    ksort($inputData);
    $hashData = urldecode(http_build_query($inputData, '', '&')); // Rebuild the query string
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret); // Recalculate the secure hash

    // Check if the secure hash is valid and if the transaction was successful
    if ($secureHash === $vnp_SecureHash && $request->input('vnp_ResponseCode') === '00') {
        // Log the transaction to the database (vnpay table)
        Vnpay::create([
            'vnp_Amount' => $request->input('vnp_Amount'),
            'vnp_BankCode' => $request->input('vnp_BankCode'),
            'vnp_BankTranNo' => $request->input('vnp_BankTranNo'),
            'vnp_CardType' => $request->input('vnp_CardType'),
            'vnp_OrderInfo' => $request->input('vnp_OrderInfo'),
            'vnp_PayDate' => $request->input('vnp_PayDate'),
            'vnp_ResponseCode' => $request->input('vnp_ResponseCode'),
            'vnp_TmnCode' => $request->input('vnp_TmnCode'),
            'vnp_TransactionNo' => $request->input('vnp_TransactionNo'),
            'vnp_TransactionStatus' => $request->input('vnp_TransactionStatus'),
            'vnp_TxnRef' => $request->input('vnp_TxnRef'),
            'vnp_SecureHash' => $vnp_SecureHash,
        ]);

        // Return success response to VNPAY
        return response()->json(['RspCode' => '00', 'Message' => 'Confirm Success']);
    }

    // If hash validation or transaction failed, return a failure response
    return response()->json(['RspCode' => '97', 'Message' => 'Confirm Fail']);
}
}
