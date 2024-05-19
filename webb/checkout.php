<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    // Configuration
    $consumerKey = 'G4KVwS81mcc7hHAhh3IPIYrAWCA29vL40ilI7826MgOJMj3G';
    $consumerSecret = '6TblGKVMrPsM6y8shCG56blmRsAuSb5RKGX0LiqRwTnSuBnEQ17xaN4vVY9DeFAt';
    $shortCode = '174379';
    $passKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $callbackUrl = 'your_callback_url';

    // Function to generate access token
    function generateAccessToken($consumerKey, $consumerSecret) {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf8']);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result->access_token;
    }

    // Initiate STK Push
    function lipaNaMpesaOnline($phoneNumber, $amount, $shortCode, $passKey, $callbackUrl, $accessToken) {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $timestamp = date('YmdHis');
        $password = base64_encode($shortCode . $passKey . $timestamp);

        $curl_post_data = [
            'BusinessShortCode' => $shortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => 0111545116,
            'PartyB' => $shortCode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => '123456',
            'TransactionDesc' => 'Payment for goods'
        ];

        $data_string = json_encode($curl_post_data);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    // Get form data
    $phoneNumber = $_POST['phone_number'];
    $amount = $_POST['total_amount'];

    // Generate access token
    $accessToken = generateAccessToken($consumerKey, $consumerSecret);

    // Initiate the STK Push
    $response = lipaNaMpesaOnline($phoneNumber, $amount, $shortCode, $passKey, $callbackUrl, $accessToken);
    echo $response;
}
?>;
