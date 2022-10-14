<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', [UserController::class,'get_all_users'] )->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::post('send-message', [MessageController::class, 'sendMsg'])->name('messages.send');
    Route::get('load-messages', [MessageController::class, 'loadMsgs'])->name('messages.load');
    Route::get('check-messages', [MessageController::class, 'checkMsgs'])->name('messages.check');
    Route::post('delete-message', [MessageController::class, 'deleteMsg'])->name('messages.delete');
    Route::post('mark-as-read-message', [MessageController::class, 'markAsRead'])->name('messages.seen');
});

require __DIR__.'/auth.php';
