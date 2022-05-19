<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invoice\PendingInvoiceController;
 
 Route::group(['middleware' => 'auth'], function () {
     
    Route::resource('/Invoice/Pendings', PendingInvoiceController::class);
    Route::Post('/Invoice/Pendings/getInvoice', [PendingInvoiceController::class, 'getAdvances'])->name('cinvoice.getAdvances');    
    Route::get('/Invoice/Pendings/getAdvancesDetails/{id_advance}', [PendingInvoiceController::class, 'getAdvancesDetails'])->name('cinvoice.getAdvancesDetails');
    Route::Post('/Invoice/Pendings/getSocieties', [PendingInvoiceController::class, 'getSocieties'])->name('cinvoice.getSocieties');
    Route::post('/Invoice/Pendings/store_advance', [PendingInvoiceController::class, 'store_advance'])->name('cinvoice.store_advance');    
    Route::post('/Invoice/Pendings/cancel_advance', [PendingInvoiceController::class, 'cancel_advance'])->name('cinvoice.cancel_advance');
});