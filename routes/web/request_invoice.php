<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invoice\RequestInvoiceController;
 
 Route::group(['middleware' => 'auth'], function () {
     
    Route::resource('/Invoice/Request', RequestInvoiceController::class);
    Route::Post('/Invoice/Request/getInvoice', [RequestInvoiceController::class, 'getAdvances'])->name('ginvoice.getAdvances');    
    Route::get('/Invoice/Request/getAdvancesDetails/{id_advance}', [RequestInvoiceController::class, 'getAdvancesDetails'])->name('ginvoice.getAdvancesDetails');
    Route::Post('/Invoice/Request/getSocieties', [RequestInvoiceController::class, 'getSocieties'])->name('ginvoice.getSocieties');
    Route::post('/Invoice/Request/store_advance', [RequestInvoiceController::class, 'store_advance'])->name('ginvoice.store_advance');    
    Route::post('/Invoice/Request/cancel_advance', [RequestInvoiceController::class, 'cancel_advance'])->name('ginvoice.cancel_advance');
});