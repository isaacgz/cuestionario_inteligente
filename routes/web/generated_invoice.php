<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invoice\GeneratedInvoiceController;
 
 Route::group(['middleware' => 'auth'], function () {
     
    Route::resource('/Invoice/Generated', GeneratedInvoiceController::class);
    Route::Post('/Invoice/Generated/getInvoice', [GeneratedInvoiceController::class, 'getAdvances'])->name('ginvoice.getAdvances');    
    Route::get('/Invoice/Generated/getAdvancesDetails/{id_advance}', [GeneratedInvoiceController::class, 'getAdvancesDetails'])->name('ginvoice.getAdvancesDetails');
    Route::Post('/Invoice/Generated/getSocieties', [GeneratedInvoiceController::class, 'getSocieties'])->name('ginvoice.getSocieties');
    Route::post('/Invoice/Generated/store_advance', [GeneratedInvoiceController::class, 'store_advance'])->name('ginvoice.store_advance');    
    Route::post('/Invoice/Generated/cancel_advance', [GeneratedInvoiceController::class, 'cancel_advance'])->name('ginvoice.cancel_advance');
});