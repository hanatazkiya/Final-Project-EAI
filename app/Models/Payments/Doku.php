<?php

namespace App\Models\Payments;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Doku extends Model
{
    // akun ke 1
    // private $clientID = 'BRN-0201-1735203430712';
    // private $secretKey = 'SK-4X9QQugce3FPIKmZJ6q2';
    
    // akun ke 2
    private $clientID = 'BRN-0270-1735119323967';
    private $secretKey = 'SK-aynS5Tw9KVuVRewNcQ4L';
    private $environmentURL = "https://api-sandbox.doku.com/checkout/v1/payment";

    public function __construct($clientID = 'BRN-0270-1735119323967', $secretKey = 'SK-aynS5Tw9KVuVRewNcQ4L')
    {
        $this->clientID = $clientID;
        $this->secretKey = $secretKey;
    }

    public function createPayment(Request $request)
    {
        $orderDetails = [
            'order' => [
                'invoice_number' => $request->invoice_number,
                'amount' => $request->price * $request->quantity,
                'currency' => 'IDR',
                'callback_url' => env('APP_URL') .'/cart' . '/' . $request->invoice_number,
                'callback_url_cancel' => env('APP_URL') . '/cart',
                'callback_url_result' => env('APP_URL') .'/cart'
            ],
            'payment' => [
                'payment_due_date' => 60 * 3,
            ],
            'customer' => [
                'id' => Session::get('username'),
                'name' => Session::get('name'),
                'country' => 'ID'
            ]
        ];

        $url = $this->environmentURL;
        $uniqueID = (string) \Illuminate\Support\Str::uuid()->toString();
        $timeNow = gmdate('Y-m-d\TH:i:s\Z');
        $requestTarget = "/checkout/v1/payment";

        $digest = base64_encode(hash('sha256', json_encode($orderDetails), true));
        $digestBody = "Client-Id:{$this->clientID}\n" .
                      "Request-Id:{$uniqueID}\n" .
                      "Request-Timestamp:{$timeNow}\n" .
                      "Request-Target:{$requestTarget}\n" .
                      "Digest:{$digest}";
        $signature = "HMACSHA256=" . base64_encode(hash_hmac('sha256', $digestBody, $this->secretKey, true));

        $headers = [
            "Content-Type: application/json",
            "Client-Id: {$this->clientID}",
            "Request-Id: {$uniqueID}",
            "Request-Timestamp: {$timeNow}",
            "Signature: {$signature}"
        ];

        $body = json_encode($orderDetails);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            throw new \Exception("Error: {$response}");
        } else {
            return json_decode($response, true);
        }
    }
}
