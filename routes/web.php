<?php

use App\Http\Controllers\FixedAssetController;
use App\Http\Controllers\UploadFilesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('fam.index');
// });

Route::get('/uploadExcelFile', [UploadFilesController::class, 'updloadExcelFile'])->name('updloadExcelFile');
Route::post('/uploadExcelFile', [UploadFilesController::class, 'updloadExcelFilePost'])->name('updloadExcelFilePost');

Route::get('/', [FixedAssetController::class, 'index'])->name('faindex');
Route::get('/get-fixed-asset/{id}', [FixedAssetController::class, 'getFixedAsset'])->name('getFixedAsset');
Route::post('/update-fixed-asset/{id}',[FixedAssetController::class,'updateFixedAsset'])->name('updateFixedAsset');

Route::get('/testing', [FixedAssetController::class, 'testing'])->name('testing');