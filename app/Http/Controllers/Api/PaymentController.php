<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\UserSessionProduct;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function get_checkout_user_id(Request $request)
    {
//        $user_id = User::find($request->user_id)->user_id;
        $cart = UserSessionProduct::where('user_id', $request->user_id)->first();
        if ($cart) {

            $url = "https://test.oppwa.com/v1/checkouts";
            $data = "entityId=8ac7a4c971a7449f0171a74fb5b900c0" .
                "&amount=" . (double)$cart->price .
                "&currency=SAR" .
                "&paymentType=DB";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGFjN2E0Yzk3MWE3NDQ5ZjAxNzFhNzRmNjJlMTAwYmJ8dzg2V0M5bUhicA=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if (curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $res = json_decode($responseData, true);
            return view('payment')->with(['responseData' => $res, 'id' => $request->product_id]);
        } else {
            return 'not found user';
        }
    }

    public function check_payment()
    {
        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));
            if (isset($payment_status['id'])) {
                return $payment_status['result']['description'];
                return $showSuccess = true;
            } else {
                return $showFail = true;
            }
        }
    }

    public function getPaymentStatus($id, $resourcePath)
    {
        $url = "https://test.oppwa.com";
        $url .= $resourcePath;
        $url .= "?entityId=8ac7a4c971a7449f0171a74fb5b900c0";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzk3MWE3NDQ5ZjAxNzFhNzRmNjJlMTAwYmJ8dzg2V0M5bUhicA=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }

}
