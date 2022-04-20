<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/transaction/detail', function (Request $request) {
    $apiKey = 'DEV-ms8HV7Wru4B9TA2EHPcC9CjF1MMJ88tffWoAxBtg';

    $payload = ['reference'    => $request->ref];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
        CURLOPT_FAILONERROR    => false,
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    return empty($err) ? $response : $error;
});

Route::get('/transaction', function (Request $request) {

    $apiKey = 'DEV-ms8HV7Wru4B9TA2EHPcC9CjF1MMJ88tffWoAxBtg';

    $payload = [];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/transactions' . http_build_query($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
        CURLOPT_FAILONERROR    => false
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    return $response;
});

Route::get('/payment', function (Request $request) {

    $apiKey = 'DEV-ms8HV7Wru4B9TA2EHPcC9CjF1MMJ88tffWoAxBtg';

    $payload = [];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel' . http_build_query($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
        CURLOPT_FAILONERROR    => false
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    return $response;
});

Route::resource('checkout', PaymentController::class);
