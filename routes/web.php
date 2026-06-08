<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;

Route::get('/', [DiagnosisController::class, 'index'])->name('home');
Route::post('/start', [DiagnosisController::class, 'start'])->name('start');
Route::get('/diagnose', [DiagnosisController::class, 'diagnose'])->name('diagnose');
Route::get('/api/question', [DiagnosisController::class, 'getQuestion']);
Route::post('/api/answer', [DiagnosisController::class, 'submitAnswer']);
Route::get('/result/{token}', [DiagnosisController::class, 'result'])->name('result');
