<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobileRechargeController extends Controller
{
    //

    function mobilerecharge()
    {
        return view('mobilerecharge');
    }

    function mobilerechargeAPICall(Request $request)
    {
        $mobile = $request->mobile;
        $amt = $request->amount;
        $operator = $request->operator;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://127.0.0.1:8000/api/recharge',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            // CURLOPT_XYZ => 0,
            // CURLOPT_ABC => 0,
            // CURLOPT_MNQ => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('mobile' => $mobile, 'operator' => $operator, 'amount' => $amt, 'details' => 'NA'),
            CURLOPT_HTTPHEADER => array(
                'Cookie: token=2|V1JzIEFdN0GqIO82Ndj6dfCIK43Ws1uumbAwL9fa'
            ),
        ));

        $response = curl_exec($curl);
        // LogResponseMiddleware($response);
        curl_close($curl);
        echo $response;
    }
}
