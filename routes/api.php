<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\VaultController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [ApiAuthController::class, 'register'])
    ->name('account.register');

Route::post('/login', [ApiAuthController::class, 'login'])
    ->name('account.login');

Route::middleware('auth:sanctum')
    ->get('/vaults', [VaultController::class, 'index'])
    ->name('vaults.list');

Route::middleware('auth:sanctum')
    ->post('/vaults', [VaultController::class, 'store'])
    ->name('vaults.store');

Route::middleware('auth:sanctum')
    ->get('/vaults/{vault}',[VaultController::class, 'show'])
    ->name('vault.show');

Route::middleware('auth:sanctum')
    ->patch('/vaults/{vault}', [VaultController::class, 'update'])
    ->name('vault.update');

Route::middleware('auth:sanctum')
    ->delete('/vaults/{vault}', [VaultController::class, 'delete'])
    ->name('vault.delete');