<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vnpay; // Đảm bảo bạn đã import mô hình Vnpay

class VNPAYController extends Controller
{
   public function vnpay_return(Request $request)
{
    $vnp_HashSecret = "I8VR5EED7FBFV2N3YXGZGU0SY28PSQMI";
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
// ngân hàng       NCB
// số thẻ          9704198526191432198
//                  NGUYEN VAN A
//                   07/15
//                   123456
