<?php

use App\Http\Controllers\AtendimentoController;
use Illuminate\Support\Facades\Route;

Route::controller(AtendimentoController::class)->group(function () {
    Route::get('/', 'index')->name('atendimento.index');
    Route::post('/atendimento', 'list')->name('atendimento.list');
    Route::post('/atendimento/store', 'store')->name('atendimento.store');
    Route::get('/atendimento/{atendimento}/show', 'show')->name('atendimento.show');
    Route::put('/atendimento/{atendimento}/update', 'update')->name('atendimento.update');
    Route::delete('/atendimento/{id}', 'destroy')->name('atendimento.destroy');
    Route::get('/atendimento/card', 'card')->name('atendimento.card');
});
