<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Shopify OAuth - مرة واحدة بس
Route::get('/shopify/install', function () {
    $shop = 'knsxp1-ib.myshopify.com';
    $clientId = '674ea5f8c55d36a28b96b8a1dcd35298';
    $redirectUri = 'https://xxxx-xx-xx-xx.ngrok-free.app/shopify/callback'; // الـ ngrok URL
    $scopes = 'write_products,read_products';

    $url = "https://{$shop}/admin/oauth/authorize?client_id={$clientId}&scope={$scopes}&redirect_uri={$redirectUri}";

    return redirect($url);
});
Route::get('/shopify/callback', function (\Illuminate\Http\Request $request) {
    dd($request->all());
});

Route::get('/shopify/callback', function (\Illuminate\Http\Request $request) {
    $response = \Illuminate\Support\Facades\Http::post('https://knsxp1-ib.myshopify.com/admin/oauth/access_token', [
        'client_id'     => '674ea5f0c55d36a28b96b8a1dcd35298',
        'client_secret' => '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',
        'code'          => $request->code,
    ]);

    dd($response->json());
});
