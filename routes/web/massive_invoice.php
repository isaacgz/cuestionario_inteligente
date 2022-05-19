<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invoice\MassiveInvoiceController;
 
 Route::group(['middleware' => 'auth'], function () {
     
    Route::resource('/Invoice/Massive', MassiveInvoiceController::class);
    Route::Post('/Invoice/Massive/getInvoice', [MassiveInvoiceController::class, 'getAdvances'])->name('cinvoice.getAdvances');    
    Route::get('/Invoice/Massive/getAdvancesDetails/{id_advance}', [MassiveInvoiceController::class, 'getAdvancesDetails'])->name('cinvoice.getAdvancesDetails');
    Route::Post('/Invoice/Massive/getSocieties', [MassiveInvoiceController::class, 'getSocieties'])->name('cinvoice.getSocieties');
    Route::post('/Invoice/Massive/store_advance', [MassiveInvoiceController::class, 'store_advance'])->name('cinvoice.store_advance');    
    Route::post('/Invoice/Massive/cancel_advance', [MassiveInvoiceController::class, 'cancel_advance'])->name('cinvoice.cancel_advance');    

});