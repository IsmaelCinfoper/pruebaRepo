<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

// Ruta principal - Aplicación del Tiempo
Route::get('/', function () {
    return view('weather');
});

// Rutas del Sistema de Tickets
Route::prefix('tickets')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/display', [TicketController::class, 'display'])->name('tickets.display');
    Route::post('/call-next/{department}', [TicketController::class, 'callNext'])->name('tickets.callNext');
    Route::post('/{ticket}/complete', [TicketController::class, 'complete'])->name('tickets.complete');
});

// Ruta para generar PDF
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('generate.pdf');

// API del tiempo
Route::get('api/weather/porcuna', [WeatherController::class, 'porcuna'])->name('weather.porcuna');
