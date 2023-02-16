<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionPage(){
        return view('transaction-page');
    }
    public function transactionExe(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]); 

        $product = $request['product'];
        $price = $request['price'];
        $qty = $request['qty'];
        $cekQty =$request['qty'];
        foreach ($cekQty as $index => $value) {
            if($value == 0){
                unset($product[$index]);
                unset($price[$index]);
                unset($qty[$index]);
            }
        }
        $product = array_values($product);
        $price = array_values($price);
        $qty = array_values($qty);
         if($qty == []){
            return back()->withError('Jumlah barang yang anda beli masih kosong !');
         }


        $va           = '0000002247608195'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXFAC10577-FDC9-4483-B9B1-B0FFD11A5307'; //get on iPaymu dashboard
    
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode
        
        $method       = 'POST'; //method
        
        //Request Body//
        $body['product']    = $product;
        $body['qty']        = $qty;
        $body['price']      = $price;
        $body['buyerName']  = $validateData['name'];
        $body['buyerEmail']  = $validateData['email'];
        $body['buyerPhone']  = $validateData['phone'];
        $body['returnUrl']  = 'http://127.0.0.1:8000/transaction';
        $body['cancelUrl']  = 'http://127.0.0.1:8000/transaction';
        $body['notifyUrl']  = 'http://127.0.0.1:8000/transaction';
        $body['account'] = $va; //your reference id
        //End Request Body//
    
        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp    = Date('YmdHis');
        //End Generate Signature
    
    
        $ch = curl_init($url);
    
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );
    
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);
        echo $ret;
        $data = json_decode($ret, true);
        $urlRedirect = $data["Data"]["Url"];

        return redirect($urlRedirect);
    
    }
    
}
