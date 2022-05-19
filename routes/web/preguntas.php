<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreguntasController;
 
 Route::group(['middleware' => 'auth'], function () {
     
    Route::resource('/pregunta', PreguntasController::class);
    Route::Post('/pregunta/getPreguntas', [PreguntasController::class, 'getPreguntas'])->name('preguntas.getPreguntas');    
    Route::get('/pregunta/getAdvancesDetails/{id_advance}', [PreguntasController::class, 'getAdvancesDetails'])->name('preguntas.getAdvancesDetails');
    Route::Post('/pregunta/getSocieties', [PreguntasController::class, 'getSocieties'])->name('preguntas.getSocieties');
    Route::post('/pregunta/store_advance', [PreguntasController::class, 'store_advance'])->name('preguntas.store_advance');    
    Route::post('/pregunta/cancel_advance', [PreguntasController::class, 'cancel_advance'])->name('preguntas.cancel_advance');    
});