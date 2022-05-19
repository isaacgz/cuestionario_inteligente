<?php

use App\Http\Controllers\System\DocTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\LogController;
use App\Http\Controllers\System\RoleController;
use App\Http\Controllers\System\UserController;
use App\Http\Controllers\System\TaxDataController;
 
 Route::group(['middleware' => 'auth'], function () {

    Route::get('/log', [LogController::class, 'index'])->name('log.index');
    Route::get('/log/getFiles/{module}', [LogController::class, 'getFiles'])->name('log.getFiles');
    Route::post('/log/getData', [LogController::class, 'getData'])->name('log.getData');
    
    Route::get('/users/import', [UserController::class, 'masiveImport'])->name('users.import');
    Route::post('/users/importAllEmployee', [UserController::class, 'importAllEmployee'])->name('users.importAllEmployee');
    Route::post('/users/storeEmployeeImport', [UserController::class, 'storeEmployeeImport'])->name('users.storeEmployeeImport');
    Route::resource('/users', UserController::class);
    Route::Post('/users/getUsers', [UserController::class, 'getUsers'])->name('users.getUsers');
    Route::Post('/users/edit', [UserController::class, 'update']);

    Route::resource('/roles', RoleController::class);
    Route::Post('/roles/getRoles', [RoleController::class, 'getRoles'])->name('roles.getRoles');

    Route::resource('/resolution', RoleController::class);
    Route::Post('/resolution/getResolutions', [RoleController::class, 'getResolutions'])->name('resolution.getResolutions');

    Route::resource('/pos', RoleController::class);
    Route::Post('/pos/getPos', [RoleController::class, 'getPos'])->name('pos.getPos');
    
    Route::resource('/doctype', DocTypeController::class);
    Route::Post('/doctype/getDoctype', [DocTypeController::class, 'getDoctype'])->name('doctype.getDoctype');

    Route::resource('/TaxData', TaxDataController::class);
    Route::Post('/TaxData/getTaxData', [TaxDataController::class, 'getTaxData'])->name('taxdata.getTaxData');
    

});