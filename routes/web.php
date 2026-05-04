<?php

use App\Http\Controllers\ExportProductData;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import-data', [ExportProductData::class, 'index'])->name('exportView');
Route::post('/import-data', [ExportProductData::class, 'import'])->name('import');
Route::get('/export', [ExportProductData::class, 'exportCsv'])->name('export_csv_view');
Route::post('/export', [ExportProductData::class, 'exportToCsv'])->name('export_csv');
