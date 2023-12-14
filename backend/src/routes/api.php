<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/* @var \Dingo\Api\Routing\Router $api */
 $api = app(\Dingo\Api\Routing\Router::class);
$api->version('v1', function($api){
    $api->post('transaction/create', [TransactionController::class, 'createTransaction']);
    $api->get('transaction/position/{userId}/{date}', [TransactionController::class, 'getBalancePosition']);
    $api->post('asset/update', [AssetController::class, 'updateAsset']);
});


